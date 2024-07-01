<?php
class W_admin extends CI_Model {

    function get_users(){
        $this->db->select('*');
        $this->db->from('user');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function insert_users($data){
       $this->db->insert('user', $data);
       return TRUE;
    }

    function users_del($id) {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }


    function updateUser($id,$data){
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        return TRUE;
    }

    function get_user_byid($id) {
        $query = $this->db->where('id_user',$id);
        $q = $this->db->get('user');
        $data = $q->result();
        
        return $data;
    }


    function get_devices_byid($id) {
        $query = $this->db->where('id_devices',$id);
        $q = $this->db->get('devices');
        $data = $q->result();
        
        return $data;
    }

    function get_devices(){
        $this->db->select('*');
        $this->db->from('devices');
        $this->db->order_by('id_devices', 'desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
    function insert_devices($data){
       $this->db->insert('devices', $data);
       return TRUE;
    }

    function devices_del($id) {
        $this->db->where('id_devices', $id);
        $this->db->delete('devices');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
    function updateDevices($id,$data){
        $this->db->where('id_devices', $id);
        $this->db->update('devices', $data);

        return TRUE;
    }


    function empty_data(){
        $this->db->truncate('histori');
        return TRUE;
    }

    function get_rfid(){
        $this->db->select('*');
        $this->db->from('rfid');
        $this->db->join('kelas','kelas.id = rfid.id_kelas','left');
        $this->db->join('kampus','kampus.id = rfid.id_kampus','left');
        $this->db->order_by('id_rfid', 'desc');
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    

    function get_rfid_byid($id) {
        $query = $this->db->where('id_rfid',$id);
        $q = $this->db->get('rfid');
        $data = $q->result();
        
        return $data;
    }

    function get_rfid_byid_row($id) {
        return $this->db->count_all_results('rfid');

    }

    function updateRFID($id,$data){
        $this->db->where('id_rfid', $id);
        $this->db->update('rfid', $data);

        return TRUE;
    }

    function rfid_del($id) {
        $this->db->where('id_rfid', $id);
        $this->db->delete('rfid');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function get_absensi($ket,$today,$tomorrow){
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('devices','absensi.id_devices=devices.id_devices','inner');
        $this->db->join('rfid','absensi.id_rfid=rfid.id_rfid','inner');
        $this->db->where("keterangan", $ket);
        $this->db->where("created_at >=", $today);
        $this->db->where("created_at <", $tomorrow);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
   
    


    function get_history(){
        $this->db->select('*');
        $this->db->from('histori');
        $this->db->join('rfid', 'rfid.id_rfid=histori.id_rfid', 'inner');
        $this->db->join('devices', 'devices.id_devices=histori.id_devices', 'inner');
        $this->db->order_by('id_histori', 'desc');
        $this->db->limit(50);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function getkey(){
        $query = $this->db->where('id_key',1);
        $q = $this->db->get('secret_key');
        $data = $q->result();
        
        return $data;
    }

    function waktuoperasional(){
        $this->db->select('*');
        $this->db->from('waktu_operasional');
        $this->db->limit(2);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    function updateWaktuOperasional($id,$data){
        $this->db->where('id_waktu_operasional', $id);
        $this->db->update('waktu_operasional', $data);

        return TRUE;
    }

    public function find_rfid($id_rfid)
    {
        $this->db->select('*');
        $this->db->from('rfid');
        $this->db->where('id_rfid',$id_rfid);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }


    }
    public function hitung_tidak_absensi() {
        // Mendapatkan semua nama pengguna RFID
        $this->db->select('nama');
        $query = $this->db->get('rfid');
        $rfid_users = $query->result_array();
    
        // Inisialisasi variabel untuk menyimpan jumlah pengguna yang tidak absensi
        $tidak_absensi_count = 0;
    
        // Loop melalui setiap nama pengguna RFID
        foreach ($rfid_users as $user) {
            $nama_pengguna_rfid = $user['nama'];
    
            // Mendapatkan ID RFID berdasarkan nama pengguna RFID
            $this->db->select('id_rfid');
            $this->db->where('nama', $nama_pengguna_rfid);
            $query = $this->db->get('rfid');
            $row = $query->row();
            if ($row) {
                $id_rfid = $row->id_rfid;
    
                // Memeriksa apakah ada entri dalam tabel absensi untuk ID RFID dan tanggal sekarang
                $this->db->where('id_rfid', $id_rfid);
                $this->db->where('DATE(FROM_UNIXTIME(created_at))', date('Y-m-d'));
                // Tambahkan kondisi untuk tidak menghitung data dengan keterangan "keluar"
                $this->db->where('keterangan !=', 'keluar');
                $absensi_count = $this->db->count_all_results('absensi');
    
                // Jika tidak ada entri absensi, maka pengguna dianggap tidak absensi
                if ($absensi_count == 0) {
                    $tidak_absensi_count++;
                }
            }
        }
    
        return $tidak_absensi_count;
    }
    
    
    public function get_kelas_byrow() {
        $query = $this->db->get('kelas'); 
        return $query->num_rows();
    }

    public function get_jam_masuk($id_rfid, $tanggal)
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('id_rfid', $id_rfid);
        $this->db->where('keterangan','masuk');
        $this->db->where("created_at >=", $tanggal);
        $this->db->where("created_at <", $tanggal + 86400);

        $query = $this->db->get();

        return $query;
    }

    function get_murid($id_kelas){
        $this->db->select('*');
        $this->db->from('rfid');
        $this->db->join('kelas','kelas.id = rfid.id_kelas','left');
        $this->db->join('kampus','kampus.id = rfid.id_kampus','left');
        $this->db->where('id_kelas',$id_kelas);
        $this->db->order_by("nama", "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    } 

    public function find_murid($id_murid)
    {
        $this->db->select('*');
        $this->db->from('rfid');
        $this->db->join('kelas','kelas.id = rfid.id_kelas','left');
        $this->db->join('kampus','kampus.id = rfid.id_kampus','left');
        $this->db->where('id_rfid',$id_murid);
        $this->db->order_by("nama", "ASC");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    function insert_kelas($data){
        $this->db->insert('kelas', $data);
        return TRUE;
    }

    public function hapus_kelas($id_kelas)
    {
        $this->db->where('id',$id_kelas);
        $this->db->delete('kelas');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;

    }

    function get_kelas(){
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->order_by("id", "desc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }

    function find_kelas($id){
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('id',$id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    

    public function rekap_absen($id_kelas, $tanggal_mulai, $tanggal_selesai) {
        // Mendapatkan data siswa dalam kelas
        $siswa_kelas = $this->db->where('id_kelas', $id_kelas)->get('rfid')->result();
        
        // Array untuk menyimpan rekap absensi
        $rekap_absen = array();
        
        foreach ($siswa_kelas as $siswa) {
            // Query untuk mendapatkan absensi siswa dalam rentang tanggal yang ditentukan
            $this->db->select('*');
            $this->db->from('absensi');
            $this->db->where('id_rfid', $siswa->id_rfid);
            $this->db->where('created_at >=', $tanggal_mulai);
            $this->db->where('created_at <', $tanggal_selesai);
            $query = $this->db->get();

            // Menyimpan hasil query ke dalam array
            $absensi_siswa = $query->result();

            // Menyimpan data siswa dan absensinya ke dalam array rekap absen
            $rekap_absen[] = (object) array(
                'nis' => $siswa->nis,
                'nama' => $siswa->nama,
                'absensi' => $absensi_siswa
            );
        }

        return $rekap_absen;
    }
    


    public function get_kampus()
    {
        $this->db->select('*');
        $this->db->from('kampus');
        $this->db->order_by("id", "desc");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    
    public function hapus_kampus($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('kampus');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public function insert_kampus($data)
    {
        $this->db->insert('kampus', $data);
        return TRUE;
     }




    function count_murid($id_kelas){
        $this->db->select('*');
        $this->db->from('rfid');
        $this->db->where('id_kelas',$id_kelas);

        $query = $this->db->get();

        return $query->num_rows(); 
    }

   // Fungsi untuk menemukan siswa yang tidak hadir selama 3 hari berturut-turut
public function siswa_tidak_hadir_3_hari_berturut_turut($id_kelas) {
    // Array untuk menyimpan data siswa yang tidak hadir selama 3 hari berturut-turut
    $siswa_tidak_hadir = array();
    
    // Mendapatkan tanggal hari ini
    $today = date('Y-m-d');
    
    // Loop melalui semua siswa dalam kelas
    $siswa_kelas = $this->db->where('id_kelas', $id_kelas)->get('rfid')->result();
    foreach ($siswa_kelas as $siswa) {
        // Hitungan berturut-turut absensi tidak hadir
        $hitungan_tidak_hadir = 0;
        
        // Loop selama 3 hari ke belakang
        for ($i = 0; $i < 3; $i++) {
            $tanggal_cek = date('Y-m-d', strtotime("-$i day", strtotime($today)));
            
            // Periksa apakah siswa tidak hadir pada tanggal ini
            $absensi_siswa = $this->db->where('id_rfid', $siswa->id_rfid)
                                      ->where('DATE(FROM_UNIXTIME(created_at))', $tanggal_cek)
                                      ->where('keterangan', 'absen')
                                      ->get('absensi')
                                      ->row();
            if (!$absensi_siswa) {
                $hitungan_tidak_hadir++;
            } else {
                // Reset hitungan jika siswa hadir pada suatu hari
                $hitungan_tidak_hadir = 0;
            }
        }
        
        // Jika siswa tidak hadir selama 3 hari berturut-turut, tambahkan ke array
        if ($hitungan_tidak_hadir == 3) {
            $siswa_tidak_hadir[] = $siswa;
        }
    }
    
    return $siswa_tidak_hadir;
}


}

?>
