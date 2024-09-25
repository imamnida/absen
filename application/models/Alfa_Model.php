<?php
class Alfa_Model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_siswa_tidak_hadir_tiga_hari() {
        $query = "
            SELECT kelas.id, kelas.kelas
            FROM kelas
        ";
        return $this->db->query($query)->result();
    }

    public function get_jumlah_tidak_hadir_per_kelas() {
        $query = "
            SELECT siswa.id_kelas, COUNT(siswa.id_siswa) as jumlah_siswa
            FROM siswa
            LEFT JOIN absensi ON siswa.id_siswa = absensi.id_siswa 
              AND absensi.created_at >= UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 3 DAY))
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
        $query = "
            SELECT siswa.*, kelas.kelas, kampus.kampus
            FROM siswa
            LEFT JOIN absensi ON siswa.id_siswa = absensi.id_siswa 
              AND absensi.created_at >= UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 3 DAY))
            LEFT JOIN kelas ON siswa.id_kelas = kelas.id
            LEFT JOIN kampus ON siswa.id_kampus = kampus.id
            WHERE siswa.id_kelas = ? AND absensi.id_absensi IS NULL
        ";
        return $this->db->query($query, array($id_kelas))->result();
    }
}
?>
