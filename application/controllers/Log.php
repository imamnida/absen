<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Walikelas_model');
        $this->load->library('bcrypt');
    }

    public function index() {
        $this->load->view('wad/w_login');
    }

    public function logincheck() {
        $nuptk = $this->input->post('nuptk');
        $pass = $this->input->post('pass');

        if ($nuptk && $pass) {
          
            $user = $this->Walikelas_model->prosesLogin($nuptk);

            if ($user) {
                $passDB = $user->password;
                $avatar = $user->avatar;
                $nama = $user->nama;

               
                log_message('debug', 'Input password: ' . $pass);
                log_message('debug', 'Stored password hash: ' . $passDB);

                if ($this->bcrypt->check_password($pass, $passDB)) {
                 
                    $this->session->set_userdata('userlogin', $nuptk);
                    $this->session->set_userdata('avatar', $avatar);
                    $this->session->set_userdata('nama', $nama);

                    if ($this->input->post("remember")) {
                        $hour = time() + 3600 * 24 * 30;
                        setcookie('nuptk', $nuptk, $hour);
                        setcookie('password', $pass, $hour);
                    }

                    redirect(base_url().'wad/dashboard');
                } else {
                 
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, password salah</div>");
                    redirect(base_url().'log');
                }
            } else {
              
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, NUPTK tidak ditemukan</div>");
                redirect(base_url().'log');
            }
        } else {
          
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Harap masukkan NUPTK dan password</div>");
            redirect(base_url().'log');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'log');
    }
}
?>
