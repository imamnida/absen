<?php
class Izin_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_kelas() {
        $query = "
            SELECT kelas.id, kelas.kelas
            FROM kelas
        ";
        return $this->db->query($query)->result();
    }

    public function get_jumlah_tidak_hadir_hari_ini_per_kelas() {
        $query = "
            SELECT rfid.id_kelas, COUNT(rfid.id_rfid) as jumlah_siswa
            FROM rfid
            LEFT JOIN absensi ON rfid.id_rfid = absensi.id_rfid 
              AND DATE(absensi.created_at) = CURDATE()
            WHERE absensi.id_absensi IS NULL
            GROUP BY rfid.id_kelas
        ";
        $result = $this->db->query($query)->result();
        $jumlah_tidak_hadir_per_kelas = array();
        foreach ($result as $row) {
            $jumlah_tidak_hadir_per_kelas[$row->id_kelas] = $row->jumlah_siswa;
        }
        return $jumlah_tidak_hadir_per_kelas;
    }

    public function get_siswa_tidak_hadir_by_kelas($id_kelas) {
        $query = "
            SELECT rfid.*, kelas.kelas, kampus.kampus
            FROM rfid
            LEFT JOIN absensi ON rfid.id_rfid = absensi.id_rfid 
              AND DATE(absensi.created_at) = CURDATE()
            LEFT JOIN kelas ON rfid.id_kelas = kelas.id
            LEFT JOIN kampus ON rfid.id_kampus = kampus.id
            WHERE rfid.id_kelas = ? AND absensi.id_absensi IS NULL
        ";
        return $this->db->query($query, array($id_kelas))->result();
    }

    public function update_kehadiran($id_rfid, $keterangan) {
        if ($keterangan == 'masuk') {
            $data = array(
                'id_rfid' => $id_rfid,
                'keterangan' => $keterangan,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('absensi', $data);
        } else {
            // Jika keterangan bukan 'Masuk', hapus data absensi jika ada
            $this->db->where('id_rfid', $id_rfid);
            $this->db->delete('absensi');
        }
    }
}
?>
