<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Absensi extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_data');
        date_default_timezone_set("asia/jakarta");
    }

	
public function index(){
    $data['set'] = "absensi";

  
    $today = strtotime("today");
    $tomorrow = strtotime("tomorrow");

  
    $data['absensimasuk'] = $this->m_data->get_absensi("masuk", $today, $tomorrow);
    $data['absensikeluar'] = $this->m_data->get_absensi("keluar", $today, $tomorrow);
    $data['m_data'] = $this->m_data;


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



	public function lastabsensi(){
		if($this->session->userdata('userlogin'))   
		{
			if (isset($_POST['tanggal'])) {
				$tgl = $this->input->post('tanggal');
				//echo $tgl;
				$split1 = explode("-", $tgl);
				$x = 0;
				foreach ($split1 as $key => $value) {
					$date[$x] = $value;
					$x++;
				}

				$ts1 = strtotime($date[0]);
				$ts2 = strtotime($date[1]);

				$tgl1 = date("d-M-Y",$ts1);
				$tgl2 = date("d-M-Y",$ts2);

				$ts2 += 86400;

				if ($x==2) {
					$data['datamasuk'] = $this->m_data->get_absensi("masuk",$ts1,$ts2);
					$data['datakeluar'] = $this->m_data->get_absensi("keluar",$ts1,$ts2);
					$data['tanggal'] = $tgl1 . " - " . $tgl2;
					$data['waktuabsensi'] = $tgl1 . "_" . $tgl2;

					$data['set'] = "last-absensi";
					
					$data['m_data'] = $this->m_data;

					$this->load->view('v_absensi', $data);
				}else{
					redirect(base_url().'absensi');
				}				
			}else{
				redirect(base_url().'absensi');
			}
		}
	}
}