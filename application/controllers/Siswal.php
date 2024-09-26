<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswal extends CI_Controller {

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
    
          
            if (isset($_POST["remember"])) {
                $hour = time() + 3600 * 24 * 30;
                setcookie('nik', $nik, $hour);
                setcookie('nisn', $pass, $hour);
            }
    

            $check = $this->s_login->prosesLogin($nik);
            if (!empty($check)) {
              
                $passDB = $check->nisn; 
                $nama = $check->nama;
                $foto = $check->foto; 
    
                if ($pass === $passDB) {
               
                    $this->session->set_userdata('userlogin', $nik);
                    $this->session->set_userdata('nisn', $passDB);
                    $this->session->set_userdata('nama', $nama);
                    $this->session->set_userdata('id_siswa', $id_siswa);
                    $this->session->set_userdata('foto', $foto);
    
                    redirect(base_url().'absensi_hp');
                } else {
                    // nisn tidak cocok
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nisn salah</div>");
                    redirect(base_url().'siswal');
                }
            } else {
                // nik tidak ditemukan
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nik tidak ditemukan</div>");
                redirect(base_url().'siswal');
            }
        }
    }
    

    public function logout() {
     
        $this->session->sess_destroy();
        redirect(base_url().'siswal');
    }
}
