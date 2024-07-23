<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RfidModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index() {
        $data['kelas'] = $this->RfidModel->get_kelas();
        $data['kampus'] = $this->RfidModel->get_kampus();
        $this->load->view('rfid_registration', $data);
    }

    public function register() {
        $this->form_validation->set_rules('nis', 'NIS', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('id_kampus', 'Kampus', 'required');
        $this->form_validation->set_rules('penyakit', 'Penyakit', 'required');
        $this->form_validation->set_rules('nomerortu', 'Nomor Orang Tua', 'required');
        $this->form_validation->set_rules('foto', 'Foto', 'callback_file_check');
        $this->form_validation->set_rules('kaka', 'Kartu Keluarga', 'callback_file_check');
        $this->form_validation->set_rules('rumah', 'Foto Rumah', 'callback_file_check');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // Upload files
            $foto = $this->do_upload('foto');
            $kaka = $this->do_upload('kaka');
            $rumah = $this->do_upload('rumah');

            $data = array(
                'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'gender' => $this->input->post('gender'),
                'alamat' => $this->input->post('alamat'),
                'id_kelas' => $this->input->post('id_kelas'),
                'id_kampus' => $this->input->post('id_kampus'),
                'penyakit' => $this->input->post('penyakit'),
                'nomerortu' => $this->input->post('nomerortu'),
                'foto' => $foto,
                'kaka' => $kaka,
                'rumah' => $rumah
            );

            $this->RfidModel->insert_rfid($data);
            redirect('register/index');
        }
    }

    public function file_check($str) {
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png','image/gif');
        if (isset($_FILES[$str]['name']) && $_FILES[$str]['name'] != "") {
            $mime = get_mime_by_extension($_FILES[$str]['name']);
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only jpg/png/gif file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    private function do_upload($field) {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $config['file_name'] = $field . '_' . time();

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            log_message('error', $error);
            $this->form_validation->set_message('file_check', $error);
            return '';
        } else {
            return $this->upload->data('file_name');
        }
    }
}

?>
