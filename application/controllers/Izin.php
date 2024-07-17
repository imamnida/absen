<?php
class Izin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Izin_model');
    }

    public function index() {
        $data['kelas'] = $this->Izin_model->get_kelas();
        $data['jumlah_tidak_hadir_per_kelas'] = $this->Izin_model->get_jumlah_tidak_hadir_hari_ini_per_kelas();
        $this->load->view('i_izin', $data);
    }

    public function detail($id_kelas) {
        $data['siswa'] = $this->Izin_model->get_siswa_tidak_hadir_by_kelas($id_kelas);
        $this->load->view('i_izin_detail', $data);
    }

    public function update_kehadiran() {
        $id_rfid = $this->input->post('id_rfid');
        $keterangan = $this->input->post('keterangan');
        $this->Izin_model->update_kehadiran($id_rfid, $keterangan);
        redirect('izin/detail/'.$this->input->post('id_kelas'));
    }
}
?>
