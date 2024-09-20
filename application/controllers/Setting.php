<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

class Setting extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        date_default_timezone_set("asia/jakarta");
    }

    public function index()
	{
		$data['set'] = "setting";
		$data['waktuoperasional'] = $this->m_admin->waktuoperasional();
	
		$this->load->view('i_setting', $data);
	
	}

	
	
    public function updateWaktuOperasional() {
        $masuk = $this->input->post('masuk');
        $keluar = $this->input->post('keluar'); 

        foreach ($masuk as $day => $waktu_masuk) {
            $waktu_keluar = isset($keluar[$day]) ? $keluar[$day] : ''; 
            $this->m_admin->update_waktu_operasional($day, $waktu_masuk, $waktu_keluar);
        }

      
        $this->session->set_flashdata('pesan', 'Waktu operasional berhasil diperbarui!');
        redirect('setting');
    }
}