<?php
class Walikelas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Walikelas_model');
        $this->load->library('bcrypt');
    }

    public function list_walikelas() {
        $data['set'] = "list-walikelas";
        $data['data'] = $this->Walikelas_model->get_walikelas();
        $this->load->view('i_walikelas', $data);
    }

    public function add_walikelas() {
        $data['set'] = "add-walikelas";
        $this->load->view('i_walikelas', $data);
    }

    public function save_walikelas() {
        if ($this->session->userdata('userlogin')) {
            $nama = $this->input->post('nama');
            $password = $this->input->post('password');
            $nuptk = $this->input->post('nuptk');
            $kelas = $this->input->post('kelas');
            $hash = $this->bcrypt->hash_password($password);

            $data = array(
                'nama' => $nama,
                'password' => $hash,
                'nuptk' => $nuptk,
                'kelas' => $kelas,
            );

            // Check if avatar file is uploaded
            if (!empty($_FILES['avatar']['name'])) {
                $type = explode('.', $_FILES["avatar"]["name"]);
                $type = strtolower($type[count($type)-1]);
                $imgname = uniqid(rand()) . '.' . $type;
                $url = "vertical/assets/images/" . $imgname;
                if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
                    if (is_uploaded_file($_FILES["avatar"]["tmp_name"])) {
                        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $url)) {
                            $data['avatar'] = $imgname;
                        }
                    }
                } else {
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
                    redirect(base_url() . 'walikelas/add_walikelas');
                }
            }

            $this->Walikelas_model->insert_walikelas($data);
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
            redirect(base_url() . 'walikelas/list_walikelas');
        }
    }

    public function hapus_walikelas($no = null) {
        if ($this->session->userdata('userlogin')) {
            $filename = $this->Walikelas_model->get_walikelas_byid($no);
            foreach ($filename as $key) {
                $file = $key->avatar;
                $path = "vertical/assets/images/" . $file;

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            if ($this->Walikelas_model->walikelas_del($no)) {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di hapus</div>");
            } else {
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di hapus</div>");
            }

            redirect(base_url() . 'walikelas/list_walikelas');
        }
    }

    public function edit_walikelas($no = null) {
        if ($this->session->userdata('userlogin')) {
            if (isset($no)) {
                $walikelas = $this->Walikelas_model->get_walikelas_byid($no);
                foreach ($walikelas as $key => $value) {
                    $data['no'] = $no;
                    $data['nama'] = $value->nama;
                    $data['password'] = $value->password;
                    $data['nuptk'] = $value->nuptk;
                    $data['kelas'] = $value->kelas;
                    $data['avatar'] = $value->avatar;
                }
                $data['set'] = "edit-walikelas";
                $this->load->view('i_walikelas', $data);
            } else {
                redirect(base_url() . 'walikelas/list_walikelas');
            }
        }
    }

    public function save_edit_walikelas() {
        if ($this->session->userdata('userlogin')) {
            if (isset($_POST['no']) && isset($_POST['nama'])) {
                $no = $this->input->post('no');
                $nama = $this->input->post('nama');
                $nuptk = $this->input->post('nuptk');
                $kelas = $this->input->post('kelas');
                $password = $this->input->post('password');
                $hash = $this->bcrypt->hash_password($password);

                $data = array(
                    'nama' => $nama,
                    'nuptk' => $nuptk,
                    'kelas' => $kelas,
                );

                // Check if avatar file is uploaded
                if (!empty($_FILES['avatar']['name'])) {
                    $type = explode('.', $_FILES["avatar"]["name"]);
                    $type = strtolower($type[count($type) - 1]);
                    $imgname = uniqid(rand()) . '.' . $type;
                    $url = "vertical/assets/images/" . $imgname;
                    if (in_array($type, array("jpg", "jpeg", "gif", "png"))) {
                        if (is_uploaded_file($_FILES["avatar"]["tmp_name"])) {
                            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $url)) {
                                $data['avatar'] = $imgname;

                                // Remove previous avatar file
                                $file = $this->input->post('img');
                                $path = "vertical/assets/images/" . $file;
                                if (file_exists($path)) {
                                    unlink($path);
                                }
                            }
                        }
                    } else {
                        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan, ekstensi gambar salah</div>");
                        redirect(base_url() . 'walikelas/edit_walikelas/' . $no);
                    }
                }

                // Check if password change is requested
                if (isset($_POST['changepass'])) {
                    $data['password'] = $hash;
                }

                if ($this->Walikelas_model->update_walikelas($no, $data)) {
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data berhasil di simpan</div>");
                } else {
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> Data gagal di simpan</div>");
                }

                redirect(base_url() . 'walikelas/list_walikelas');
            }
        }
    }
}
?>
