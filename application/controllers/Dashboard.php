<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->library('user_agent');
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

        $data['jumlah_tidak_absensi'] = $this->m_data->hitung_tidak_absensi();

        $data['jmlsiswa'] = isset($data['siswa']) ? count($data['siswa']) : 0;
        $data['jmlalat'] = isset($data['devices']) ? count($data['devices']) : 0;
        $data['jmlmasuk'] = isset($data['masuk']) ? count($data['masuk']) : 0;
        $data['jmlkeluar'] = isset($data['keluar']) ? count($data['keluar']) : 0;
        $data['jmlizin'] = isset($data['izin']) ? count($data['izin']) : 0;
        $data['jmlsakit'] = isset($data['sakit']) ? count($data['sakit']) : 0;
        $data['jumlah_tidak_absensi'] = isset($data['jumlah_tidak_absensi']) ? $data['jumlah_tidak_absensi'] : 0;

        if ($this->agent->is_mobile()) {
            $this->load->view('mobile/i_mobile_dashboard', $data);
        } else {
            $this->load->view('i_dashboard', $data);
        }
    }
}