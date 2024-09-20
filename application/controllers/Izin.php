<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Izin_Model');
    }

    public function index() {
        $data['kelas'] = $this->Izin_Model->get_kelas();
        $data['jumlah_tidak_absensi_per_kelas'] = $this->Izin_Model->get_jumlah_tidak_hadir_per_kelas();
        $this->load->view('i_izin', $data);
    }

    public function detail($id_kelas) {
        $data['siswa'] = $this->Izin_Model->get_siswa_by_kelas($id_kelas);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('i_izin_detail', $data);
    }

    public function absen() {
        $action = $this->input->post('action');
        $id_kelas = $this->input->post('id_kelas');
        $this->absen_process($action, $id_kelas);
    }

    private function absen_process($action, $id_kelas) {
        $nisn = $this->input->post('nisn');
        $id_devices = $this->input->post('id_devices');

        $is_registered_nisn = $this->Izin_Model->is_registered_nisn($nisn);

        if (!$is_registered_nisn) {
            $data['message'] = 'NISN belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $data['siswa'] = $this->Izin_Model->get_siswa_by_kelas($id_kelas);
            $data['id_kelas'] = $id_kelas;
            $this->load->view('i_izin_detail', $data);
            return;
        }

        $is_already_absent = $this->Izin_Model->is_already_absent($nisn, $action);

        if ($is_already_absent) {
            $data['message'] = 'Anda sudah melakukan absensi ' . $action . ' sebelumnya hari ini.';
        } else {

            if (in_array($action, ['masuk', 'keluar', 'izin', 'sakit'])) {
                $this->Izin_Model->simpan_absensi($nisn, $id_devices, $action);
                $data['message'] = 'Absensi ' . $action . ' berhasil.';
            } else {
                $data['message'] = 'Tindakan absensi tidak valid.';
            }
        }

        $data['siswa'] = $this->Izin_Model->get_siswa_by_kelas($id_kelas);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('i_izin_detail', $data);
    }
}
?>
