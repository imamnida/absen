<?php
class W_login extends CI_Model {

    function prosesLogin($nuptk){
        $this->db->where('nuptk', $nuptk);
        return $this->db->get('walikelas')->row();
    }

    function checknuptk($nuptk){
        $this->db->where('nuptk', $nuptk);
        return $this->db->get('walikelas')->row();
    }

    function viewDataByno($nuptk){
        $this->db->where('nuptk', $nuptk);
        $q = $this->db->get('walikelas');
        return $q->result();
    }

    function viewDataBynoemail($email){
        $this->db->where('email', $email);
        $q = $this->db->get('walikelas');
        return $q->result();
    }

    function checkDataUsrbyno($nuptk, $pass){
        $this->db->where('nuptk', $nuptk);
        $this->db->where('password', $pass);
        return $this->db->get('walikelas')->row();
    }

    function changepassUser($nuptk, $data){
        $this->db->where('nuptk', $nuptk);
        $this->db->update('walikelas', $data);
        return TRUE;
    }

    function addwalikelas($data){
        $this->db->insert('walikelas', $data);
        return TRUE;
    }
}
?>
