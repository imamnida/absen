<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model Absensi_model
        $this->load->model('Absensi_model');
    }

    public function index(){
        $this->load->view('i_absensi_form');
    }

    public function absen() {
        // Ambil tindakan (masuk/keluar/izin/sakit) dari form
        $action = $this->input->post('action');

        // Panggil fungsi absen_process dengan tindakan yang diberikan
        $this->absen_process($action);
    }

    private function absen_process($action) {
        // Ambil nisn dari form
        $nisn = $this->input->post('nisn');
        $id_devices = $this->input->post('id_devices');

        // Periksa apakah nisn sudah terdaftar dalam tabel 'rfid'
        $is_registered_nisn = $this->Absensi_model->is_registered_nisn($nisn);

        if (!$is_registered_nisn) {
            // Jika nisn belum terdaftar, berikan pesan kesalahan atau arahkan siswa untuk mendaftar
            $data['message'] = 'nisn Belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $data['message_type'] = 'danger';
            $this->load->view('i_absensi_form', $data);
            return; // Hentikan eksekusi metode
        }

        // Periksa apakah siswa sudah melakukan absensi sebelumnya
        $is_already_absent = $this->Absensi_model->is_already_absent($nisn, $action);

        if ($is_already_absent) {
            // Jika sudah melakukan absensi sebelumnya, tampilkan pesan yang sesuai
            $data['message'] = 'Anda sudah melakukan absensi '.$action.' sebelumnya hari ini.';
            $data['message_type'] = 'warning';
        } else {
            // Lanjutkan dengan proses absensi jika belum absen sebelumnya
            if ($action == 'masuk') {
                $this->Absensi_model->absen_masuk($nisn, $id_devices);
                $data['message'] = 'Absensi masuk berhasil.';
                $data['message_type'] = 'success';
            } elseif ($action == 'keluar') {
                $this->Absensi_model->absen_keluar($nisn, $id_devices);
                $data['message'] = 'Absensi keluar berhasil.';
                $data['message_type'] = 'success';
            } elseif ($action == 'izin') {
                $this->Absensi_model->absen_izin($nisn, $id_devices);
                $data['message'] = 'Absensi izin berhasil.';
                $data['message_type'] = 'success';
            } elseif ($action == 'sakit') {
                $this->Absensi_model->absen_sakit($nisn, $id_devices);
                $data['message'] = 'Absensi sakit berhasil.';
                $data['message_type'] = 'success';
            } else {
                // Tindakan tidak valid
                $data['message'] = 'Tindakan absensi tidak valid.';
                $data['message_type'] = 'danger';
            }
        }

        // Load view dengan pesan yang sesuai
        $this->load->view('i_absensi_form', $data);
    }
}
?>
