<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get the list of classes.
     *
     * @return array List of classes.
     */
    public function get_kelas() {
        $this->db->select('id, kelas');
        $this->db->from('kelas');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    /**
     * Get the number of students who haven't attended by class.
     *
     * @return array Associative array with class IDs as keys and the number of absent students as values.
     */
    public function get_jumlah_tidak_hadir_per_kelas() {
        $this->db->select('kelas.id as id_kelas, kelas.kelas, COUNT(rfid.id_rfid) as jumlah_siswa');
        $this->db->from('kelas');
        $this->db->join('rfid', 'rfid.id_kelas = kelas.id', 'left');
        $this->db->group_by('kelas.id');
        $query_kelas = $this->db->get();

        $jumlah_tidak_absensi_per_kelas = [];

        if ($query_kelas->num_rows() > 0) {
            foreach ($query_kelas->result() as $row) {
                $this->db->select('COUNT(absensi.id_absensi) as jumlah_absen');
                $this->db->from('absensi');
                $this->db->join('rfid', 'absensi.id_rfid = rfid.id_rfid');
                $this->db->where('rfid.id_kelas', $row->id_kelas);
                $this->db->where('DATE(absensi.created_at) = CURDATE()');
                $query_absen = $this->db->get();
                $count_absen = $query_absen->row()->jumlah_absen;

                $jumlah_siswa_tidak_absen = max(0, $row->jumlah_siswa - $count_absen);

                if ($jumlah_siswa_tidak_absen > 0) {
                    $jumlah_tidak_absensi_per_kelas[$row->id_kelas] = $jumlah_siswa_tidak_absen;
                }
            }
        }

        return $jumlah_tidak_absensi_per_kelas;
    }

    /**
     * Get the list of students in a class who haven't attended.
     *
     * @param int $id_kelas The ID of the class.
     * @return array List of students who haven't attended.
     */
    public function get_siswa_by_kelas($id_kelas) {
        $today = date("Y-m-d");
        $beginning_of_today = strtotime('midnight', strtotime($today));
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        $this->db->select('rfid.*, kelas.kelas, kampus.kampus');
        $this->db->from('rfid');
        $this->db->join('kelas', 'rfid.id_kelas = kelas.id', 'left');
        $this->db->join('kampus', 'rfid.id_kampus = kampus.id', 'left');
        $this->db->join('absensi', 'rfid.id_rfid = absensi.id_rfid AND absensi.created_at >= ' . $beginning_of_today . ' AND absensi.created_at < ' . $beginning_of_tomorrow, 'left');
        $this->db->where('rfid.id_kelas', $id_kelas);
        $this->db->where('absensi.id_absensi IS NULL');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return [];
    }

    /**
     * Store attendance information.
     *
     * @param string $nisn The NISN of the student.
     * @param int $id_devices The ID of the device.
     * @param string $action The attendance action (masuk, keluar, izin, sakit).
     */
    private function simpan_absensi($nisn, $id_devices, $action) {
        $id_rfid = $this->get_id_rfid_by_nisn($nisn);
        if (!$id_rfid) {
            return false;
        }

        $data = array(
            'id_devices' => $id_devices,
            'id_rfid' => $id_rfid,
            'keterangan' => $action,
            'foto' => '',
            'created_at' => time()
        );

        return $this->db->insert('absensi', $data);
    }

    /**
     * Check if a student has already been marked for a specific action.
     *
     * @param string $nisn The NISN of the student.
     * @param string $action The attendance action (masuk, keluar, izin, sakit).
     * @return bool True if already absent, false otherwise.
     */
    public function is_already_absent($nisn, $action) {
        $id_rfid = $this->get_id_rfid_by_nisn($nisn);
        if (!$id_rfid) {
            return false;
        }

        $today = date("Y-m-d");
        $beginning_of_today = strtotime('midnight', strtotime($today));
        $beginning_of_tomorrow = strtotime('+1 day', $beginning_of_today);

        $this->db->where('id_rfid', $id_rfid);
        $this->db->where('keterangan', $action);
        $this->db->where('created_at >=', $beginning_of_today);
        $this->db->where('created_at <', $beginning_of_tomorrow);
        $query = $this->db->get('absensi');

        return $query->num_rows() > 0;
    }

    /**
     * Check if a student's NISN is registered in the RFID table.
     *
     * @param string $nisn The NISN of the student.
     * @return bool True if registered, false otherwise.
     */
    public function is_registered_nisn($nisn) {
        $query = $this->db->get_where('rfid', array('nisn' => $nisn));
        return $query->num_rows() > 0;
    }

    /**
     * Get the RFID ID by NISN.
     *
     * @param string $nisn The NISN of the student.
     * @return int|null The RFID ID or null if not found.
     */
    private function get_id_rfid_by_nisn($nisn) {
        $query = $this->db->get_where('rfid', array('nisn' => $nisn));
        $result = $query->row();
        return $result ? $result->id_rfid : null;
    }
}
?>
