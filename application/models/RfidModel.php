<?php
class RfidModel extends CI_Model {

    public function get_kelas() {
        $query = $this->db->get('kelas');
        return $query->result();
    }

    public function get_kampus() {
        $query = $this->db->get('kampus');
        return $query->result();
    }

    public function insert_rfid($data) {
        return $this->db->insert('rfid', $data);
    }
}
?>
