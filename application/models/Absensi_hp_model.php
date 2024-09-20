<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_hp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function absen_masuk($nisn, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_nisn($nisn);

        if ($id_rfid) {
            $data = array(
                'id_devices' => $id_devices,
                'id_rfid' => $id_rfid,
                'keterangan' => 'masuk',
                'foto' => '', 
                'created_at' => time() // Directly use Unix timestamp
            );
            $this->db->insert('absensi', $data);
        } else {
            // Handle error: RFID ID tidak ditemukan
        }
    }

    public function absen_keluar($nisn, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_nisn($nisn);

        if ($id_rfid) {
            $data = array(
                'id_devices' => $id_devices,
                'id_rfid' => $id_rfid,
                'keterangan' => 'keluar',
                'foto' => '',
                'created_at' => time() // Directly use Unix timestamp
            );
            $this->db->insert('absensi', $data);
        } else {
            // Handle error: RFID ID tidak ditemukan
        }
    }

    private function get_id_rfid_by_nisn($nisn) {
        $query = $this->db->get_where('rfid', array('nisn' => $nisn));
        $result = $query->row();
        return $result ? $result->id_rfid : null;
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

        $id_rfid = $this->get_id_rfid_by_nisn($nisn);
        if (!$id_rfid) {
            return false; 
        }

        $this->db->where('id_rfid', $id_rfid);
        $this->db->where('keterangan', $keterangan);
        $this->db->where('created_at >=', $today_start);
        $this->db->where('created_at <', $tomorrow_start);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    public function is_registered_nisn($nisn) {
        $this->db->where('nisn', $nisn);
        $query = $this->db->get('rfid');
        return $query->num_rows() > 0;
    }
}
?>
