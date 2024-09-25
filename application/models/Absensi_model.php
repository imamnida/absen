<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function absen_masuk($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        $data = array(
            'id_devices' => $id_devices,
            'id_siswa' => $id_siswa,
            'keterangan' => 'masuk',
            'foto' => '', 
            'created_at' => time() 
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_keluar($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        $data = array(
            'id_devices' => $id_devices,
            'id_siswa' => $id_siswa,
            'keterangan' => 'keluar',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_izin($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        $data = array(
            'id_devices' => $id_devices,
            'id_siswa' => $id_siswa,
            'keterangan' => 'izin',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_sakit($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        $data = array(
            'id_devices' => $id_devices,
            'id_siswa' => $id_siswa,
            'keterangan' => 'sakit',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    private function get_id_siswa_by_nisn($nisn) {
        $query = $this->db->get_where('siswa', array('nisn' => $nisn));
        $result = $query->row();
        return $result ? $result->id_siswa : null;
    }

    public function is_already_absent($nisn, $keterangan) {

        $today = date("Y-m-d");

         
        $beginning_of_today = strtotime('midnight', strtotime($today));

        
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

       
        $this->db->where('id_siswa', $this->get_id_siswa_by_nisn($nisn));
        $this->db->where('keterangan', $keterangan);
        $this->db->where('created_at >=', $beginning_of_today);
        $this->db->where('created_at <', $beginning_of_tomorrow);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    public function is_registered_nisn($nisn) {
        $this->db->where('nisn', $nisn);
        $query = $this->db->get('siswa');
        return $query->num_rows() > 0;
    }
}
?>
