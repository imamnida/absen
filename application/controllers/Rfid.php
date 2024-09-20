<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfid extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
	
        date_default_timezone_set("asia/jakarta");
    }

	
    public function index(){
		$data['set'] = "rfid";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['m_admin'] = $this->m_admin;
		$this->load->view('i_rfid', $data);
	}

    public function rfid($data=null){
		if (isset($data)) {
			if ($data == "datarfid") {
				$this->datarfid();
			}else if ($data == "rfidnew") {
				$this->rfidnew();
			}else{
				redirect(base_url().'dashboard');
			}
		}else{
			redirect(base_url().'dashboard');
		}
	}

	

	public function rfidnew(){
		$data['set'] = "new";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['m_admin'] = $this->m_admin;

		$this->load->view('i_rfid', $data);
	}

	public function edit_rfid($id = null) {
		if ($this->session->userdata('userlogin')) { 
			if (isset($id)) {
				$rfid = $this->m_admin->get_rfid_byid($id);
				if (isset($rfid)) {
					foreach ($rfid as $key => $value) {
						$data['id'] = $value->id_rfid;
						$data['nama'] = $value->nama;
						$data['nisn'] = $value->nisn;
						$data['nik'] = $value->nik;
						$data['ttl'] = $value->ttl;
						$data['kelas'] = $value->id_kelas != null ? $this->m_admin->find_kelas($value->id_kelas) : null;
						$data['alamat'] = $value->alamat;
						$data['foto'] = $value->foto;
					}
	
					$data['list_kelas'] = $this->m_admin->get_kelas();
					$data['set'] = "edit-rfid";
	
				
					if ($this->input->post()) {
						$captured_photo = $this->input->post('captured_photo');
						$upload_error = '';
	
						if ($captured_photo) {
							
							$file_name = strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time() . '.png';
							$file_path = './uploads/' . $file_name;
							$captured_photo = str_replace('data:image/png;base64,', '', $captured_photo);
							$captured_photo = str_replace(' ', '+', $captured_photo);
							$image_data = base64_decode($captured_photo);
							file_put_contents($file_path, $image_data);
						} else {
						
							$config['upload_path'] = './uploads/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 0;
							$config['file_name'] = strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time(); 
							$this->load->library('upload', $config);
	
							if (!$this->upload->do_upload('foto')) {
								$upload_error = $this->upload->display_errors();
								$file_name = $data['foto'];
							} else {
								$upload_data = $this->upload->data();
								$file_name = $upload_data['file_name'];
							}
						}
	
						
						$update_data = array(
							'nama' => $this->input->post('nama'),
							'nisn' => $this->input->post('nisn'),
							'nik' => $this->input->post('nik'),
							'ttl' => $this->input->post('ttl'),
							'id_kelas' => $this->input->post('kelas'),
							'alamat' => $this->input->post('alamat'),
							'foto' => isset($file_name) ? $file_name : $data['foto'],
						);
	
					
						$this->m_admin->update_rfid($id, $update_data);
	
					
						$this->session->set_flashdata('success', 'Data RFID berhasil diperbarui!');
						redirect(base_url() . 'edit_rfid/' . $id);
					}
	
				
					$this->load->view('i_rfid', $data);
				} else {
					redirect(base_url() . 'kelas');
				}
			} else {
				redirect(base_url() . 'kelas');
			}
		} else {
			redirect(base_url() . 'login');
		}
	}
	

	public function save_edit_rfid() {
    if ($this->session->userdata('userlogin')) { 
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $nisn = $this->input->post('nisn');
			$nik = $this->input->post('nik');
            $ttl = $this->input->post('ttl');
            $kelas_id = $this->input->post('kelas_id');
            $alamat = $this->input->post('alamat');

          
            $update_data = array(
                'nama' => $nama,
                'nisn' => $nisn,
				'nik' => $nik,
                'ttl' => $ttl,
                'id_kelas' => $kelas_id,
                'alamat' => $alamat,
            );

           
            if ($this->m_admin->updateRFID($id, $update_data)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" id="alert"><i class="glyphicon glyphicon-ok"></i> Data berhasil diupdate</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" id="alert"><i class="glyphicon glyphicon-remove"></i> Data gagal diupdate</div>');
            }

            redirect('lihat_kelas?id_kelas=' . $kelas_id);
        } else {
            $this->session->set_flashdata('error', 'ID tidak ditemukan.');
            redirect('lihat_kelas');
        }
    } else {
        redirect(base_url() . 'login');
    }
}



	public function hapus_rfid($id=null){
		if($this->session->userdata('userlogin'))    
		{ 
			if($this->m_admin->rfid_del($id)){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}
			redirect(base_url().'rfid/datarfid');
		}
	}

   public function absensi(){
    $data['set'] = "absensi";

   
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

  
    $data['absensimasuk'] = $this->m_admin->get_absensi("masuk", $today, $tomorrow);
    $data['absensikeluar'] = $this->m_admin->get_absensi("keluar", $today, $tomorrow);
    $data['m_admin'] = $this->m_admin;

   
    $this->load->view('i_absensi', $data);
}

public function fetch_data() {
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

   
    $absensimasuk = $this->m_admin->get_absensi("masuk", $today, $tomorrow);
    $absensikeluar = $this->m_admin->get_absensi("keluar", $today, $tomorrow);

  
    echo json_encode([
        'absensimasuk' => $absensimasuk,
        'absensikeluar' => $absensikeluar
    ]);
}



	public function lastabsensi(){
		if($this->session->userdata('userlogin'))  
		{
			if (isset($_POST['tanggal'])) {
				$tgl = $this->input->post('tanggal');
				//echo $tgl;
				$split1 = explode("-", $tgl);
				$x = 0;
				foreach ($split1 as $key => $value) {
					$date[$x] = $value;
					$x++;
				}

				$ts1 = strtotime($date[0]);
				$ts2 = strtotime($date[1]);

				$tgl1 = date("d-M-Y",$ts1);
				$tgl2 = date("d-M-Y",$ts2);

				$ts2 += 86400;	

			

				if ($x==2) {
					$data['datamasuk'] = $this->m_admin->get_absensi("masuk",$ts1,$ts2);
					$data['datakeluar'] = $this->m_admin->get_absensi("keluar",$ts1,$ts2);
					$data['tanggal'] = $tgl1 . " - " . $tgl2;
					$data['waktuabsensi'] = $tgl1 . "_" . $tgl2;

					$data['set'] = "last-absensi";
					
					$data['m_admin'] = $this->m_admin;

					$this->load->view('v_absensi', $data);
				}else{
					redirect(base_url().'absensi');
				}				
			}else{
				redirect(base_url().'absensi');
			}
		}
	}
}