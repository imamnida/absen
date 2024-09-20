<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_hp extends CI_Controller {

    private $coordinatesDMS = "6°50'23\"S 108°14'19\"E";  
    private $centerLat;
    private $centerLng;
    private $allowedRadius = 100; 

    public function __construct() {
        parent::__construct();
     
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Absensi_hp_model');
        list($this->centerLat, $this->centerLng) = $this->convertDMSToDecimal($this->coordinatesDMS);
    }

    private function convertDMSToDecimal($dms) {
        $dms = strtoupper(trim($dms));
        $parts = explode(' ', $dms);

        if (count($parts) != 2) {
            throw new Exception("Format koordinat tidak valid.");
        }

        $latDMS = $parts[0];
        $lngDMS = $parts[1];

        return [
            $this->dmsToDecimal($latDMS),
            $this->dmsToDecimal($lngDMS)
        ];
    }

    private function dmsToDecimal($dms) {
        $dms = str_replace(['°', "'", '"'], [' ', ' ', ' '], $dms);
        $dms = preg_replace('/\s+/', ' ', $dms);

        if (preg_match('/(-?\d+)\s+(\d+)\s+(\d+)\s*([NSEW])/', $dms, $matches)) {
            $degrees = (float)$matches[1];
            $minutes = (float)$matches[2];
            $seconds = (float)$matches[3];
            $direction = $matches[4];

            $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
            if ($direction === 'S' || $direction === 'W') {
                $decimal *= -1;
            }
            return $decimal;
        } else {
            throw new Exception("Format DMS tidak valid.");
        }
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2) {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function index() {
        $this->load->view('i_absen_hp');
    }

    public function absen() {
        $action = $this->input->post('action');
        $this->absen_process($action);
    }

    private function absen_process($action) {
        $nisn = $this->session->userdata('nisn');
        $nama = $this->session->userdata('nama');
        $id_devices = $this->input->post('id_devices');
        $deviceLat = $this->input->post('latitude');
        $deviceLng = $this->input->post('longitude'); 
        if (!$nisn) {
            redirect(base_url().'siswa');
        }

        $is_registered_nisn = $this->Absensi_hp_model->is_registered_nisn($nisn);

        if (!$is_registered_nisn) {
            $data['message'] = 'NISN belum terdaftar. Silakan mendaftar terlebih dahulu.';
            $data['message_type'] = 'danger';
            $this->load->view('i_absen_hp', $data);
            return;
        }

        $distance = $this->calculateDistance($this->centerLat, $this->centerLng, $deviceLat, $deviceLng);
        if ($distance > $this->allowedRadius) {
            $data['message'] = 'Anda berada di luar area absensi yang diizinkan.';
            $data['message_type'] = 'danger';
            $this->load->view('i_absen_hp', $data);
            return;
        }

        // Check operational time for the current day and action
        if (!$this->Absensi_hp_model->cek_waktu_operasional($action)) {
            $data['message'] = 'Absensi ' . $action . ' hanya dapat dilakukan pada jam operasional yang ditentukan.';
            $data['message_type'] = 'danger';
            $this->load->view('i_absen_hp', $data);
            return;
        }

        $is_already_absent = $this->Absensi_hp_model->is_already_absent($nisn, $action);

        if ($is_already_absent) {
            $data['message'] = 'Anda sudah melakukan absensi '.$action.' sebelumnya hari ini.';
            $data['message_type'] = 'warning';
        } else {
            if ($action == 'masuk') {
                $this->Absensi_hp_model->absen_masuk($nisn, $id_devices);
                $data['message'] = 'Absensi masuk berhasil.';
            } elseif ($action == 'keluar') {
                $this->Absensi_hp_model->absen_keluar($nisn, $id_devices);
                $data['message'] = 'Absensi keluar berhasil.';
            } else {
                $data['message'] = 'Aksi absensi tidak valid.';
                $data['message_type'] = 'danger';
            }
            $data['message_type'] = 'success';
        }

        $this->load->view('i_absen_hp', $data);
    }
}
?>
