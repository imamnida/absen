<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RfidModel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index() {
        $data['kelas'] = $this->RfidModel->get_kelas();
        $data['kampus'] = $this->RfidModel->get_kampus();

        $this->load->view('i_rfid_registration', $data);
    }

    public function submit() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            $data['kelas'] = $this->RfidModel->get_kelas();
            $data['kampus'] = $this->RfidModel->get_kampus();
            $data['upload_error'] = $error;
            $this->load->view('i_rfid_registration', $data);
        } else {
            $upload_data = $this->upload->data();
            $original_file_name = $upload_data['file_name'];
            $new_file_name = $this->input->post('nama') . $upload_data['file_ext'];

            // Rename the file
            rename('./uploads/' . $original_file_name, './uploads/' . $new_file_name);

            $data = array(
                'nama' => $this->input->post('nama'),
                'ttl' => $this->input->post('tempat_tanggal_lahir'),
                'id_kelas' => $this->input->post('id_kelas'),
                'nisn' => $this->input->post('nisn'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $new_file_name,
            );

            $this->RfidModel->insert_rfid($data);
            redirect('register');
        }
    }
}
?>
