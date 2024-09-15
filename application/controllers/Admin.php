<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

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

	public function dashboard() {
		$data['set'] = "dashboard";
		$data['rfid'] = $this->m_admin->get_rfid();
		$data['devices'] = $this->m_admin->get_devices();
		$data['kelas'] = $this->m_admin->get_kelas_byrow();
	
		$today = date('Y-m-d'); // Menggunakan format tanggal Y-m-d untuk mendapatkan hari ini
		$tomorrow = date('Y-m-d', strtotime('tomorrow')); // Menggunakan format tanggal Y-m-d untuk mendapatkan besok
	
		$data['masuk'] = $this->m_admin->get_absensi("masuk", strtotime("today"), strtotime("tomorrow"));
		$data['keluar'] = $this->m_admin->get_absensi("keluar", strtotime("today"), strtotime("tomorrow"));
	    $data['izin'] = $this->m_admin->get_absensi("izin", strtotime("today"), strtotime("tomorrow"));
		$data['sakit'] = $this->m_admin->get_absensi("sakit", strtotime("today"), strtotime("tomorrow"));
	
		$jumlah_tidak_absensi = $this->m_admin->hitung_tidak_absensi();

		// Kemudian kirimkan hasilnya ke tampilan
		$data['jumlah_tidak_absensi'] = $jumlah_tidak_absensi;
		$this->load->view('i_dashboard', $data);
	}
	
	// Fungsi untuk menghitung jumlah pengguna RFID yang tidak melakukan absensi hari ini
	
	

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
	
			if (!empty($_FILES["image"]["name"])) {
				$type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
				$type = strtolower($type);
				$imgname = uniqid(rand()) . '.' . $type;
				$url = "assets/images/" . $imgname;
	
				if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
							$data = array(
								'nama'    => $users,
								'email'   => $email,
								'username'=> $username,
								'password'=> $hash,
								'avatar'  => $imgname,
							);
							$this->m_admin->insert_users($data);
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil disimpan</div>");
						}
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal disimpan, ekstensi gambar salah</div>");
				}
			}
			
			redirect(base_url().'admin/list_users');
		}
	}
	
	public function hapus_users($id = null){
		if($this->session->userdata('userlogin')){
			$filename = $this->m_admin->get_user_byid($id);
			$file = isset($filename->avatar) ? $filename->avatar : null;
			$path = "assets/images/" . $file;
	
			if ($file && file_exists($path)) {
				unlink($path);
			}
	
			if ($this->m_admin->users_del($id)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil dihapus</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal dihapus</div>");
			}
	
			redirect(base_url().'admin/list_users');
		}
	}
	
	public function edit_users($id = null){
		if($this->session->userdata('userlogin') && isset($id)){
			$user = $this->m_admin->get_user_byid($id);
	
			if ($user) {
				$data = array(
					'id'       => $id,
					'nama'     => $user->nama,
					'email'    => $user->email,
					'username' => $user->username,
					'password' => $user->password,
					'avatar'   => $user->avatar,
					'set'      => "edit-users"
				);
				$this->load->view('i_users', $data);
			} else {
				redirect(base_url().'admin/list_users');
			}
		}
	}
	
	public function save_edit_users(){
		if($this->session->userdata('userlogin') && isset($_POST['id']) && isset($_POST['email'])){
			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$nama = $this->input->post('users');
			$username = $this->input->post('username');
			$pass = $this->input->post('pass');
			$hash = $this->bcrypt->hash_password($pass);
	
			if (!empty($_FILES["image"]["name"])) {
				$type = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
				$type = strtolower($type);
				$imgname = uniqid(rand()) . '.' . $type;
				$url = "assets/images/" . $imgname;
	
				if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
					if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $url)) {
							$file = $this->input->post('img');
							$path = "assets/images/" . $file;
	
							if (file_exists($path)) {
								unlink($path);
							}
	
							$data = array(
								'nama'     => $nama,
								'email'    => $email,
								'username' => $username,
								'avatar'   => $imgname,
							);
	
							$this->m_admin->updateUser($id, $data);
							$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil disimpan</div>");
						}
					}
				} else {
					$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal disimpan, ekstensi gambar salah</div>");
				}
			}
	
			if (isset($_POST['changepass'])) {
				$data = array(
					'email'    => $email,
					'nama'     => $nama,
					'username' => $username,
					'password' => $hash,
				);
			} else {
				$data = array(
					'email'    => $email,
					'nama'     => $nama,
					'username' => $username,
				);
			}
	
			if ($this->m_admin->updateUser($id, $data)) {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil diupdate</div>");
			} else {
				$this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal diupdate</div>");
			}
	
			redirect(base_url().'admin/list_users');
		}
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

	public function edit_rfid($id = null) {
		if ($this->session->userdata('userlogin')) { // Prevent direct access without login
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
	
					// If form is submitted
					if ($this->input->post()) {
						$captured_photo = $this->input->post('captured_photo');
						$upload_error = '';
	
						if ($captured_photo) {
							// Handle photo captured from the camera
							$file_name = strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time() . '.png';
							$file_path = './uploads/' . $file_name;
							$captured_photo = str_replace('data:image/png;base64,', '', $captured_photo);
							$captured_photo = str_replace(' ', '+', $captured_photo);
							$image_data = base64_decode($captured_photo);
							file_put_contents($file_path, $image_data);
						} else {
							// Handle uploaded file
							$config['upload_path'] = './uploads/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 0;
							$config['file_name'] = strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time(); // Set file name based on user's name
	
							$this->load->library('upload', $config);
	
							if (!$this->upload->do_upload('foto')) {
								$upload_error = $this->upload->display_errors();
								$file_name = $data['foto']; // Use old photo if error occurs
							} else {
								$upload_data = $this->upload->data();
								$file_name = $upload_data['file_name'];
							}
						}
	
						// Data to be updated
						$update_data = array(
							'nama' => $this->input->post('nama'),
							'nisn' => $this->input->post('nisn'),
							'nik' => $this->input->post('nik'),
							'ttl' => $this->input->post('ttl'),
							'id_kelas' => $this->input->post('kelas'),
							'alamat' => $this->input->post('alamat'),
							'foto' => isset($file_name) ? $file_name : $data['foto'], // Use old photo if no new photo
						);
	
						// Update RFID data
						$this->m_admin->update_rfid($id, $update_data);
	
						// Set success message and redirect to edit page
						$this->session->set_flashdata('success', 'Data RFID berhasil diperbarui!');
						redirect(base_url() . 'admin/edit_rfid/' . $id);
					}
	
					// Load view for edit form
					$this->load->view('i_rfid', $data);
				} else {
					redirect(base_url() . 'admin/kelas');
				}
			} else {
				redirect(base_url() . 'admin/kelas');
			}
		} else {
			redirect(base_url() . 'login'); // Redirect to login page if not logged in
		}
	}
	

	public function save_edit_rfid() {
    if ($this->session->userdata('userlogin')) { // Prevent direct access without login
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $nisn = $this->input->post('nisn');
			$nik = $this->input->post('nik');
            $ttl = $this->input->post('ttl');
            $kelas_id = $this->input->post('kelas_id');
            $alamat = $this->input->post('alamat');

            // Prepare data for update without modifying photo
            $update_data = array(
                'nama' => $nama,
                'nisn' => $nisn,
				'nik' => $nik,
                'ttl' => $ttl,
                'id_kelas' => $kelas_id,
                'alamat' => $alamat,
            );

            // Update RFID data
            if ($this->m_admin->updateRFID($id, $update_data)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" id="alert"><i class="glyphicon glyphicon-ok"></i> Data berhasil diupdate</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" id="alert"><i class="glyphicon glyphicon-remove"></i> Data gagal diupdate</div>');
            }

            redirect('admin/lihat_kelas?id_kelas=' . $kelas_id);
        } else {
            $this->session->set_flashdata('error', 'ID tidak ditemukan.');
            redirect('admin/lihat_kelas');
        }
    } else {
        redirect(base_url() . 'login'); // Redirect to login page if not logged in
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

    // Set today's and tomorrow's timestamps for filtering
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

    // Get absensi data for masuk and keluar
    $data['absensimasuk'] = $this->m_admin->get_absensi("masuk", $today, $tomorrow);
    $data['absensikeluar'] = $this->m_admin->get_absensi("keluar", $today, $tomorrow);
    $data['m_admin'] = $this->m_admin;

    // Load the absensi view with data
    $this->load->view('i_absensi', $data);
}

