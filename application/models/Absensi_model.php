<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function absen_masuk($uid, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => 'masuk',
            'foto' => '', 
            'created_at' => time() 
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_keluar($uid, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => 'keluar',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_izin($uid, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => 'izin',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    public function absen_sakit($uid, $id_devices) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => 'sakit',
            'foto' => '',
            'created_at' => time()
        );
        $this->db->insert('absensi', $data);
    }

    private function get_id_rfid_by_uid($uid) {
        $query = $this->db->get_where('rfid', array('uid' => $uid));
        $result = $query->row();
        return $result ? $result->id_rfid : null;
    }

    public function is_already_absent($uid, $keterangan) {
        // Get today's date
        $today = date("Y-m-d");

        // Get the timestamp for the beginning of today
        $beginning_of_today = strtotime('midnight', strtotime($today));

        // Get the timestamp for the beginning of tomorrow
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        // Query to check if the user has already performed attendance today
        $this->db->where('id_rfid', $this->get_id_rfid_by_uid($uid));
        $this->db->where('keterangan', $keterangan);
        $this->db->where('created_at >=', $beginning_of_today);
        $this->db->where('created_at <', $beginning_of_tomorrow);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    public function is_registered_uid($uid) {
        $this->db->where('uid', $uid);
        $query = $this->db->get('rfid');
        return $query->num_rows() > 0;
    }
}
?>
