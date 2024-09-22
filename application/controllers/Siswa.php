<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_login');
    }

    public function index() {
      
        $this->load->view('i_siswa_login');
    }

    public function logincheck() {
        if (isset($_POST['nik']) && isset($_POST['pass'])) {
            
            $nik = $this->input->post('nik');
            $pass = $this->input->post('pass');
    
            // Cek cookie jika "remember me" dicentang
            if (isset($_POST["remember"])) {
                $hour = time() + 3600 * 24 * 30;
                setcookie('nik', $nik, $hour);
                setcookie('nisn', $pass, $hour);
            }
    
            // Ambil data dari database
            $check = $this->s_login->prosesLogin($nik);
            if (!empty($check)) {
                // Ambil data langsung dari hasil query (tanpa foreach)
                $passDB = $check->nisn; // Ambil nisn
                $nama = $check->nama; // Ambil nama
                $id_rfid = $check->id_rfid; // Ambil id_rfid
    
                if ($pass === $passDB) {
                    // Set session data
                    $this->session->set_userdata('userlogin', $nik);
                    $this->session->set_userdata('nisn', $passDB);
                    $this->session->set_userdata('nama', $nama);
                    $this->session->set_userdata('id_rfid', $id_rfid); // Simpan id_rfid ke session
    
                    redirect(base_url().'absensi_hp');
                } else {
                    // nisn tidak cocok
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nisn salah</div>");
                    redirect(base_url().'siswa');
                }
            } else {
                // nik tidak ditemukan
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nik tidak ditemukan</div>");
                redirect(base_url().'siswa');
            }
        }
    }
    

    public function logout() {
     
        $this->session->sess_destroy();
        redirect(base_url().'siswa');
    }
}
