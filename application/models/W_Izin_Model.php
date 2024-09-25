<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class W_Izin_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_kelas() {
        $this->db->select('id, kelas');
        $this->db->from('kelas');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    public function get_jumlah_tidak_hadir_per_kelas() {
        $query = "
            SELECT siswa.id_kelas, COUNT(siswa.id_siswa) as jumlah_siswa
            FROM siswa
            LEFT JOIN absensi ON siswa.id_siswa = absensi.id_siswa 
              AND absensi.created_at >= UNIX_TIMESTAMP(CURDATE())
            WHERE absensi.id_absensi IS NULL
            GROUP BY siswa.id_kelas
        ";
        $result = $this->db->query($query)->result();
        $jumlah_tidak_absensi_per_kelas = array();
        foreach ($result as $row) {
            $jumlah_tidak_absensi_per_kelas[$row->id_kelas] = $row->jumlah_siswa;
        }
        return $jumlah_tidak_absensi_per_kelas;
    }
    

    public function get_siswa_by_kelas($id_kelas) {
        $today = date("Y-m-d");
        $beginning_of_today = strtotime('midnight', strtotime($today));
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        $this->db->select('siswa.*, kelas.kelas, kampus.kampus');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $this->db->join('kampus', 'siswa.id_kampus = kampus.id', 'left');
        $this->db->join('absensi', 'siswa.id_siswa = absensi.id_siswa AND absensi.created_at >= ' . $beginning_of_today . ' AND absensi.created_at < ' . $beginning_of_tomorrow, 'left');
        $this->db->where('siswa.id_kelas', $id_kelas);
        $this->db->where('absensi.id_absensi IS NULL');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    public function is_registered_nisn($nisn) {
        $query = $this->db->get_where('siswa', array('nisn' => $nisn));
        return $query->num_rows() > 0;
    }

    public function is_already_absent($nisn, $action) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        if (!$id_siswa) {
            return false;
        }

        $today = date("Y-m-d");
        $beginning_of_today = strtotime('midnight', strtotime($today));
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('keterangan', $action);
        $this->db->where('created_at >=', $beginning_of_today);
        $this->db->where('created_at <', $beginning_of_tomorrow);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    private function get_id_siswa_by_nisn($nisn) {
        $query = $this->db->get_where('siswa', array('nisn' => $nisn));
        $result = $query->row();
        return $result ? $result->id_siswa : null;
    }

    public function simpan_absensi($nisn, $id_devices, $action) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        if (!$id_siswa) {
            return false;
        }

        $data = array(
            'id_devices' => $id_devices,
            'id_siswa' => $id_siswa,
            'keterangan' => $action,
            'foto' => '',
            'created_at' => time()
        );

        return $this->db->insert('absensi', $data);
    }
}
?>
