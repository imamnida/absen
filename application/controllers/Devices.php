<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        date_default_timezone_set("asia/jakarta");
    }
   
   
    public function index(){
		$data['set'] = "devices";
		$data['devices'] = $this->m_data->get_devices();

		$this->load->view('i_devices', $data);
	}
   public function update_device_mode() {
		$id = $this->input->post('id');
		$new_mode = $this->input->post('mode');
	  
		$data = array(
		  'mode' => $new_mode
		);
	  
		$this->db->where('id_devices', $id);
		$this->db->update('devices', $data);
	  
		echo json_encode(array('status' => 'success'));
	  }
	  
	

	public function add_devices(){
		$data['set'] = "add-devices";
		$this->load->view('i_devices', $data);
	}

	public function save_devices(){
		if($this->session->userdata('userlogin')){
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');

		 

			if (false) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> ID Alat sudah terdaftar, ganti ID Alat</div>");
			}else{
				$data = array(
		                'nama_devices'  => $nama, 'mode'  => 'SCAN',
		        );
							
				if($this->m_data->insert_devices($data)){
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");

				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}
			}
	        
			redirect(base_url().'devices');
		}
	}

	public function hapus_devices($id=null){
		if($this->session->userdata('userlogin'))  
		{ 
			if($this->m_data->devices_del($id)){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}
			
			redirect(base_url().'devices');
		}
	}

	public function edit_devices($id=null){
		if($this->session->userdata('userlogin')){    
			if (isset($id)) {
				
				$devices = $this->m_data->get_devices_byid($id);
				if (isset($devices)) {
					foreach ($devices as $key => $value) {
						 
						$data['id'] = $value->id_devices;
						$data['nama_devices'] = $value->nama_devices;
					}
					$data['set'] = "edit-devices";
					$this->load->view('i_devices', $data);
				}
				
			}else{
				redirect(base_url().'devices');
			}
		}
	}

	public function edit_devices_mode($id=null){
		if($this->session->userdata('userlogin')){     
			if (isset($id)) {
				
				$devices = $this->m_data->get_devices_byid($id);
				if (isset($devices)) {
					foreach ($devices as $key => $value) {
						 
						$data['id'] = $value->id_devices;
						$data['mode'] = $value->mode;
					}
					$data['set'] = "edit-devices-mode";
					$this->load->view('i_devices', $data);
				}
				
			}else{
				redirect(base_url().'devices');
			}
		}
	}

	public function save_edit_devices(){
		if($this->session->userdata('userlogin')){    
			if (isset($_POST['id']) && isset($_POST['nama'])) {
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');

				$data = array('nama_devices' => $nama,
			 				);

				if ($this->m_data->updateDevices($id,$data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
				redirect(base_url().'devices');
			}
		}
	}

	public function save_edit_devices_mode(){
		if($this->session->userdata('userlogin')){    
			$id = $this->input->post('id');
			$mode = $this->input->post('mode');
			
			if ($mode) {
				$data = array('mode' => 'ADD', );
			}else{
				$data = array('mode' => 'SCAN', );
			}


			if ($this->m_data->updateDevices($id,$data)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Mode berhasil di update</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Mode gagal di update</div>");
			}
			redirect(base_url().'devices');

		}
	}

}