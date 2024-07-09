<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('W_login'); // Load the W_login model
        $this->load->library('bcrypt');
    }

    public function index() {
        $this->load->view('wad/w_login');
    }

    public function logincheck() {
        if ($this->input->post('nuptk') && $this->input->post('pass')) {
            $nuptk = $this->input->post('nuptk'); // Pastikan nama field sesuai dengan yang di POST
            $pass = $this->input->post('pass');

            // Fetch user data from database
            $user = $this->W_login->prosesLogin($nuptk);

            if ($user) {
                $passDB = $user->password;
                $avatar = $user->avatar;

                if ($this->bcrypt->check_password($pass, $passDB)) {
                    // Password match
                    $this->session->set_userdata('userlogin', $nuptk);
                    $this->session->set_userdata('avatar', $avatar);

                    if ($this->input->post("remember")) {
                        $hour = time() + 3600 * 24 * 30;
                        setcookie('nuptk', $nuptk, $hour);
                        setcookie('password', $pass, $hour);
                    }

                    redirect(base_url().'wad/dashboard');
                } else {
                    // Password does not match
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, password salah</div>");
                    redirect(base_url().'login');
                }
            } else {
                // nuptk not found
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, nuptk tidak ditemukan</div>");
                redirect(base_url().'login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }
}
?>
