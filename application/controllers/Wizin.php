<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('W_Izin_Model');
        date_default_timezone_set("Asia/Jakarta");
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
        $tanggal = $this->input->post('tanggal');
    
        $is_registered_nisn = $this->W_Izin_Model->is_registered_nisn($nisn);
    
        if (!$is_registered_nisn) {
            $data['notification'] = [
                'type' => 'error',
                'message' => 'NISN belum terdaftar. Silakan mendaftar terlebih dahulu.'
            ];
        } else {
            $is_already_absent = $this->W_Izin_Model->is_already_absent($nisn, $action, $tanggal);
    
            if ($is_already_absent) {
                $data['notification'] = [
                    'type' => 'warning',
                    'message' => 'Anda sudah melakukan absensi ' . $action . ' pada tanggal ' . $tanggal . '.'
                ];
            } else {
                if (in_array($action, ['masuk', 'keluar', 'izin', 'sakit'])) {
                    $this->W_Izin_Model->simpan_absensi($nisn, $id_devices, $action, $tanggal);
                    $data['notification'] = [
                        'type' => 'success',
                        'message' => 'Absensi ' . $action . ' berhasil untuk tanggal ' . $tanggal . '.'
                    ];
                } else {
                    $data['notification'] = [
                        'type' => 'error',
                        'message' => 'Tindakan absensi tidak valid.'
                    ];
                }
            }
        }
    
        $data['siswa'] = $this->W_Izin_Model->get_siswa_by_kelas($id_kelas);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('wad/w_izin_detail', $data);
    }
}
?>
