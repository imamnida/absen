<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_hp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function absen_masuk($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);

        if ($id_siswa) {
            $data = array(
                'id_devices' => $id_devices,
                'id_siswa' => $id_siswa,
                'keterangan' => 'masuk',
                'foto' => '', 
                'created_at' => time() // Directly use Unix timestamp
            );
            $this->db->insert('absensi', $data);
        } else {
            // Handle error: siswa ID tidak ditemukan
        }
    }

    public function absen_keluar($nisn, $id_devices) {
        $id_siswa = $this->get_id_siswa_by_nisn($nisn);

        if ($id_siswa) {
            $data = array(
                'id_devices' => $id_devices,
                'id_siswa' => $id_siswa,
                'keterangan' => 'keluar',
                'foto' => '',
                'created_at' => time() // Directly use Unix timestamp
            );
            $this->db->insert('absensi', $data);
        } else {
            // Handle error: siswa ID tidak ditemukan
        }
    }

    private function get_id_siswa_by_nisn($nisn) {
        $query = $this->db->get_where('siswa', array('nisn' => $nisn));
        $result = $query->row();
        return $result ? $result->id_siswa : null;
    }

   
    public function cek_waktu_operasional($action) {
        $current_day = date('l'); // Get current day of the week
        $current_time = date('H:i'); // Get current time

        // Query the waktu_operasional table based on current day and action
        $this->db->where('day', $current_day);
        $this->db->where('keterangan', $action);
        $query = $this->db->get('waktu_operasional');

        if ($query->num_rows() > 0) {
            $operational_time = $query->row()->waktu_operasional;
            list($start_time, $end_time) = explode('-', $operational_time);

            // Check if the current time is within the operational time
            if ($current_time >= $start_time && $current_time <= $end_time) {
                return true; // Within operational time
            }
        }

        return false; // Outside operational time
    }


    public function is_already_absent($nisn, $keterangan) {
        $today_start = strtotime("today"); // Start of today
        $tomorrow_start = strtotime("tomorrow"); // Start of tomorrow

        $id_siswa = $this->get_id_siswa_by_nisn($nisn);
        if (!$id_siswa) {
            return false; 
        }

        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('keterangan', $keterangan);
        $this->db->where('created_at >=', $today_start);
        $this->db->where('created_at <', $tomorrow_start);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    public function is_registered_nisn($nisn) {
        $this->db->where('nisn', $nisn);
        $query = $this->db->get('siswa');
        return $query->num_rows() > 0;
    }
    function get_absensi($ket,$today,$tomorrow){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('devices','absensi.id_devices=devices.id_devices','inner');
        $this->db->join('siswa','absensi.id_siswa=siswa.id_siswa','inner');
        $this->db->where("keterangan", $ket);
        $this->db->where("created_at >=", $today);
        $this->db->where("created_at <", $tomorrow);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function get_monthly_attendance($nisn, $start_date, $end_date) {
        $this->db->select('keterangan, COUNT(*) as count');
        $this->db->from('absensi');
        $this->db->join('siswa', 'absensi.id_siswa = siswa.id_siswa');
        $this->db->where('siswa.nisn', $nisn);
        $this->db->where('absensi.created_at >=', strtotime($start_date));
        $this->db->where('absensi.created_at <=', strtotime($end_date));
        $this->db->group_by('keterangan');
        $query = $this->db->get();
        
        $result = array(
            'masuk' => 0,
            'izin' => 0,
            'sakit' => 0
        );
        
        foreach ($query->result() as $row) {
            $result[$row->keterangan] = $row->count;
        }
        
        return $result;
    }
   
}
?>
