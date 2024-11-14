<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

class Card extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->library('tcpdf');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index() {
        if (!$this->session->userdata('userlogin')) {
            redirect('login');
        }

        $data['murid'] = $this->m_data->get_all_murid();
        $this->load->view('i_kelas_detail', $data);
    }

    public function generate_cards() {
        if (!$this->session->userdata('userlogin')) {
            redirect('login');
        }

        if ($this->input->post('cetak_semua')) {
            $students = $this->m_data->get_all_murid();
        } else {
            $student_ids = $this->input->post('murid_ids');
            if (empty($student_ids)) {
                echo "No students selected";
                return;
            }
            $students = $this->m_data->find_students_by_ids($student_ids);
        }

        if (empty($students)) {
            echo "No students found";
            return;
        }

        $data = [];
        $generator = new BarcodeGeneratorPNG();

        foreach ($students as $student) {
            $barcode = base64_encode($generator->getBarcode($student->nisn, $generator::TYPE_CODE_128));
            $data[] = [
                'student' => $student,
                'barcode' => $barcode
            ];
        }

        $this->load->view('display_cards', ['cards' => $data]);
    }

    public function download_cards() {
        if (!$this->session->userdata('userlogin')) {
            redirect('login');
        }
    
        $students = $this->m_data->get_all_murid();
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
    
        $zip = new ZipArchive();
        $zip_filename = 'id_cards.zip';
        $zip->open($zip_filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    
        foreach ($students as $student) {
            $barcode = base64_encode($generator->getBarcode($student->nisn, $generator::TYPE_CODE_128));
            $card_html = $this->load->view('display_cards', ['cards' => [['student' => $student, 'barcode' => $barcode]]], true);
    
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->AddPage('P', 'mm', array(85.6, 54));
            $pdf->writeHTML($card_html, true, false, true, false, '');
    
            $filename = $student->nama . '.png';
            $pdf->Output($filename, 'S');
            $zip->addFromString($filename, $pdf->Output($filename, 'S'));
        }
    
        $zip->close();
    
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
        header('Content-Length: ' . filesize($zip_filename));
    
        readfile($zip_filename);
        unlink($zip_filename);
        exit;
    }
}