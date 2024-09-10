<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sql extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sql_model');
        $this->load->helper('download');
    }

    public function index() {
        $data['output'] = '';
        $data['set'] = 'sql_interface';

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if ($this->input->post('upload_database')) {
                $data['output'] = $this->handle_upload();
            } elseif ($this->input->post('drop_all_tables')) {
                $data['output'] = $this->Sql_model->drop_all_tables();
            } elseif ($this->input->post('truncate_all_tables')) {
                $data['output'] = $this->Sql_model->truncate_all_tables();
            } elseif ($this->input->post('backup_database')) {
                $this->handle_backup();
                return; // Stop further processing after download
            } else {
                $sql_query = $this->input->post('sql_query');
                $data['output'] = $this->Sql_model->execute_sql_commands([$sql_query]);
            }
        }

        $this->load->view('i_sql_command_interface', $data);
    }

    private function handle_upload() {
        if ($_FILES['sql_file']['error'] === UPLOAD_ERR_OK) {
            $file_path = $_FILES['sql_file']['tmp_name'];
            $output = $this->Sql_model->upload_sql_file($file_path);
            $output .= "<h2>Database Berhasil Diunggah:</h2>";
            $output .= "<p>File SQL berhasil diunggah dan perintah-perintah SQL berhasil dijalankan.</p>";
        } else {
            $output = "<p>Error uploading file: " . $_FILES['sql_file']['error'] . "</p>";
        }
        return $output;
    }

    private function handle_backup() {
        $backup_file = $this->Sql_model->backup_database();
        force_download('./backups/' . $backup_file, NULL);
    }
}
?>
