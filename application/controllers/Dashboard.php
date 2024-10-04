<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        date_default_timezone_set("asia/jakarta");
    }



    public function index() {
		$data['set'] = "dashboard";
		$data['siswa'] = $this->m_data->get_siswa();
		$data['devices'] = $this->m_data->get_devices();
		$data['kelas'] = $this->m_data->get_kelas_byrow();
	
		$today = date('Y-m-d'); 
		$tomorrow = date('Y-m-d', strtotime('tomorrow')); 
	
		$data['masuk'] = $this->m_data->get_absensi("masuk", strtotime("today"), strtotime("tomorrow"));
		$data['keluar'] = $this->m_data->get_absensi("keluar", strtotime("today"), strtotime("tomorrow"));
	    $data['izin'] = $this->m_data->get_absensi("izin", strtotime("today"), strtotime("tomorrow"));
		$data['sakit'] = $this->m_data->get_absensi("sakit", strtotime("today"), strtotime("tomorrow"));
	
		$jumlah_tidak_absensi = $this->m_data->hitung_tidak_absensi();

	 
		$data['jumlah_tidak_absensi'] = $jumlah_tidak_absensi;
		$this->load->view('i_dashboard', $data);
	}
}