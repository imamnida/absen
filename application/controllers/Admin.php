<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('bcrypt');
        date_default_timezone_set("asia/jakarta");
    }

	
	public function index()
	{
		redirect(base_url().'admin/dashboard');
	}

	public function dashboard(){
		$data['set'] = "dashboard";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['devices'] = $this->m_admin->get_devices();
		

		$today = strtotime("today");
		$tomorrow = strtotime("tomorrow");

		$data['masuk'] = $this->m_admin->get_absensi("masuk",$today,$tomorrow);
		$data['keluar'] = $this->m_admin->get_absensi("keluar",$today,$tomorrow);

		$this->load->view('i_dashboard', $data);
	}

	public function list_users(){
		$data['set'] = "list-users";
		$data['data'] = $this->m_admin->get_users();
		$this->load->view('i_users', $data);
	}

	public function add_users(){
		$data['set'] = "add-users";
		$this->load->view('i_users', $data);
	}


	public function save_users(){
		if($this->session->userdata('userlogin')){
			$users = $this->input->post('users');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');
			$hash = $this->bcrypt->hash_password($pass);

	        $type = explode('.', $_FILES["image"]["name"]);
			$type = strtolower($type[count($type)-1]);
			$imgname = uniqid(rand()).'.'.$type;
			$url = "vertical/assets/images/".$imgname;
			if(in_array($type, array("jpg", "jpeg", "gif", "png"))){
				if(is_uploaded_file($_FILES["image"]["tmp_name"])){
					if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){
						$data = array(
				                'nama'    => $users,
				                'email'   => $email,
				                'username'=> $username,
				                'password'=> $hash,
				                'avatar'  => $imgname,
				        );
						$this->m_admin->insert_users($data);
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
					}
				}
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
			}
	        
			redirect(base_url().'admin/list_users');
		}
	}

	
	public function hapus_users($id=null){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{ 
			$path = "";
			$filename = $this->m_admin->get_user_byid($id);
			foreach ($filename as $key) {
				$file = $key->avatar;
				$path = "vertical/assets/images/".$file;
			}
			
			//echo $path;

			if(file_exists($path)){
				unlink($path);
				if($this->m_admin->users_del($id)){
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}
			}else{
				if($this->m_admin->users_del($id)){
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus image gagal dihapus</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
				}
			}

			redirect(base_url().'admin/list_users');
		}
	}


	public function edit_users($id=null){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($id)) {
				$user = $this->m_admin->get_user_byid($id);
				foreach ($user as $key => $value) {
					//print_r($value);
					$data['id'] = $id;
					$data['nama'] = $value->nama;
					$data['email'] = $value->email;
					$data['username'] = $value->username;
					$data['password'] = $value->password;
					$data['avatar'] = $value->avatar;
				}
				$data['set'] = "edit-users";
				$this->load->view('i_users', $data);

			}else{
				redirect(base_url().'admin/list_users');
			}
		}
	}

	public function save_edit_users(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($_POST['id']) && isset($_POST['email'])) {
				$id = $this->input->post('id');
				$email = $this->input->post('email');
				$nama = $this->input->post('users');
				$username = $this->input->post('username');
				$pass = $this->input->post('pass');
				$hash = $this->bcrypt->hash_password($pass);


				$type = explode('.', $_FILES["image"]["name"]);
				$type = strtolower($type[count($type)-1]);
				$imgname = uniqid(rand()).'.'.$type;
				$url = "vertical/assets/images/".$imgname;
				if(in_array($type, array("jpg", "jpeg", "gif", "png"))){
					if(is_uploaded_file($_FILES["image"]["tmp_name"])){
						if(move_uploaded_file($_FILES["image"]["tmp_name"],$url)){
							$data = array(
					                'nama'    => $users,
					                'email'   => $email,
					                'username'=> $username,
					                'avatar'  => $imgname,
					        );
					        $file = $this->input->post('img');
							$path = "vertical/assets/images/".$file;

							if(file_exists($path)){
								unlink($path);
							}
							$this->m_admin->updateUser($id, $data);
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
						}
					}
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
				}

				if(isset($_POST['changepass'])){
					$data = array(		'email' => $email,
										'nama' => $nama,
										'username'=> $username,
						                'password'=> $hash,
				 				);
					if ($this->m_admin->updateUser($id,$data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					}else{
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}
				}else{
					$data = array(		'email' => $email,
										'nama' => $nama,
										'username'=> $username,
				 				);
					if ($this->m_admin->updateUser($id,$data)) {
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
					}else{
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
					}				
				}

				redirect(base_url().'admin/list_users');
			}
		}
	}


	public function devices(){
		$data['set'] = "devices";
		$data['devices'] = $this->m_admin->get_devices();

		$this->load->view('i_devices', $data);
	}

	public function add_devices(){
		$data['set'] = "add-devices";
		$this->load->view('i_devices', $data);
	}

	public function save_devices(){
		if($this->session->userdata('userlogin')){
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');

			//$duplicate = $this->m_admin->get_devices_byid_row($id);
			//$hasil = count($duplicate);


			if (false) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> ID Alat sudah terdaftar, ganti ID Alat</div>");
			}else{
				$data = array(
		                'nama_devices'  => $nama, 'mode'  => 'SCAN',
		        );
							
				if($this->m_admin->insert_devices($data)){
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");

				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
				}
			}
	        
			redirect(base_url().'admin/devices');
		}
	}

	public function hapus_devices($id=null){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{ 
			if($this->m_admin->devices_del($id)){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}
			
			redirect(base_url().'admin/devices');
		}
	}

	public function edit_devices($id=null){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($id)) {
				
				$devices = $this->m_admin->get_devices_byid($id);
				if (isset($devices)) {
					foreach ($devices as $key => $value) {
						//print_r($value);
						$data['id'] = $value->id_devices;
						$data['nama_devices'] = $value->nama_devices;
					}
					$data['set'] = "edit-devices";
					$this->load->view('i_devices', $data);
				}
				
			}else{
				redirect(base_url().'admin/devices');
			}
		}
	}

	public function edit_devices_mode($id=null){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($id)) {
				
				$devices = $this->m_admin->get_devices_byid($id);
				if (isset($devices)) {
					foreach ($devices as $key => $value) {
						//print_r($value);
						$data['id'] = $value->id_devices;
						$data['mode'] = $value->mode;
					}
					$data['set'] = "edit-devices-mode";
					$this->load->view('i_devices', $data);
				}
				
			}else{
				redirect(base_url().'admin/devices');
			}
		}
	}

	public function save_edit_devices(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($_POST['id']) && isset($_POST['nama'])) {
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');

				$data = array('nama_devices' => $nama,
			 				);

				if ($this->m_admin->updateDevices($id,$data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
				redirect(base_url().'admin/devices');
			}
		}
	}

	public function save_edit_devices_mode(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			$id = $this->input->post('id');
			$mode = $this->input->post('mode');
			
			if ($mode) {
				$data = array('mode' => 'ADD', );
			}else{
				$data = array('mode' => 'SCAN', );
			}


			if ($this->m_admin->updateDevices($id,$data)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Mode berhasil di update</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Mode gagal di update</div>");
			}
			redirect(base_url().'admin/devices');

		}
	}


	public function histori(){
		$data['set'] = "histori";
		$data['histori'] = $this->m_admin->get_history();

		$this->load->view('i_histori', $data);

	}


	public function hapus_histori(){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{ 

			if($this->m_admin->empty_data()){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Histori berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Histori gagal di hapus</div>");
			}

			redirect(base_url().'admin/histori');
		}
	}

	public function rfid($data=null){
		if (isset($data)) {
			if ($data == "datarfid") {
				$this->datarfid();
			}else if ($data == "rfidnew") {
				$this->rfidnew();
			}else{
				redirect(base_url().'admin/dashboard');
			}
		}else{
			redirect(base_url().'admin/dashboard');
		}
	}

	public function datarfid(){
		$data['set'] = "rfid";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['m_admin'] = $this->m_admin;
		$this->load->view('i_rfid', $data);
	}

	public function rfidnew(){
		$data['set'] = "new";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['m_admin'] = $this->m_admin;

		$this->load->view('i_rfid', $data);
	}

	public function edit_rfid($id=null){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($id)) {
				$rfid = $this->m_admin->get_rfid_byid($id);
				if (isset($rfid)) {
					foreach ($rfid as $key => $value) {
						//print_r($value);
						$data['id'] = $value->id_rfid;
						$data['nama'] = $value->nama;
						$data['nis'] = $value->nis;
						$data['telp'] = $value->telp;
						$data['jabatan'] = $value->jabatan;
						$data['kelas'] = $value->id_kelas != null ? $this->m_admin->find_kelas($value->id_kelas) : null;
						$data['gender'] = $value->gender;
						$data['alamat'] = $value->alamat;
					}

					$data['list_kelas'] = $this->m_admin->get_kelas();
					$data['list_kampus'] = $this->m_admin->get_kampus();
					$data['set'] = "edit-rfid";
					$this->load->view('i_rfid', $data);
				}else{
					redirect(base_url().'admin/rfid/datarfid');
				}
			}else{
				redirect(base_url().'admin/rfid/datarfid');
			}
		}
	}

	public function save_edit_rfid(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($_POST['id']) && isset($_POST['nama'])) {
				$id = $this->input->post('id');
				$nama = $this->input->post('nama');
				$telp = $this->input->post('telp');
				$gender = $this->input->post('gender');
				$kelas_id = $this->input->post('kelas_id');
				$kampus_id = $this->input->post('kampus_id');
				$alamat = $this->input->post('alamat');

				$data = array('nama' => $nama,
								'telp' => $telp,
								'gender' => $gender,
								'id_kelas' => $kelas_id,
								'id_kampus' => $kampus_id,
								'alamat' => $alamat,
			 				);
				//echo $id;
				//print_r($data);

				if ($this->m_admin->updateRFID($id,$data)) {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
				}
				redirect(base_url().'admin/rfid/datarfid');
			}
		}
	}


	public function hapus_rfid($id=null){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{ 
			if($this->m_admin->rfid_del($id)){
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
			}else{
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
			}
			redirect(base_url().'admin/rfid/datarfid');
		}
	}

	public function absensi(){
		$data['set'] = "absensi";

		$today = strtotime("today");
		$tomorrow = strtotime("tomorrow");

		$data['absensimasuk'] = $this->m_admin->get_absensi("masuk",$today,$tomorrow);
		$data['absensikeluar'] = $this->m_admin->get_absensi("keluar",$today,$tomorrow);
		$data['m_admin'] = $this->m_admin;
		$this->load->view('i_absensi', $data);
	}

	public function lastabsensi(){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
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

				$ts2 += 86400;	// tambah 1 hari (hitungan detik)

				// $data['tgl1'] = $tgl1;
				// $data['tgl2'] = $tgl2;

				if ($x==2) {
					$data['datamasuk'] = $this->m_admin->get_absensi("masuk",$ts1,$ts2);
					$data['datakeluar'] = $this->m_admin->get_absensi("keluar",$ts1,$ts2);
					$data['tanggal'] = $tgl1 . " - " . $tgl2;
					$data['waktuabsensi'] = $tgl1 . "_" . $tgl2;

					$data['set'] = "last-absensi";
					
					$data['m_admin'] = $this->m_admin;

					$this->load->view('v_absensi', $data);
				}else{
					redirect(base_url().'admin/absensi');
				}				
			}else{
				redirect(base_url().'admin/absensi');
			}
		}
	}

	public function kampus()
	{
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		$kampus = $this->m_admin->get_kampus();

		$data["kampus"] = $kampus;

		$this->load->view('i_kampus', $data);
	}

	public function hapus_kampus()
	{
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(!isset($_GET['id_kampus'])){
			echo "insert id kampus";
			return;
		}

		$id_kampus = $_GET['id_kampus'];

		$kampus = $this->m_admin->hapus_kampus($id_kampus);
		
		
		redirect(base_url().'admin/kampus');
	}

	public function kelas(){
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(isset($_POST['kelas'])){
			$kelas = [
				'kelas' => $_POST['kelas']
			];

			$this->m_admin->insert_kelas($kelas);

			$data['message'] = "Berhasil menambahkan kelas"; 
			
		}

		$data['kelas'] = $this->m_admin->get_kelas();

		$data['m_admin'] = $this->m_admin;

		$this->load->view('i_kelas', $data);

	}

	public function tambah_kelas(){
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

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

		$kelas = $this->m_admin->find_kelas($id_kelas);
		$murid = $this->m_admin->get_murid($id_kelas);
		$data['kelas'] = $kelas;
		$data['murid'] = $murid;
		
		$this->load->view('i_kelas_detail',$data);
	}
	public function hapus_kelas(){
		if(!$this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(!isset($_GET['id_kelas'])){
			echo "insert id kelas";
			return;
		}

		$id_kelas = $_GET['id_kelas'];

		$kelas = $this->m_admin->hapus_kelas($id_kelas);
		
		
		redirect(base_url().'admin/kelas');
		
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

		$murid = $this->m_admin->find_murid($id_murid);

		if (!$murid) {
			echo "murid tidak ditemukan";
			return;
		}

		$this->load->view('i_detail_murid',[
			"murid" => $murid[0],
		]);
	}

	public function rekap_absen($id_kelas=null)
	{
		if(!$this->session->userdata('userlogin')) // mencegah akses langsung tanpa login
		{
			return ;
		}

		if(!$id_kelas){
			echo "insert id kelas";
			return;
		}

		$kelas = $this->m_admin->find_kelas($id_kelas);

		if (!$kelas) {
			echo "kelas tidak ditemukan";
			return;
		}

		$rekap_absen = [];
		if (isset($_GET["tanggalMulai"]) && isset($_GET["tanggalSelesai"])) {
			$tanggal_mulai = $this->input->get('tanggalMulai');
			$tanggal_selesai = $this->input->get('tanggalSelesai');

			$tanggal_mulai = strtotime($tanggal_mulai);
			$tanggal_selesai = strtotime($tanggal_selesai);

			$tanggal_selesai += 86400;	// tambah 1 hari (hitungan detik)
			$rekap_absen = $this->m_admin->rekap_absen($id_kelas, $tanggal_mulai, $tanggal_selesai);
		}

		$this->load->view('i_detail_absen',[
			"kelas" => $kelas,
			"rekap_absen" => $rekap_absen,
		]);

	}

	public function rekapAbsen2excel(Type $var = null)
	{
		if(!$this->session->userdata('userlogin'))  
		{
			return ;
		}

		if(!isset($_GET['id_kelas'])){
			echo "insert id kelas";
			return;
		}
		
		$tanggal_mulai = $this->input->get('tanggalMulai');
		$tanggal_selesai = $this->input->get('tanggalSelesai');
		

		$alphabet = range('A','Z');

		$begin = new DateTime($tanggal_mulai);
		$end   = new DateTime($tanggal_selesai);

		$diff = $begin->diff($end)->format("%a");

		if($diff > 13){
			echo  "maksimal 14 hari";
			return;
		}


		$id_kelas = $_GET['id_kelas'];

		$kelas = $this->m_admin->find_kelas($id_kelas);

		$murid = $this->m_admin->get_murid($id_kelas);

		if(!$murid){
			echo "murid untiuk kelas ini kosong";
			return;
		}


		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'Nama');

		$k = 2;
		foreach ($murid as $mrd) {
			$spreadsheet->setActiveSheetIndex(0)->setCellValue("A".$k,$mrd->nama);
			$k++;
		}
		
		$j = 1;
		for($i = $begin; $i <= $end; $i->modify('+1 day')){
			$spreadsheet->setActiveSheetIndex(0)->setCellValue($alphabet[$j]."1",$i->format("D"));
			$k = 2;
			foreach ($murid as $mrd) {
				$jam_masuk = $this->m_admin->get_jam_masuk($mrd->id_rfid,strtotime($i->format('Y-m-d')));
				if($jam_masuk->num_rows() > 0 ){
					$masuk = $jam_masuk->row();
					$waktu = date("H:i:s d M Y", $masuk->created_at);
				}else{
					$waktu = "-";
				}
				$spreadsheet->setActiveSheetIndex(0)->setCellValue($alphabet[$j].$k,$waktu);
				$k++;
			}
			$j++;
		}
			
		// return;
		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Absensi_KELAS_'.$kelas->kelas.'_'.$tanggal_mulai.'_'.$tanggal_selesai.'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');

		// echo $tanggal;
	}


	public function export2excel(){
		if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
		{
			if (isset($_GET['tanggal'])) {
				$tanggal = $this->input->get('tanggal');
				//echo $tanggal;

				$split = explode("_", $tanggal);
				$x = 0;
				foreach ($split as $key => $value) {
					$date[$x] = $value;
					$x++;
				}

				$ts1 = strtotime($date[0]);
				$ts2 = strtotime($date[1]);

				$ts2 += 86400;	// tambah 1 hari (hitungan detik)

				$datamasuk = $this->m_admin->get_absensi("masuk",$ts1,$ts2);
				$datakeluar = $this->m_admin->get_absensi("keluar",$ts1,$ts2);

				$spreadsheet = new Spreadsheet;

				$spreadsheet->setActiveSheetIndex(0)
				          ->setCellValue('A1', 'No')
				          ->setCellValue('B1', 'Alat Absensi')
				          ->setCellValue('C1', 'Nama')
				          ->setCellValue('D1', 'Kelas')
				          ->setCellValue('E1', 'Keterangan')
				          ->setCellValue('F1', 'Waktu');

				$baris = 2;
				$spreadsheet->setActiveSheetIndex(0)
				               ->setCellValue('A' . $baris, "ABSENSI MASUK");
				$baris++;
				$nomor = 1;

				if (isset($datamasuk)){
					foreach($datamasuk as $masuk) {

						$waktu = date("H:i:s d M Y", $masuk->created_at);

						$kelas = "-"; 

						if($masuk->id_kelas != null){
							$kelas = $this->m_admin->find_kelas($masuk->id_kelas);
							$kelas = $kelas->kelas;
						}

						$spreadsheet->setActiveSheetIndex(0)
								   ->setCellValue('A' . $baris, $nomor."")
								   ->setCellValue('B' . $baris, $masuk->nama_devices)
								   ->setCellValue('C' . $baris, $masuk->nama)
								   ->setCellValue('D' . $baris, $kelas)
								   ->setCellValue('E' . $baris, $masuk->keterangan)
								   ->setCellValue('F' . $baris, $waktu);

					   $baris++;
					   $nomor++;

					}
				}


				$baris ++;
				$spreadsheet->setActiveSheetIndex(0)
				               ->setCellValue('A' . $baris, "ABSENSI KELUAR");
				$baris ++;
				$nomor = 1;

				if (isset($datakeluar)){
					foreach($datakeluar as $keluar) {

						$waktu = date("H:i:s d M Y", $keluar->created_at);

						$kelas = "-"; 

						if($masuk->id_kelas != null){
							$kelas = $this->m_admin->find_kelas($masuk->id_kelas);
							$kelas = $kelas->kelas;
						}

						$spreadsheet->setActiveSheetIndex(0)
								   ->setCellValue('A' . $baris, $nomor."")
								   ->setCellValue('B' . $baris, $keluar->nama_devices)
								   ->setCellValue('C' . $baris, $keluar->nama)
								   ->setCellValue('D' . $baris, $kelas)
								   ->setCellValue('E' . $baris, $keluar->keterangan)
								   ->setCellValue('F' . $baris, $waktu);

					   $baris++;
					   $nomor++;

					}
				}
				
				$writer = new Xlsx($spreadsheet);

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Absensi_'.$tanggal.'.xlsx"');
				header('Cache-Control: max-age=0');

				$writer->save('php://output');
			}else{
				redirect(base_url().'admin/absensi');
			}
		}
				
     }
	
	public function setting()
	{
		$data['set'] = "setting";
		$data['key'] = $this->m_admin->getkey();
		$data['waktuoperasional'] = $this->m_admin->waktuoperasional();
		//print_r($data);
		$this->load->view('i_setting', $data);
	
	}

	public function setwaktuoperasional(){
		if($this->session->userdata('userlogin')){     // mencegah akses langsung tanpa login
			if (isset($_POST['masuk']) && isset($_POST['keluar'])) {
				$masuk = $this->input->post('masuk');
				$keluar = $this->input->post('keluar');

				if (strlen($masuk) == 11 && strlen($keluar) == 11){
					if ($masuk[2] == ":" && $masuk[5] == "-" && $masuk[8] == ":" && $keluar[2] == ":" && $keluar[5] == "-" && $keluar[8] == ":"){
						$datamasuk = array('waktu_operasional' => $masuk);
						$datakeluar = array('waktu_operasional' => $keluar);

						if ($this->m_admin->updateWaktuOperasional(1,$datamasuk)) {
							$this->m_admin->updateWaktuOperasional(2,$datakeluar);
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di update</div>");
						}else{
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di update</div>");
						}
					}else{
						$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Salah format waktu, contoh 16:00-17:00</div>");
					}
				}else{
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Salah format waktu, contoh 16:00-17:00</div>");
				}
				redirect(base_url().'admin/setting');
			}
		}
	}
	
}
