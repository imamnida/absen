<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Wad extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('w_admin');
        $this->load->library('bcrypt');
        date_default_timezone_set("asia/jakarta");
    }

	
	public function index()
	{
		$this->load->view('dashboard');
	}

	public function dashboard() {
		
		
	
	
		$this->load->view('include/w_header');
		$this->load->view('wad/w_dashboard');
		$this->load->view('include/footer');
	

	}
	
	
	
	

	
	public function kelas(){
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		
		$data['kelas'] = $this->w_admin->get_kelas();

		$data['w_admin'] = $this->w_admin;

		$this->load->view('wad/w_kelas', $data);

	}

	
	
	public function lihat_kelas(){
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(!isset($_GET['id_kelas'])){
			echo "insert id kelas";
			return;
		}

		$id_kelas = $_GET['id_kelas'];

		$kelas = $this->w_admin->find_kelas($id_kelas);
		$murid = $this->w_admin->get_murid($id_kelas);
		$data['kelas'] = $kelas;
		$data['murid'] = $murid;
		
		$this->load->view('wad/w_kelas_detail',$data);
	}
	
	public function detail_murid($id_murid=null)
	{
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(!$id_murid){
			echo "insert id murid";
			return;
		}

		$murid = $this->w_admin->find_murid($id_murid);

		if (!$murid) {
			echo "murid tidak ditemukan";
			return;
		}

		$this->load->view('wad/w_detail_murid',[
			"murid" => $murid[0],
		]);
	}

	public function rekap_absen($id_kelas = null)
    {
        if(!$this->session->userdata('userlogin')) // mencegah akses langsung tanpa login
        {
            return ;
        }

        if(!$id_kelas){
            echo "insert id kelas";
            return;
        }

        $kelas = $this->w_admin->find_kelas($id_kelas);

        if (!$kelas) {
            echo "kelas tidak ditemukan";
            return;
        }

        $rekap_absen = [];
        if (isset($_GET["tanggalMulai"]) && isset($_GET["tanggalSelesai"])) {
            $tanggal_mulai = strtotime($this->input->get('tanggalMulai'));
            $tanggal_selesai = strtotime($this->input->get('tanggalSelesai')) + 86400; // Tambah 1 hari

            $rekap_absen = $this->w_admin->rekap_absen($id_kelas, $tanggal_mulai, $tanggal_selesai);
        }

        $this->load->view('wad/w_detail_absen', [
            "kelas" => $kelas,
            "rekap_absen" => $rekap_absen,
        ]);
    }

	public function edit_rfid($id=null){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($id)) {
				$rfid = $this->w_admin->get_rfid_byid($id);
				if (isset($rfid)) {
					foreach ($rfid as $key => $value) {
						//print_r($value);
						$data['id'] = $value->id_rfid;
						$data['nama'] = $value->nama;
						$data['nis'] = $value->nis;
						$data['telp'] = $value->telp;
						$data['jabatan'] = $value->jabatan;
						$data['id_kampus'] = $value->id_kampus;
						$data['kelas'] = $value->id_kelas != null ? $this->w_admin->find_kelas($value->id_kelas) : null;
						$data['gender'] = $value->gender;
						$data['alamat'] = $value->alamat;
						$data['rumah'] = $value->rumah;
						$data['foto'] = $value->foto;
						$data['kaka'] = $value->kaka;
						
					}

					$data['list_kelas'] = $this->w_admin->get_kelas();
					$data['list_kampus'] = $this->w_admin->get_kampus();
					$data['set'] = "edit-rfid";
					$this->load->view('wad/wad_edit', $data);
				}else{
					redirect(base_url().'wad/kelas');
				}
			}else{
				redirect(base_url().'wad/kelas');
			}
		}
	}

	
	public function save_edit_rfid(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($_POST['id']) && isset($_POST['nama'])) {
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$nis = $this->input->post('nis');
				$telp = $this->input->post('telp');
				$gender = $this->input->post('gender');
				$kelas_id = $this->input->post('kelas_id');
				$kampus_id = $this->input->post('kampus_id');
				$alamat = $this->input->post('alamat');
				$rumah = $this->input->post('rumah');
				$foto = $this->input->post('foto');
				$kaka = $this->input->post('kaka');
			

				$data = array('nama' => $nama,
								'telp' => $telp,
					      			'nis' => $nis,
								'gender' => $gender,
								'id_kelas' => $kelas_id,
								'id_kampus' => $kampus_id,
								'alamat' => $alamat,
								'rumah' => $rumah,
								'foto' => $alamat,
								'kaka' => $kaka,
			 				);
			


				if ($this->w_admin->updateRFID($id,$data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
				redirect(base_url().'wad/kelas');
			}
		}
	}

	
}
