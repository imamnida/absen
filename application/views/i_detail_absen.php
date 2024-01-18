<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper ">
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
                                        <input type="date" name="tanggalMulai" class="form-control" required>
                                    </div>
                                    <label for="tanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="tanggalSelesai" class="form-control" required>
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
                                        <th>Nis</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Gender</th>
                                        <th>Alamat</th>
                                        <th>Jumlah Absensi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if(empty($rekap_absen)){
                                    ?>
                                    <tr>
                                        <td colspan="7">Data tidak ditemukan</td>
                                    </tr>                                
                                    <?php 
                                    } else {
                                        $no = 0;
                                        foreach($rekap_absen as $row){ 
                                            if ($row->nama != "") {
                                            $no++;
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $row->nis;?></td>
                                            <td style="min-width:250px;"><?php echo $row->nama;?></td>
                                            <td><?php echo $row->telp;?></td>
                                            <td style="min-width:50x;"><?php echo $row->gender;?></td>
                                            <td style="min-width:250px;"><?php echo $row->alamat;?></td>
                                            <td style="min-width:250px;"><?php echo $row->jumlah_absen;?></td>
                                        </tr>
                                    <?php 
                                            }
                                        }
                                    }
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