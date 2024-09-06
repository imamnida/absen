<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alfa_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get classes that have students absent for the last three days.
     *
     * @return array List of classes with absent students.
     */
    public function get_siswa_tidak_hadir_tiga_hari() {
        $three_days_ago = date('Y-m-d', strtotime('-3 days'));

        $this->db->select('kelas.id, kelas.kelas');
        $this->db->from('kelas');
        $this->db->join('rfid', 'rfid.id_kelas = kelas.id', 'inner');
        $this->db->join('absensi', 'rfid.id_rfid = absensi.id_rfid AND absensi.created_at >=', strtotime($three_days_ago));
        $this->db->where('absensi.id_absensi IS NULL');
        $this->db->group_by('kelas.id');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    /**
     * Get the number of students not present per class in the last three days.
     *
     * @return array Associative array with class IDs as keys and number of absent students as values.
     */
    public function get_jumlah_tidak_hadir_per_kelas() {
        $three_days_ago = date('Y-m-d', strtotime('-3 days'));

        $this->db->select('rfid.id_kelas, COUNT(rfid.id_rfid) as jumlah_siswa');
        $this->db->from('rfid');
        $this->db->join('absensi', 'rfid.id_rfid = absensi.id_rfid AND absensi.created_at >=', strtotime($three_days_ago), 'left');
        $this->db->where('absensi.id_absensi IS NULL');
        $this->db->group_by('rfid.id_kelas');

        $query = $this->db->get();

        $jumlah_tidak_absensi_per_kelas = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $jumlah_tidak_absensi_per_kelas[$row->id_kelas] = $row->jumlah_siswa;
            }
        }

        return $jumlah_tidak_absensi_per_kelas;
    }

    /**
     * Get students by class who haven't attended in the last three days.
     *
     * @param int $id_kelas The ID of the class.
     * @return array List of absent students with class and campus details.
     */
    public function get_siswa_by_kelas($id_kelas) {
        $three_days_ago = date('Y-m-d', strtotime('-3 days'));

        $this->db->select('rfid.*, kelas.kelas, kampus.kampus');
        $this->db->from('rfid');
        $this->db->join('absensi', 'rfid.id_rfid = absensi.id_rfid AND absensi.created_at >=', strtotime($three_days_ago), 'left');
        $this->db->join('kelas', 'rfid.id_kelas = kelas.id', 'left');
        $this->db->join('kampus', 'rfid.id_kampus = kampus.id', 'left');
        $this->db->where('rfid.id_kelas', $id_kelas);
        $this->db->where('absensi.id_absensi IS NULL');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }
}
