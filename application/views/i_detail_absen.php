<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Daftar Kelas</a></li>
                            <li class="breadcrumb-item"><?= $kelas->kelas; ?></li>
                            <li class="breadcrumb-item active">Rekap Absen</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Rekap Absen</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h4>
                        <div class="general-label">
                            <form action="" method="get">
                                <div class="row mb-3">
                                    <label for="tanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="tanggalMulai" value="<?php if(isset($_GET['tanggalMulai'])){echo $_GET['tanggalMulai'];}  ?>" class="form-control" required>
                                    </div>
                                    <label for="tanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="tanggalSelesai" value="<?php if(isset($_GET['tanggalSelesai'])){echo $_GET['tanggalSelesai'];}  ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <input type="hidden" name="id_kelas" value="<?php echo $kelas->id; ?>">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Ambil Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>           
        <?php if (!empty($_GET['tanggalMulai']) && !empty($_GET['tanggalSelesai'])) { ?>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h4>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <?php
                                        $date = strtotime($_GET['tanggalMulai']);
                                        $end_date = strtotime($_GET['tanggalSelesai']);
                                        while ($date <= $end_date) {
                                        ?>
                                            <th><?= date('Y-m-d', $date); ?></th>
                                        <?php
                                            $date = strtotime("+1 day", $date);
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($rekap_absen)) {
                                        $no = 0;
                                        foreach ($rekap_absen as $row) {
                                            $no++;
                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row->nis; ?></td>
                                                <td><?php echo $row->nama; ?></td>
                                                <?php
                                                $date = strtotime($_GET['tanggalMulai']);
                                                $end_date = strtotime($_GET['tanggalSelesai']);
                                                while ($date <= $end_date) {
                                                    if(date("D",$date) != "Sat" && date("D",$date) != "Sun"){
                                                    
                                                        $formatted_date = date('Y-m-d', $date);
                                                        $absen_found = false;
    
                                                        $tulisan_absen = "";
                                                        foreach ($row->absensi as $absen) {
                                                            if (date('Y-m-d', $absen->created_at) == $formatted_date) {
                                                                if($absen->keterangan == "masuk"){
                                                                    $tulisan_absen = "masuk";
                                                                }
                                                                 if($absen->keterangan == "keluar"){
                                                                    $tulisan_absen = "masuk-keluar";
                                                                }
                                                                $absen_found = true;
                                                                // break;
                                                            }
                                                        }
                                                        if (!$absen_found) {
                                                            $tulisan_absen = '-';
                                                        }
                                                        echo '<td>'.$tulisan_absen.'</td>';
                                                        
                                                    }else{
                                                        echo '<td>Libur</td>';
                                                        
                                                    }
                                                        $date = strtotime("+1 day", $date);
                                                    
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="<?php echo isset($rekap_absen) ? (count($rekap_absen) + 3) : 0; ?>">Tidak ada data kehadiran dalam rentang tanggal yang diminta.</td>
                                        </tr>
                                    <?php
                                    }}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>
