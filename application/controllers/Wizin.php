<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('W_Izin_Model');
    }

    public function index() {
        $data['kelas'] = $this->W_Izin_Model->get_kelas();
        $data['jumlah_tidak_absensi_per_kelas'] = $this->W_Izin_Model->get_jumlah_tidak_hadir_per_kelas();
        $this->load->view('wad/w_izin', $data);
    }

    public function detail($id_kelas) {
        $data['siswa'] = $this->W_Izin_Model->get_siswa_by_kelas($id_kelas);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('wad/w_izin_detail', $data);
    }

    public function absen() {
        $action = $this->input->post('action');
        $id_kelas = $this->input->post('id_kelas');
        $this->absen_process($action, $id_kelas);
    }

    private function absen_process($action, $id_kelas) {
        $nisn = $this->input->post('nisn');
        $id_devices = $this->input->post('id_devices');

        $is_registered_nisn = $this->W_Izin_Model->is_registered_nisn($nisn);

        if (!$is_registered_nisn) {
            $data['message'] = 'nisn belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $data['siswa'] = $this->W_Izin_Model->get_siswa_by_kelas($id_kelas);
            $data['id_kelas'] = $id_kelas;
            $this->load->view('wad/w_izin_detail', $data);
            return;
        }

        $is_already_absent = $this->W_Izin_Model->is_already_absent($nisn, $action);

        if ($is_already_absent) {
            $data['message'] = 'Anda sudah melakukan absensi '.$action.' sebelumnya hari ini.';
        } else {
            if ($action == 'masuk') {
                $this->W_Izin_Model->absen_masuk($nisn, $id_devices);
                $data['message'] = 'Absensi masuk berhasil.';
            } elseif ($action == 'keluar') {
                $this->W_Izin_Model->absen_keluar($nisn, $id_devices);
                $data['message'] = 'Absensi keluar berhasil.';
            } elseif ($action == 'izin') {
                $this->W_Izin_Model->absen_izin($nisn, $id_devices);
                $data['message'] = 'Absensi izin berhasil.';
            } elseif ($action == 'sakit') {
                $this->W_Izin_Model->absen_sakit($nisn, $id_devices);
                $data['message'] = 'Absensi sakit berhasil.';
            } else {
                $data['message'] = 'Tindakan absensi tidak valid.';
            }
        }

        $data['siswa'] = $this->W_Izin_Model->get_siswa_by_kelas($id_kelas);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('wad/w_izin_detail', $data);
    }

}
?>
