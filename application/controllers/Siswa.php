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
						$data['tempat_lahir'] = $value->tempat_lahir;
						$data['tanggal_lahir'] = $value->tanggal_lahir;
						$data['kelas'] = $value->id_kelas != null ? $this->m_data->find_kelas($value->id_kelas) : null;
						$data['alamat'] = $value->alamat;
						$data['foto'] = $value->foto;
					}
	
					$data['list_kelas'] = $this->m_data->get_kelas();
					$data['set'] = "edit-siswa";
					$this->load->view('i_siswa', $data);
				} else {
					redirect(base_url() . 'siswa');
				}
			} else {
				redirect(base_url() . 'siswa');
			}
		} else {
			redirect(base_url() . 'login');
		}
	}
	
	public function save_edit_siswa() {
		if ($this->session->userdata('userlogin')) { 
			if ($this->input->post('id')) {
				$id = $this->input->post('id');
				
				// Inisialisasi variabel foto
				$foto = $this->input->post('old_foto');
				
				// Handle file upload if a new photo is provided
				if (!empty($_FILES['foto']['name'])) {
					// Buat direktori upload jika belum ada
					if (!is_dir('./uploads/')) {
						mkdir('./uploads/', 0777, true);
					}
	
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = '*'; // Mengizinkan semua tipe file
					$config['file_name'] = strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time();
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if ($this->upload->do_upload('foto')) {
						$upload_data = $this->upload->data();
						$foto = $upload_data['file_name'];
						
						// Hapus foto lama jika ada dan bukan foto default
						$old_foto = $this->input->post('old_foto');
						if ($old_foto && file_exists('./uploads/' . $old_foto) && $old_foto != 'default.jpg') {
							@unlink('./uploads/' . $old_foto);
						}
					} else {
						// Jika upload gagal, tampilkan pesan error tapi tetap lanjut update data lain
						$error = $this->upload->display_errors();
						if (strpos($error, 'upload_path_does_not_exist') !== false) {
							// Coba buat direktori jika belum ada
							mkdir('./uploads/', 0777, true);
							// Coba upload lagi
							if ($this->upload->do_upload('foto')) {
								$upload_data = $this->upload->data();
								$foto = $upload_data['file_name'];
							} else {
								$this->session->set_flashdata('pesan', '<div class="alert alert-warning" id="alert"><i class="glyphicon glyphicon-warning-sign"></i> Foto gagal diupload. Data lain tetap diupdate.</div>');
								$foto = $this->input->post('old_foto');
							}
						} else {
							$this->session->set_flashdata('pesan', '<div class="alert alert-warning" id="alert"><i class="glyphicon glyphicon-warning-sign"></i> Foto gagal diupload. Data lain tetap diupdate.</div>');
							$foto = $this->input->post('old_foto');
						}
					}
				}
	
				$update_data = array(
					'nama' => $this->input->post('nama'),
					'nisn' => $this->input->post('nisn'),
					'nik' => $this->input->post('nik'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					'id_kelas' => $this->input->post('kelas_id'),
					'alamat' => $this->input->post('alamat'),
					'foto' => $foto
				);
	
				if ($this->m_data->updatesiswa($id, $update_data)) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" id="alert"><i class="glyphicon glyphicon-ok"></i> Data berhasil diupdate</div>');
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" id="alert"><i class="glyphicon glyphicon-remove"></i> Data gagal diupdate</div>');
				}
	
				redirect('siswa');
			} else {
				$this->session->set_flashdata('error', 'ID tidak ditemukan.');
				redirect('siswa');
			}
		} else {
			redirect(base_url() . 'login');
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



	
}