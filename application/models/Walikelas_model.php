<?php
class Walikelas_model extends CI_Model {

    function prosesLogin($nuptk){
        $this->db->where('nuptk', $nuptk);
        return $this->db->get('walikelas')->row();
    }

    function insert_walikelas($data) {
        return $this->db->insert('walikelas', $data);
    }

    function get_walikelas() {
        return $this->db->get('walikelas')->result();
    }

    function get_walikelas_byid($no) {
        $this->db->where('id', $no);
        return $this->db->get('walikelas')->result();
    }

    function update_walikelas($no, $data) {
        $this->db->where('id', $no);
        return $this->db->update('walikelas', $data);
    }

    function walikelas_del($no) {
        $this->db->where('id', $no);
        return $this->db->delete('walikelas');
    }
}
?>
