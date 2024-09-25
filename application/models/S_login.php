<?php
class S_login extends CI_Model {
        
    function prosesLogin($nik) {
        $this->db->where('nik', $nik);
        return $this->db->get('siswa')->row(); // Mengambil satu baris
    }
    

    function checkEmail($email){
        $this->db->where('email',$email);
        
        return $this->db->get('siswa')->row();
    }
    
    function viewDataByID($nik){
        $query = $this->db->where('nik',$nik);
        $q = $this->db->get('siswa');
        $data = $q->result();
        
        return $data;
    }

    function viewDataByIDemail($email){
        $query = $this->db->where('email',$email);
        $q = $this->db->get('siswa');
        $data = $q->result();
        
        return $data;
    }

    function checkDataUsrbyID($id,$pass){
        $this->db->where('id_siswa',$id);
        $this->db->where('nisn',$pass);
        
        return $this->db->get('siswa')->row();
    }

    function changepasssiswa($id,$data){
        $this->db->where('id_siswa', $id);
        $this->db->update('siswa', $data);

        return TRUE;
    }

    function addsiswa($data){
        $this->db->insert('siswa', $data);

        return TRUE;
    }

}

?>