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
        // Ambil UID dari form
        $uid = $this->input->post('uid');
        $id_devices = $this->input->post('id_devices');

        // Periksa apakah UID sudah terdaftar dalam tabel 'rfid'
        $is_registered_uid = $this->Absensi_model->is_registered_uid($uid);

        if (!$is_registered_uid) {
            // Jika UID belum terdaftar, berikan pesan kesalahan atau arahkan siswa untuk mendaftar
            $data['message'] = 'UID belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $this->load->view('i_absensi_form', $data);
            return; // Hentikan eksekusi metode
        }

        // Periksa apakah siswa sudah melakukan absensi sebelumnya
        $is_already_absent = $this->Absensi_model->is_already_absent($uid, $action);

        if ($is_already_absent) {
            // Jika sudah melakukan absensi sebelumnya, tampilkan pesan yang sesuai
            $data['message'] = 'Anda sudah melakukan absensi '.$action.' sebelumnya hari ini.';
        } else {
            // Lanjutkan dengan proses absensi jika belum absen sebelumnya
            if ($action == 'masuk') {
                $this->Absensi_model->absen_masuk($uid, $id_devices);
                $data['message'] = 'Absensi masuk berhasil.';
            } elseif ($action == 'keluar') {
                $this->Absensi_model->absen_keluar($uid, $id_devices);
                $data['message'] = 'Absensi keluar berhasil.';
            } elseif ($action == 'izin') {
                $this->Absensi_model->absen_izin($uid, $id_devices);
                $data['message'] = 'Absensi izin berhasil.';
            } elseif ($action == 'sakit') {
                $this->Absensi_model->absen_sakit($uid, $id_devices);
                $data['message'] = 'Absensi sakit berhasil.';
            } else {
                // Tindakan tidak valid
                $data['message'] = 'Tindakan absensi tidak valid.';
            }
        }

        // Load view dengan pesan yang sesuai
        $this->load->view('i_absensi_form', $data);
    }
}
?>
