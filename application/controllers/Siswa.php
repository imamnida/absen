<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index() {
        $data['set'] = "siswa";
        $data['siswa'] = $this->m_data->get_siswa();
        $data['m_data'] = $this->m_data;
        $this->load->view('i_siswa', $data);
    }

    public function siswa($data = null) {
        if ($data) {
            $method = strtolower($data);
            if (method_exists($this, $method)) {
                $this->$method();
            } else {
                redirect('dashboard');
            }
        } else {
            redirect('dashboard');
        }
    }

    public function siswanew() {
        $data['set'] = "new";
        $data['siswa'] = $this->m_data->get_siswa();
        $data['m_data'] = $this->m_data;
        $this->load->view('i_siswa', $data);
    }

    public function edit_siswa($id = null) {
        if (!$this->session->userdata('userlogin') || !$id) {
            redirect(base_url() . 'login');
            return;
        }

        $siswa = $this->m_data->get_siswa_byid($id);
        if (!$siswa) {
            redirect('siswa');
            return;
        }

        $data = (array) $siswa[0];
        $data['kelas'] = $siswa[0]->id_kelas ? $this->m_data->find_kelas($siswa[0]->id_kelas) : null;
        $data['list_kelas'] = $this->m_data->get_kelas();
        $data['set'] = "edit-siswa";
        $this->load->view('i_siswa', $data);
    }

    public function save_edit_siswa() {
        if (!$this->session->userdata('userlogin')) {
            redirect(base_url() . 'login');
            return;
        }

        $id = $this->input->post('id');
        $foto = $this->input->post('old_foto');

        if (!empty($_FILES['foto']['name'])) {
            $config = [
                'upload_path' => './uploads/',
                'allowed_types' => '*',
                'file_name' => strtolower(str_replace(' ', '_', $this->input->post('nama'))) . '_' . time()
            ];

            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, true);
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto = $upload_data['file_name'];
                
                $old_foto = $this->input->post('old_foto');
                if ($old_foto && file_exists('./uploads/' . $old_foto) && $old_foto != 'default.jpg') {
                    @unlink('./uploads/' . $old_foto);
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning"> Foto gagal diupload. Data lain tetap diupdate.</div>');
            }
        }

        $update_data = [
            'nama' => $this->input->post('nama'),
            'nisn' => $this->input->post('nisn'),
            'nik' => $this->input->post('nik'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'id_kelas' => $this->input->post('kelas_id'),
            'alamat' => $this->input->post('alamat'),
            'foto' => $foto
        ];

        if ($this->m_data->updatesiswa($id, $update_data)) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success"> Data berhasil diupdate</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger"> Data gagal diupdate</div>');
        }

        redirect('siswa');
    }

    public function absensi() {
        $today = strtotime("today");
        $tomorrow = strtotime("tomorrow");
        
        $data = [
            'set' => "absensi",
            'absensimasuk' => $this->m_data->get_absensi("masuk", $today, $tomorrow),
            'absensikeluar' => $this->m_data->get_absensi("keluar", $today, $tomorrow),
            'm_data' => $this->m_data
        ];

        $this->load->view('i_absensi', $data);
    }

    public function fetch_data() {
        $today = strtotime("today");
        $tomorrow = strtotime("tomorrow");

        $absensimasuk = $this->m_data->get_absensi("masuk", $today, $tomorrow);
        $absensikeluar = $this->m_data->get_absensi("keluar", $today, $tomorrow);

        echo json_encode([
            'absensimasuk' => $absensimasuk,
            'absensikeluar' => $absensikeluar
        ]);
    }
}
?>
