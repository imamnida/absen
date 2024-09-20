<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_login');
    }

    public function index() {
        // Tampilkan halaman login
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
                $data = $this->s_login->viewDataByID($nik); 
                foreach ($data as $dkey) {
                    $passDB = $dkey->nisn;
                    $nama = $dkey->nama; // Ambil nama dari data
                }

                if ($pass === $passDB) {
                    // Set session data
                    $this->session->set_userdata('userlogin', $nik);
                    $this->session->set_userdata('nisn', $passDB); 
                    $this->session->set_userdata('nama', $nama); // Set session untuk nama

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
        // Hapus session dan redirect ke halaman login
        $this->session->sess_destroy();
        redirect(base_url().'siswa');
    }
}
