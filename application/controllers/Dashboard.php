<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        date_default_timezone_set("asia/jakarta");
    }



    public function index() {
		$data['set'] = "dashboard";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['devices'] = $this->m_admin->get_devices();
		$data['kelas'] = $this->m_admin->get_kelas_byrow();
	
		$today = date('Y-m-d'); 
		$tomorrow = date('Y-m-d', strtotime('tomorrow')); 
	
		$data['masuk'] = $this->m_admin->get_absensi("masuk", strtotime("today"), strtotime("tomorrow"));
		$data['keluar'] = $this->m_admin->get_absensi("keluar", strtotime("today"), strtotime("tomorrow"));
	    $data['izin'] = $this->m_admin->get_absensi("izin", strtotime("today"), strtotime("tomorrow"));
		$data['sakit'] = $this->m_admin->get_absensi("sakit", strtotime("today"), strtotime("tomorrow"));
	
		$jumlah_tidak_absensi = $this->m_admin->hitung_tidak_absensi();

	 
		$data['jumlah_tidak_absensi'] = $jumlah_tidak_absensi;
		$this->load->view('i_dashboard', $data);
	}
}