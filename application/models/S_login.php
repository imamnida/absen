<?php
class S_login extends CI_Model {
        
    function prosesLogin($nik) {
        $this->db->where('nik', $nik);
        return $this->db->get('rfid')->row(); // Mengambil satu baris
    }
    

    function checkEmail($email){
        $this->db->where('email',$email);
        
        return $this->db->get('rfid')->row();
    }
    
    function viewDataByID($nik){
        $query = $this->db->where('nik',$nik);
        $q = $this->db->get('rfid');
        $data = $q->result();
        
        return $data;
    }

    function viewDataByIDemail($email){
        $query = $this->db->where('email',$email);
        $q = $this->db->get('rfid');
        $data = $q->result();
        
        return $data;
    }

    function checkDataUsrbyID($id,$pass){
        $this->db->where('id_rfid',$id);
        $this->db->where('nisn',$pass);
        
        return $this->db->get('rfid')->row();
    }

    function changepassrfid($id,$data){
        $this->db->where('id_rfid', $id);
        $this->db->update('rfid', $data);

        return TRUE;
    }

    function addrfid($data){
        $this->db->insert('rfid', $data);

        return TRUE;
    }

}

?>