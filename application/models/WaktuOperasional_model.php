<?php
class WaktuOperasional_model extends CI_Model {
    public function get_waktu_operasional() {
        $this->db->select('*');
        $this->db->from('waktu_operasional');
        $query = $this->db->get();
        return $query->result();
    }
}
?>
