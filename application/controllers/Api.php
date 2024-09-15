<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_api');
        date_default_timezone_set("asia/jakarta");
    }

	public function index()
	{
		echo "REST API for Device";
	}

	public function getmodejson(){
		if (isset($_GET['key']) && isset($_GET['iddev'])) {
			$key = $this->input->get('key');
			$cekkey = $this->m_api->getkey();
			//print_r($cekkey);
			if($cekkey[0]->key == $key){
				$iddev = $this->input->get('iddev');

				$data = $this->m_api->getmode($iddev);
				if (isset($data)) {
					$mode = "-";
					foreach ($data as $key => $value) {
						$mode = $value->mode;
					}
					if ($mode == "-") {
						$array = array('status' => 'warning', 'mode' => $mode, 'ket' => 'id device tidak ditemukan');
						echo json_encode($array);
					}else{
						$array = array('status' => 'success', 'mode' => $mode, 'ket' => 'berhasil');
						echo json_encode($array);
					}
				}else{
					$array = array('status' => 'warning', 'mode' => $mode, 'ket' => 'id device tidak ditemukan');
					echo json_encode($array);
				}
			}else{
				$array = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($array);
			}
		}else{
			$array = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($array);
		}
	}


	public function addcardjson(){
		if (isset($_GET['key']) && isset($_GET['iddev']) && isset($_GET['rfid'])) {
			$key = $this->input->get('key');
			$cekkey = $this->m_api->getkey();

			if($cekkey[0]->key == $key){
				$iddev = $this->input->get('iddev');
				$rfid = $this->input->get('rfid');

				$checkDoubleRFID = $this->m_api->checkRFID($rfid);
				$z = 0;
				if (isset($checkDoubleRFID)) {
					foreach ($checkDoubleRFID as $key => $value) {
						$z++;
					}
				}

				if ($z > 0) {
					$notif = array('status' => 'failed', 'ket' => 'RFID TERDAFTAR                           .');
					echo json_encode($notif);
				}else{
					$device = $this->m_api->getdevice($iddev);
					$count = 0;
					foreach ($device as $key => $value) {
						$count++;
					}
					if ($count > 0) {
						$savedata = array('id_devices' => $iddev, 'uid' => $rfid);
						if ($this->m_api->insert_rfid($savedata)) {
							$getlastrfid = $this->m_api->last_rfid();
							$idrfid = 0;
							if (isset($getlastrfid)) {
								foreach ($getlastrfid as $key => $value) {
									$idrfid = $value->id_rfid;
								}
							}
							if ($idrfid > 0) {
								$histori = array('id_rfid' => $idrfid, 'keterangan' => 'ADD RFID CARD', 'waktu' => time(), 'id_devices' => $iddev);
								if ($this->m_api->insert_histori($histori)) {
									$notif = array('status' => 'success', 'ket' => 'DAFTAR BERHASIL                          .');
									echo json_encode($notif);
								}
							}else{
								$notif = array('status' => 'failed', 'ket' => 'terjadi kesalahan');
								echo json_encode($notif);
							}
						}
					}else{
						$notif = array('status' => 'failed', 'ket' => 'device tidak ditemukan');
						echo json_encode($notif);
					}
				}
			}else{
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		}else{
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}


	public function absensijson(){
		if (isset($_GET['key']) && isset($_GET['iddev']) && isset($_GET['rfid'])) {
			$key = $this->input->get('key');
			$cekkey = $this->m_api->getkey();

			if($cekkey[0]->key == $key){
				$iddev = $this->input->get('iddev');
				$rfid = $this->input->get('rfid');

				$cekrfid = $this->m_api->checkRFID($rfid);
				$countrfid = 0;
				$idrfid = 0;
				foreach ($cekrfid as $key => $value) {
					$countrfid++;
					$idrfid = $value->id_rfid;
				}

				$device = $this->m_api->getdevice($iddev);
				$count = 0;
				foreach ($device as $key => $value) {
					$count++;
				}

				if ($count > 0) {
					if ($countrfid > 0) {
						$waktu = $this->m_api->waktuoperasional();
						if (isset($waktu)) {
							foreach ($waktu as $key => $value) {
								if ($value->id_waktu_operasional == 1) {
									$masuk = $value->waktu_operasional;
								}
								if ($value->id_waktu_operasional == 2) {
									$keluar = $value->waktu_operasional;
								}
							}
						}else{
							$notif = array('status' => 'failed', 'ket' => 'error waktu operasional');
							echo json_encode($notif);
						}
						if (isset($masuk) && isset($keluar)) {
							$masuk = explode("-", $masuk);
							$keluar = explode("-", $keluar);
							if (isset($masuk[0]) && isset($masuk[1]) && isset($keluar[0]) && isset($keluar[1])) {
								$masuk1 = strtotime($masuk[0]);
								$masuk2 = strtotime($masuk[1]);
								$keluar1 = strtotime($keluar[0]);
								$keluar2 = strtotime($keluar[1]);
								
								$absen = false;
								$ket = "";
								$respon = "";

								if (time() < $masuk1) {
									$notif = array('status' => 'failed', 'ket' => 'DILUAR WAKTU                          .');
									echo json_encode($notif);
								}
								if (time() >= $masuk1 && time() <= $masuk2) {
									$absen = true;
									$ket = "masuk";
									$respon = "MASUK BERHASIL                        .";
								}
								if (time() > $masuk2 && time() <= $masuk2 + 3600) {			//3600 = 1 jam
									$absen = true;
									$ket = "masuk";
									$respon = "TELAT                            .";
								}
								if (time() > $masuk2 + 3600 && time() < $keluar1 ) {			//3600 = 1 jam
									$notif = array('status' => 'failed', 'ket' => 'DILUAR WAKTU                          .');
									echo json_encode($notif);
								}
								if (time() >= $keluar1 && time() <= $keluar2 + 3600) {
									$absen = true;
									$ket = "keluar";
									$respon = "KELUAR                             .";
								}
								if (time() > $keluar2 + 3600) {
									$notif = array('status' => 'failed', 'ket' => 'DILUAR WAKTU                          .');
									echo json_encode($notif);
								}

								if ($absen) {
									$today = strtotime("today");
									$tomorrow = strtotime("tomorrow");

									$datamasuk = $this->m_api->get_absensi("masuk",$today,$tomorrow);
									$datakeluar = $this->m_api->get_absensi("keluar",$today,$tomorrow);

									$duplicate = 0;
									if (isset($datamasuk)) {
										foreach ($datamasuk as $key => $value) {
											if ($value->id_rfid == $idrfid && $value->keterangan == $ket) {
												$duplicate++;
											}
										}
									}
									if (isset($datakeluar)) {
										foreach ($datakeluar as $key => $value) {
											if ($value->id_rfid == $idrfid && $value->keterangan == $ket) {
												$duplicate++;
											}
										}
									}

									if ($duplicate == 0) {
										$data = array('id_devices' => $iddev, 'id_rfid' => $idrfid,
														'keterangan' => $ket, 'created_at' => time());
										if ($this->m_api->insert_absensi($data)) {
											$histori = array('id_rfid' => $idrfid, 'keterangan' => $ket, 'waktu' => time(), 'id_devices' => $iddev);
											$this->m_api->insert_histori($histori);
											$notif = array('status' => 'success', 'ket' => $respon);
											echo json_encode($notif);
										}else{
											$notif = array('status' => 'failed', 'ket' => 'gagal insert absensi');
											echo json_encode($notif);
										}
									}else{
										$notif = array('status' => 'failed', 'ket' => 'SUDAH ABSENSI                            .');
										echo json_encode($notif);
									}	
								}
							}
						}else{
							$notif = array('status' => 'failed', 'ket' => 'error waktu operasional');
							echo json_encode($notif);
						}
					}else{
						$notif = array('status' => 'failed', 'ket' => 'HUBUNGI STAFF                           .');
						echo json_encode($notif);
					}
				}else{
					$notif = array('status' => 'failed', 'ket' => 'id device tidak ditemukan');
					echo json_encode($notif);
				}
			}else{
				$notif = array('status' => 'failed', 'ket' => 'salah secret key');
				echo json_encode($notif);
			}
		}else{
			$notif = array('status' => 'failed', 'ket' => 'salah parameter');
			echo json_encode($notif);
		}
	}

	public function realtimehistori(){
		$data = $this->m_admin->get_history();
		echo '<table id="t1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align:center">ID Histori</th>
                  <th style="text-align:center">UID RFID</th>
                  <th style="text-align:center">Keterangan</th>
                  <th style="text-align:center">Nama Device</th>
                  <th style="text-align:center">Waktu</th>
                </tr>
                </thead>
                <tbody>';
        if(empty($data)){
        	echo '
                <tr>
                  <td style="text-align:center">Data tidak ditemukan</td>
                  <td style="text-align:center">Data tidak ditemukan</td>
                  <td style="text-align:center">Data tidak ditemukan</td>
                  <td style="text-align:center">Data tidak ditemukan</td>
                  <td style="text-align:center">Data tidak ditemukan</td>
                </tr>';
        } else{
            foreach($data as $row){
            	echo '
                <tr>
                  <td style="text-align:center"><b class="text-success">'.$row->id_histori.'</b></td>
                  <td style="text-align:center">'.$row->uid.'</td>
                  <td style="text-align:center">'.$row->keterangan.'</td>
                  <td style="text-align:center">'.$row->nama_devices.' ('.$row->id_devices.')</td>
                  <td style="text-align:center">'.date("d M Y, H:i:s",$row->waktu).'</td>
                </tr>';
            }
        }
        echo '
                </tbody>
              </table>';
	}

}
