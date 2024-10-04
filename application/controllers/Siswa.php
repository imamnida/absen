<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
	
        date_default_timezone_set("asia/jakarta");
    }

	
    public function index(){
		$data['set'] = "siswa";
		$data['siswa'] = $this->m_data->get_siswa();
		$data['m_data'] = $this->m_data;
		$this->load->view('i_siswa', $data);
	}

    public function siswa($data=null){
		if (isset($data)) {
			if ($data == "datasiswa") {
				$this->datasiswa();
			}else if ($data == "siswanew") {
				$this->siswanew();
			}else{
				redirect(base_url().'dashboard');
			}
		}else{
			redirect(base_url().'dashboard');
		}
	}

	

	public function siswanew(){
		$data['set'] = "new";
		$data['siswa'] = $this->m_data->get_siswa();
		$data['m_data'] = $this->m_data;

		$this->load->view('i_siswa', $data);
	}

	public function edit_siswa($id = null) {
		if ($this->session->userdata('userlogin')) { 
			if (isset($id)) {
				$siswa = $this->m_data->get_siswa_byid($id);
				if (isset($siswa)) {
					foreach ($siswa as $key => $value) {
						$data['id'] = $value->id_siswa;
						$data['nama'] = $value->nama;
						$data['nisn'] = $value->nisn;
						$data['nik'] = $value->nik;
						$data['ttl'] = $value->ttl;
						$data['kelas'] = $value->id_kelas != null ? $this->m_data->find_kelas($value->id_kelas) : null;
						$data['alamat'] = $value->alamat;
						$data['foto'] = $value->foto;
					}
	
					$data['list_kelas'] = $this->m_data->get_kelas();
					$data['set'] = "edit-siswa";
	
				
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
	
					
						$this->m_data->update_siswa($id, $update_data);
	
					
						$this->session->set_flashdata('success', 'Data siswa berhasil diperbarui!');
						redirect(base_url() . 'edit_siswa/' . $id);
					}
	
				
					$this->load->view('i_siswa', $data);
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
	

	public function save_edit_siswa() {
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

           
            if ($this->m_data->updatesiswa($id, $update_data)) {
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



	public function hapus_siswa($id=null){
		if($this->session->userdata('userlogin'))    
		{ 
			if($this->m_data->siswa_del($id)){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}
			redirect(base_url().'siswa/datasiswa');
		}
	}

   public function absensi(){
    $data['set'] = "absensi";

   
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

  
    $data['absensimasuk'] = $this->m_data->get_absensi("masuk", $today, $tomorrow);
    $data['absensikeluar'] = $this->m_data->get_absensi("keluar", $today, $tomorrow);
    $data['m_data'] = $this->m_data;

   
    $this->load->view('i_absensi', $data);
}

public function fetch_data() {
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

   
    $absensimasuk = $this->m_data->get_absensi("masuk", $today, $tomorrow);
    $absensikeluar = $this->m_data->get_absensi("keluar", $today, $tomorrow);

  
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
					$data['datamasuk'] = $this->m_data->get_absensi("masuk",$ts1,$ts2);
					$data['datakeluar'] = $this->m_data->get_absensi("keluar",$ts1,$ts2);
					$data['tanggal'] = $tgl1 . " - " . $tgl2;
					$data['waktuabsensi'] = $tgl1 . "_" . $tgl2;

					$data['set'] = "last-absensi";
					
					$data['m_data'] = $this->m_data;

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