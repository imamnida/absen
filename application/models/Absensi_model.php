<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function absen_masuk($uid, $id_devices) {
        if (!$this->is_already_absent($uid, 'masuk')) {
            $id_rfid = $this->get_id_rfid_by_uid($uid);
            $data = array(
                'id_devices' => $id_devices,
                'id_rfid' => $id_rfid,
                'keterangan' => 'masuk',
                'foto' => '',
                'created_at' => time(),
                'is_absent_today' => 1  // Tandai bahwa siswa sudah absen hari ini
            );
            $this->db->insert('absensi', $data);
        } else {
            // Siswa sudah melakukan absensi masuk hari ini
            // Tambahkan log, tampilkan pesan, atau lakukan tindakan sesuai kebutuhan Anda
        }
    }

    public function absen_keluar($uid, $id_devices) {
        if (!$this->is_already_absent($uid, 'keluar')) {
            $id_rfid = $this->get_id_rfid_by_uid($uid);
            $data = array(
                'id_devices' => $id_devices,
                'id_rfid' => $id_rfid,
                'keterangan' => 'keluar',
                'foto' => '',
                'created_at' => time(),
                'is_absent_today' => 1  // Tandai bahwa siswa sudah absen hari ini
            );
            $this->db->insert('absensi', $data);
        } else {
            // Siswa sudah melakukan absensi keluar hari ini
            // Tambahkan log, tampilkan pesan, atau lakukan tindakan sesuai kebutuhan Anda
        }
    }

    public function is_already_absent($uid, $keterangan) {
        $today = date("Y-m-d");
        $this->db->where('id_rfid', $this->get_id_rfid_by_uid($uid));
        $this->db->where('keterangan', $keterangan);
        $this->db->where('DATE(created_at)', $today);
        $this->db->where('is_absent_today', 1); // Memeriksa apakah siswa sudah absen hari ini
        $query = $this->db->get('absensi');
        return $query->num_rows() > 0;
    }

    public function is_registered_uid($uid) {
        $this->db->where('uid', $uid);
        $query = $this->db->get('rfid');
        return $query->num_rows() > 0;
    }

    private function get_id_rfid_by_uid($uid) {
        $query = $this->db->get_where('rfid', array('uid' => $uid));
        $result = $query->row();
        return $result ? $result->id_rfid : null;
    }
}
?>
