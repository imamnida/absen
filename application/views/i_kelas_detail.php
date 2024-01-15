<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                        <li class="breadcrumb-item active">Recap</li>
                    </ol>
                </div>
                <h4 class="page-title">Rekapitulasi Mingguan</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->

<div class="row">
                                                        <div class="col-md-12 col-xl-12">
                                                            <div class="card m-b-30">
                                                                <div class="card-body">
                                                                    <h4 class="mt-0 header-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h4>
                                                                    <div class="general-label">
                                                                    <form action="<?php site_url()?>rekapAbsen2excel" method="get">
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
                                                        </div> <!-- end col -->
            
                                                        
                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->
                <?php $this->load->view('include/footer.php'); ?>