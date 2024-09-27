<?php
class Siswa extends CI_Model {

    public function get_kelas() {
        $query = $this->db->get('kelas');
        return $query->result();
    }

    public function get_kampus() {
        $query = $this->db->get('kampus');
        return $query->result();
    }

    public function insert_siswa($data) {
        return $this->db->insert('siswa', $data);
    }
}
?>
