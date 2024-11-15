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
        
        // Get the starting position for the value
        $valueX = $x + $labelWidth + $colonWidth;
        $pdf->SetXY($valueX, $y);
        
        // Use MultiCell for the value to handle wrapping
        $pdf->MultiCell($valueWidth, 4, strtoupper($value), 0, 'L');
        
        // Return the number of lines used by MultiCell
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

        $pdf = new TCPDF('L', 'mm', array(85.6, 54), true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('School System');
        $pdf->SetTitle('Student ID Cards');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(true, 0);

        foreach ($students as $student) {
            $pdf->AddPage('L', array(85.6, 54));

            // Template Background
            $template_path = FCPATH . 'assets/images/template.png';
            if (file_exists($template_path)) {
                $pdf->Image($template_path, 0, 0, 85.6, 54, '', '', '', false, 300, '', false, false, 0);
            }

            // Barcode - adjust to match CSS position
            $barcode = $generator->getBarcode($student->nisn, $generator::TYPE_CODE_128, 3, 50);
            $pdf->Image('@'.$barcode, 2, 18, 40, 5);

            // Photo - adjust to match CSS position
            $photo_path = FCPATH . 'uploads/' . $student->foto;
            if (file_exists($photo_path)) {
                $pdf->Image($photo_path, 5.75, 25, 15, 20, '', '', '', false, 300, '', false, false, 1);
            }

            // Student Information - adjust to match CSS position
            $pdf->SetFont('helvetica', 'B', 6);
            $pdf->SetTextColor(0, 0, 0);

            // Starting position for text
            $startX = 25;
            $startY = 25;
            $lineHeight = 4;

            // Write student information
            $this->writeAlignedText($pdf, 'Nama', $student->nama, $startX, $startY);
            $this->writeAlignedText($pdf, 'TTL', $student->tempat_lahir . ',' . $student->tanggal_lahir, $startX, $startY + ($lineHeight * 1));
            $this->writeAlignedText($pdf, 'NIK', $student->nik, $startX, $startY + ($lineHeight * 2));
            $this->writeAlignedText($pdf, 'NISN', $student->nisn, $startX, $startY + ($lineHeight * 3));
            $this->writeAlignedText($pdf, 'Alamat', $student->alamat, $startX, $startY + ($lineHeight * 4));
        }

        $pdf->Output('ID_Cards.pdf', 'D');
    }
}