public function fetch_data() {
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

    // Fetch updated data from the model
    $absensimasuk = $this->m_admin->get_absensi("masuk", $today, $tomorrow);
    $absensikeluar = $this->m_admin->get_absensi("keluar", $today, $tomorrow);

    // Return JSON response
    echo json_encode([
        'absensimasuk' => $absensimasuk,
        'absensikeluar' => $absensikeluar
    ]);
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

		if (isset($_POST['kampus'])) {

			$this->m_admin->insert_kampus([
				"kampus" => $_POST['kampus'],
			]);

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
			$id_kelas = $_GET['id_kelas'];

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
	public function alfa() {
		$this->load->model('M_admin');

		// Panggil fungsi untuk mendapatkan daftar kelas
		$kelas = $this->M_admin->get_kelas();
	
		// Buat array untuk menyimpan jumlah siswa yang tidak hadir selama 3 hari berturut-turut untuk setiap kelas
		$jumlah_tidak_absensi_per_kelas = array();
	
		// Loop untuk setiap kelas
		foreach ($kelas as $kelas_item) {
			// Tentukan ID kelas yang ingin Anda periksa absensinya
			$id_kelas = $kelas_item->id; 
	
			// Panggil fungsi untuk mendapatkan siswa yang tidak hadir dalam kelas ini selama 3 hari berturut-turut
			$siswa_tidak_hadir_kelas = $this->M_admin->siswa_tidak_hadir_3_hari_berturut_turut($id_kelas);
	
			// Hitung jumlah siswa yang tidak hadir
			$jumlah_tidak_absensi = count($siswa_tidak_hadir_kelas);
	
			// Simpan jumlah siswa yang tidak hadir selama 3 hari berturut-turut untuk kelas ini
			$jumlah_tidak_absensi_per_kelas[$id_kelas] = $jumlah_tidak_absensi;
		}
	
		// Kirim data ke view
		$data['kelas'] = $kelas;
		$data['jumlah_tidak_absensi_per_kelas'] = $jumlah_tidak_absensi_per_kelas;
	
		// Load view yang sesuai
		$this->load->view('i_alfa', $data);
	}
	

	
	

	public function lihat_alfa(){
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
		
		$this->load->view('i_siswa_alfa',$data);
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

	public function alfa_detail($id_murid=null)
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

		$this->load->view('i_siswa_alfa_detail',[
			"murid" => $murid[0],
		]);
	}
	public function hapus_murid($id_rfid) {
		// Load the model if it's not already loaded
		$this->load->model('M_admin');
	
		// ini adalah yang bisa berjalan dengan b
		$murid = $this->M_admin->find_murid($id_rfid);
		if ($murid) {
			$id_kelas = $murid[0]->id_kelas; // Assuming id_kelas is a field in the murid table
		} else {
			$this->session->set_flashdata('error', 'Murid tidak ditemukan.');
			redirect('admin/lihat_kelas'); // Redirect to a default page or handle error appropriately
			return;
		}
	
		// Call a method in your model to delete the student
		$result = $this->M_admin->delete_murid($id_rfid);
	
		if ($result) {
			// If deletion is successful, set a success message
			$this->session->set_flashdata('success', 'Murid berhasil dihapus.');
		} else {
			// If deletion fails, set an error message
			$this->session->set_flashdata('error', 'Murid gagal dihapus.');
		}
	
		// Redirect back to the class detail page with the class ID
		redirect('admin/lihat_kelas?id_kelas=' . $id_kelas);
	}
	
	
	public function detail_murid($id_murid = null) {
        if (!$this->session->userdata('userlogin')) {
            // Mencegah akses langsung tanpa login
            return;
        }

        if (!$id_murid) {
            echo "Insert ID murid";
            return;
        }

        // Load model
        $this->load->model('m_admin');

        // Cari murid
        $murid = $this->m_admin->find_murid($id_murid);

        if (!$murid) {
            echo "Murid tidak ditemukan";
            return;
        }

        // Generate barcode
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($murid[0]->nisn, $generator::TYPE_CODE_128));

        // Load view dengan data murid dan barcode
        $this->load->view('i_detail_murid', [
            "murid" => $murid[0],
            "barcode" => $barcode
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

        $kelas = $this->m_admin->find_kelas($id_kelas);

        if (!$kelas) {
            echo "kelas tidak ditemukan";
            return;
        }

        $rekap_absen = [];
        if (isset($_GET["tanggalMulai"]) && isset($_GET["tanggalSelesai"])) {
            $tanggal_mulai = strtotime($this->input->get('tanggalMulai'));
            $tanggal_selesai = strtotime($this->input->get('tanggalSelesai')) + 86400; // Tambah 1 hari

            $rekap_absen = $this->m_admin->rekap_absen($id_kelas, $tanggal_mulai, $tanggal_selesai);
        }

        $this->load->view('i_detail_absen', [
            "kelas" => $kelas,
            "rekap_absen" => $rekap_absen,
        ]);
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
