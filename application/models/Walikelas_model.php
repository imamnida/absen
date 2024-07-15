<?php
class Walikelas_model extends CI_Model {

public function get_walikelas() {
    $this->db->select('*');
    $this->db->from('walikelas');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result();
    }
    return array();
}

public function insert_walikelas($data) {
    if ($this->db->insert('walikelas', $data)) {
        return TRUE;
    }
    return FALSE;
}

public function walikelas_del($no) {
    $this->db->where('no', $no);
    $this->db->delete('walikelas');

    return ($this->db->affected_rows() == 1);
}

public function update_walikelas($no, $data) {
    $this->db->where('no', $no);
    return $this->db->update('walikelas', $data);
}

public function get_walikelas_byid($no) {
    $this->db->where('no', $no);
    $query = $this->db->get('walikelas');

    if ($query->num_rows() > 0) {
        return $query->result();
    }
    return array();
}
}
?>