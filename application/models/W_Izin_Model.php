<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class W_Izin_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_kelas() {
        $query = $this->db->select('id, kelas')
                          ->from('kelas')
                          ->get();
        return $query->result();
    }

    public function get_jumlah_tidak_hadir_per_kelas() {
        $query = "
            SELECT rfid.id_kelas, COUNT(rfid.id_rfid) as jumlah_siswa
            FROM rfid
            LEFT JOIN absensi ON rfid.id_rfid = absensi.id_rfid 
              AND DATE(absensi.created_at) = CURDATE()
            WHERE absensi.id_absensi IS NULL
            GROUP BY rfid.id_kelas
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

        $query = $this->db->select('rfid.*, kelas.kelas, kampus.kampus')
                          ->from('rfid')
                          ->join('kelas', 'rfid.id_kelas = kelas.id', 'left')
                          ->join('kampus', 'rfid.id_kampus = kampus.id', 'left')
                          ->join('absensi', 'rfid.id_rfid = absensi.id_rfid AND absensi.created_at >= ' . $beginning_of_today . ' AND absensi.created_at < ' . $beginning_of_tomorrow, 'left')
                          ->where('rfid.id_kelas', $id_kelas)
                          ->where('absensi.id_absensi IS NULL')
                          ->get();

        return $query->result();
    }

    public function absen_masuk($uid, $id_devices) {
        $this->simpan_absensi($uid, $id_devices, 'masuk');
    }

    public function absen_keluar($uid, $id_devices) {
        $this->simpan_absensi($uid, $id_devices, 'keluar');
    }

    public function absen_izin($uid, $id_devices) {
        $this->simpan_absensi($uid, $id_devices, 'izin');
    }

    public function absen_sakit($uid, $id_devices) {
        $this->simpan_absensi($uid, $id_devices, 'sakit');
    }

    private function simpan_absensi($uid, $id_devices, $action) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        if (!$id_rfid) {
            return false;
        }

        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => $action,
            'foto' => '',
            'created_at' => time()
        );

        return $this->db->insert('absensi', $data);
    }

    public function is_already_absent($uid, $action) {
        $id_rfid = $this->get_id_rfid_by_uid($uid);
        if (!$id_rfid) {
            return false;
        }

        $today = date("Y-m-d");
        $beginning_of_today = strtotime('midnight', strtotime($today));
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        $this->db->where('id_rfid', $id_rfid);
        $this->db->where('keterangan', $action);
        $this->db->where('created_at >=', $beginning_of_today);
        $this->db->where('created_at <', $beginning_of_tomorrow);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    public function is_registered_uid($uid) {
        $query = $this->db->get_where('rfid', array('uid' => $uid));
        return $query->num_rows() > 0;
    }

    private function get_id_rfid_by_uid($uid) {
        $query = $this->db->get_where('rfid', array('uid' => $uid));
        $result = $query->row();
        return $result ? $result->id_rfid : null;
    }
}
?>
