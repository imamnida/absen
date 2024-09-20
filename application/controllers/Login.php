<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->library('bcrypt');
    }

	public function index()
	{
		$this->load->view('i_login');
	
	}

	public function logincheck(){
		if (isset($_POST['username']) && isset($_POST['pass'])) {
			
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');
			$hash = $this->bcrypt->hash_password($pass);	

			if(isset($_POST["remember"])){
	        	$hour = time() + 3600 * 24 * 30;
	        	setcookie('username', $username, $hour);
	            setcookie('password', $pass, $hour);
	        }

		
			$check = $this->m_login->prosesLogin($username);
			$hasil = 0;
			if(isset($check)){
				$hasil++;
			}

		
			if($hasil > 0){
				$data = $this->m_login->viewDataByID($username); 
				foreach ($data as $dkey) {
					$passDB = $dkey->password;
			
					$avatar = $dkey->avatar;
				
				}
				
				if ($this->bcrypt->check_password($pass, $passDB))
				{
					
					$this->session->set_userdata('userlogin',$username);
					$this->session->set_userdata('avatar',$avatar);

					redirect(base_url().'dashboard');
					
				}else{
				
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, password salah</div>");
					redirect(base_url().'login');
				}
			}else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Gagal Login, username tidak ditemukan</div>");
				redirect(base_url().'login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

	

}
