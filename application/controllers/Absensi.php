<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model Absensi_model
        $this->load->model('Absensi_model');
    }

    public function index(){
        $this->load->view('absensi_form');
    }

    public function absen() {
        // Ambil tindakan (masuk/keluar) dari form
        $action = $this->input->post('action');

        // Panggil fungsi absen_process dengan tindakan yang diberikan
        $this->absen_process($action);
    }

    private function absen_process($action) {
        // Ambil UID dari form
        $uid = $this->input->post('uid');
        $id_devices = $this->input->post('id_devices');

        if ($action == 'masuk') {
            // Periksa apakah siswa telah melakukan absensi masuk sebelumnya
            $is_already_absent = $this->Absensi_model->is_already_absent($uid, 'masuk');

            if ($is_already_absent) {
                // Jika sudah melakukan absensi masuk sebelumnya, tampilkan pesan yang sesuai
                $data['message'] = 'Anda sudah melakukan absensi masuk sebelumnya.';
            } else {
                // Jika belum melakukan absensi masuk sebelumnya, lakukan absensi
                $this->Absensi_model->absen_masuk($uid, $id_devices);
                $data['message'] = 'Absensi masuk berhasil.';
            }
        } elseif ($action == 'keluar') {
            // Periksa apakah siswa telah melakukan absensi keluar sebelumnya
            $is_already_absent = $this->Absensi_model->is_already_absent($uid, 'keluar');

            if ($is_already_absent) {
                // Jika sudah melakukan absensi keluar sebelumnya, tampilkan pesan yang sesuai
                $data['message'] = 'Anda sudah melakukan absensi keluar sebelumnya.';
            } else {
                // Jika belum melakukan absensi keluar sebelumnya, lakukan absensi
                $this->Absensi_model->absen_keluar($uid, $id_devices);
                $data['message'] = 'Absensi keluar berhasil.';
            }
        }

        // Load view dengan pesan yang sesuai
        $this->load->view('absensi_form', $data);
    }
}
