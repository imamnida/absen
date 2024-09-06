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

    public function logincheck(){
        if (isset($_POST['nik']) && isset($_POST['pass'])) {
            
            $nik = $this->input->post('nik');
            $pass = $this->input->post('pass');

            if (isset($_POST["remember"])) {
                $hour = time() + 3600 * 24 * 30;
                setcookie('nik', $nik, $hour);
                setcookie('nisn', $pass, $hour);
            }

            // Ambil data dari database
            $check = $this->s_login->prosesLogin($nik);
            $hasil = 0;
            if (isset($check)) {
                $hasil++;
            }

            if ($hasil > 0) {
                $data = $this->s_login->viewDataByID($nik); 
                foreach ($data as $dkey) {
                    $passDB = $dkey->nisn;
                    
                }

                // Bandingkan password yang dimasukkan dengan yang ada di database
                if ($pass === $passDB) {
                    // nisn match
                    $this->session->set_userdata('userlogin', $nik);
                    $this->session->set_userdata('nisn', $passDB); 
                    $this->session->set_userdata('nama', $nama);

                    // Debugging - Pastikan NISN disimpan di session
                    // var_dump($this->session->userdata('nisn')); exit;

                    redirect(base_url().'absensi_hp');
                    
                } else {
                    // nisn does not match
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nisn salah</div>");
                    redirect(base_url().'siswa');
                }
            } else {
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
