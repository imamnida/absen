<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_Bc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
      
        $this->load->model('Absensi_model');
    }

    public function index(){
        $this->load->view('i_absensi_bc');
    }

    public function absen() {

        $action = $this->input->post('action');


        $this->absen_process($action);
    }

    private function absen_process($action) {
      
        $nisn = $this->input->post('nisn');
        $id_devices = $this->input->post('id_devices');

      
        $is_registered_nisn = $this->Absensi_model->is_registered_nisn($nisn);

        if (!$is_registered_nisn) {
          
            $data['message'] = 'nisn Belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $data['message_type'] = 'danger';
            $this->load->view('i_absensi_bc', $data);
            return; 
        }

     
        $is_already_absent = $this->Absensi_model->is_already_absent($nisn, $action);

        if ($is_already_absent) {
         
            $data['message'] = 'Anda sudah melakukan absensi '.$action.' sebelumnya hari ini.';
            $data['message_type'] = 'warning';
        } else {
           
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
              
                $data['message'] = 'Tindakan absensi tidak valid.';
                $data['message_type'] = 'danger';
            }
        }

      
        $this->load->view('i_absensi_bc', $data);
    }
}
?>
