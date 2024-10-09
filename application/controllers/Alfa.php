<?php
class Alfa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Alfa_Model');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index() {
        $data['kelas'] = $this->Alfa_Model->get_siswa_tidak_hadir_tiga_hari();
        $data['jumlah_tidak_absensi_per_kelas'] = $this->Alfa_Model->get_jumlah_tidak_hadir_per_kelas();
        $this->load->view('i_alfa', $data);
    }

    public function detail($id_kelas) {
        $data['siswa'] = $this->Alfa_Model->get_siswa_by_kelas($id_kelas);
        $this->load->view('i_siswa_alfa_detail', $data);
    }
    
}
?>
