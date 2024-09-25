<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Picqer\Barcode\BarcodeGeneratorPNG;

class Kelas extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('excel');
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

			$this->m_admin->insert_kelas($kelas);
			$id_kelas = $_GET['id_kelas'];

			$data['message'] = "Berhasil menambahkan kelas"; 
			
		}

		$data['kelas'] = $this->m_admin->get_kelas();

		$data['m_admin'] = $this->m_admin;

		$this->load->view('i_kelas', $data);

	}
    public function export_siswa($id_kelas) {
        $kelas = $this->m_admin->get_kelas_byid($id_kelas);
        $murid = $this->m_admin->get_murid_bykelas($id_kelas);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NISN');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Alamat');

        $row = 2;
        foreach($murid as $m) {
            $sheet->setCellValue('A' . $row, $m->nama);
            $sheet->setCellValue('B' . $row, $m->nisn);
            $sheet->setCellValue('C' . $row, $m->nik);
            $sheet->setCellValue('D' . $row, $m->ttl);
            $sheet->setCellValue('E' . $row, $m->alamat);
            $row++;
        }

        $writer = new vendor\PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'export_siswa_kelas_' . $kelas->kelas . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function import_template() {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NISN');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Alamat');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'template_import_siswa.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function import_siswa($id_kelas) {
        if(isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            
            foreach($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                
                for($row=2; $row<=$highestRow; $row++) {
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nisn = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nik = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $ttl = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    
                    $data = array(
                        'nama' => $nama,
                        'nisn' => $nisn,
                        'nik' => $nik,
                        'ttl' => $ttl,
                        'alamat' => $alamat,
                        'id_kelas' => $id_kelas
                    );
                    
                    $this->m_admin->insert_siswa($data);
                }
            }
            
            $this->session->set_flashdata('success', 'Import data siswa berhasil');
        } else {
            $this->session->set_flashdata('error', 'Pilih file Excel terlebih dahulu');
        }
        
        redirect('kelas/detail/' . $id_kelas);
    }
    
    public function detail_murid($id_murid = null) {
        if (!$this->session->userdata('userlogin')) {
         
            return;
        }

        if (!$id_murid) {
            echo "Insert ID murid";
            return;
        }

     
        $this->load->model('m_admin');

      
        $murid = $this->m_admin->find_murid($id_murid);

        if (!$murid) {
            echo "Murid tidak ditemukan";
            return;
        }

    
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($murid[0]->nisn, $generator::TYPE_CODE_128));

    
        $this->load->view('i_detail_murid', [
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
		
		
		redirect(base_url().'kelas');
		
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
}