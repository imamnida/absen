<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

class Card extends CI_Controller {
    private function getTextWidth($pdf, $text) {
        return $pdf->GetStringWidth($text);
    }

    private function writeAlignedText($pdf, $label, $value, $x, $y, $labelWidth = 15, $colonWidth = 2, $valueWidth = 40) {
        $pdf->SetXY($x, $y);
        $pdf->Cell($labelWidth, 4, $label, 0, 0);
        $pdf->Cell($colonWidth, 4, ':', 0, 0);
        
        $valueX = $x + $labelWidth + $colonWidth;
        $pdf->SetXY($valueX, $y);
        
        $pdf->MultiCell($valueWidth, 4, strtoupper($value), 0, 'L');
        
        $lines = max(1, ceil($this->getTextWidth($pdf, $value) / $valueWidth));
        return $lines;
    }

    public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function generate_cards() {
        if (!$this->session->userdata('userlogin')) {
            redirect('login');
        }

        $students = $this->m_data->get_all_murid();
        $data = [];
        $generator = new BarcodeGeneratorPNG();

        foreach ($students as $student) {
            $barcode = base64_encode($generator->getBarcode($student->nisn, $generator::TYPE_CODE_128, 3, 50));
            $data[] = [
                'student' => $student,
                'barcode' => $barcode
            ];
        }

        $this->load->view('display_cards', [
            'cards' => $data
        ]);
    }

    public function download_cards() {
        if (!$this->session->userdata('userlogin')) {
            redirect('login');
        }

        $students = $this->m_data->get_all_murid();
        $generator = new BarcodeGeneratorPNG();

        // Buat folder untuk menyimpan file PDF jika belum ada
        $upload_path = FCPATH . 'uploads/kartu_pelajar/';
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Buat ZIP archive
        $zip = new ZipArchive();
        $zip_name = 'kartu_pelajar_' . date('Y-m-d_H-i-s') . '.zip';
        $zip_path = $upload_path . $zip_name;
        $zip->open($zip_path, ZipArchive::CREATE);

        foreach ($students as $student) {
            // Buat PDF baru untuk setiap siswa
            $pdf = new TCPDF('L', 'mm', array(85.6, 54), true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('School System');
            $pdf->SetTitle('Student ID Card - ' . $student->nama);

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(true, 0);

            $pdf->AddPage('L', array(85.6, 54));

            // Template Background
            $template_path = FCPATH . 'assets/images/template.png';
            if (file_exists($template_path)) {
                $pdf->Image($template_path, 0, 0, 85.6, 54, '', '', '', false, 300, '', false, false, 0);
            }

            // Barcode
            $barcode = $generator->getBarcode($student->nisn, $generator::TYPE_CODE_128, 3, 50);
            $pdf->Image('@'.$barcode, 2, 18, 40, 5);

            // Photo
            $photo_path = FCPATH . 'uploads/' . $student->foto;
            if (file_exists($photo_path)) {
                $pdf->Image($photo_path, 5.75, 25, 15, 20, '', '', '', false, 300, '', false, false, 1);
            }

            // Student Information
            $pdf->SetFont('helvetica', 'B', 6);
            $pdf->SetTextColor(0, 0, 0);

            $startX = 25;
            $startY = 25;
            $lineHeight = 4;

            // Modified information layout without NIK
            $this->writeAlignedText($pdf, 'Nama', $student->nama, $startX, $startY);
            $this->writeAlignedText($pdf, 'TTL', $student->tempat_lahir . ',' . $student->tanggal_lahir, $startX, $startY + ($lineHeight * 1));
            $this->writeAlignedText($pdf, 'NISN', $student->nisn, $startX, $startY + ($lineHeight * 2));
            $this->writeAlignedText($pdf, 'Alamat', $student->alamat, $startX, $startY + ($lineHeight * 3));

            // Sanitize nama file
            $filename = $this->sanitize_filename($student->nama) . '.pdf';
            $pdf_path = $upload_path . $filename;

            // Simpan PDF
            $pdf->Output($pdf_path, 'F');

            // Tambahkan ke ZIP
            $zip->addFile($pdf_path, $filename);
        }

        $zip->close();

        // Hapus file PDF individual setelah di-zip
        foreach ($students as $student) {
            $filename = $this->sanitize_filename($student->nama) . '.pdf';
            $pdf_path = $upload_path . $filename;
            if (file_exists($pdf_path)) {
                unlink($pdf_path);
            }
        }

        // Download ZIP
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zip_name . '"');
        header('Content-Length: ' . filesize($zip_path));
        readfile($zip_path);

        // Hapus file ZIP setelah didownload
        unlink($zip_path);
    }

    private function sanitize_filename($filename) {
        // Hapus karakter yang tidak diinginkan
        $filename = preg_replace('/[^a-zA-Z0-9_.]/', '_', $filename);
        // Ubah spasi menjadi underscore
        $filename = str_replace(' ', '_', $filename);
        // Konversi ke lowercase
        return strtolower($filename);
    }
}