<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

class Wad extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('w_admin');
        date_default_timezone_set("asia/jakarta");
    }

    public function index(){
		if(!$this->session->userdata('userlogin'))    
		{
			return ;
		}

		if(isset($_POST['kelas'])){
			$kelas = [
				'kelas' => $_POST['kelas']
			];

			$this->w_admin->insert_kelas($kelas);
			$id_kelas = $_GET['id_kelas'];

			$data['message'] = "Berhasil menambahkan kelas"; 
			
		}

		$data['kelas'] = $this->w_admin->get_kelas();

		$data['w_admin'] = $this->w_admin;

		$this->load->view('wad/w_kelas', $data);

	}
    public function dashboard() {
		
		
	
	
		$this->load->view('include/w_header');
		$this->load->view('wad/w_dashboard');
		$this->load->view('include/footer');
	

	}
    public function detail_murid($id_murid = null) {
        if (!$this->session->userdata('userlogin')) {
         
            return;
        }

        if (!$id_murid) {
            echo "Insert ID murid";
            return;
        }

     
        $this->load->model('w_admin');

      
        $murid = $this->w_admin->find_murid($id_murid);

        if (!$murid) {
            echo "Murid tidak ditemukan";
            return;
        }

    
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($murid[0]->nisn, $generator::TYPE_CODE_128));

    
        $this->load->view('wad/w_detail_murid', [
            "murid" => $murid[0],
            "barcode" => $barcode
        ]);
    }
	public function tambah_kelas(){
		if(!$this->session->userdata('userlogin'))   
		{
			return ;
		}

	}
    public function lihat_kelas(){
		if(!$this->session->userdata('userlogin'))   
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

		$kelas = $this->w_admin->hapus_kelas($id_kelas);
		
		
		redirect(base_url().'wad');
		
	}
    public function rekap_absen($id_kelas = null)
    {
        if(!$this->session->userdata('userlogin'))
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

            // Fetch holidays
            $holidays = $this->w_admin->get_holidays($tanggal_mulai, $tanggal_selesai);
        }

        $this->load->view('wad/w_detail_absen', [
            "kelas" => $kelas,
            "rekap_absen" => $rekap_absen,
            "holidays" => isset($holidays) ? $holidays : [],
        ]);
    }
    public function manage_holidays()
    {
        if(!$this->session->userdata('userlogin'))
        {
            return ;
        }

        if($this->input->post()) {
            $tanggal = $this->input->post('tanggal');
            $keterangan = $this->input->post('keterangan');
            
            $this->w_admin->add_holiday($tanggal, $keterangan);
            $this->session->set_flashdata('success', 'Hari libur berhasil ditambahkan');
            redirect('wad/manage_holidays');
        }

        $holidays = $this->w_admin->get_all_holidays();
        $this->load->view('wad/w_manage_holidays', ['holidays' => $holidays]);
    }

    public function delete_holiday($id)
    {
        if(!$this->session->userdata('userlogin'))
        {
            return ;
        }

        $this->w_admin->delete_holiday($id);
        $this->session->set_flashdata('success', 'Hari libur berhasil dihapus');
        redirect('wad/manage_holidays');
    }
}