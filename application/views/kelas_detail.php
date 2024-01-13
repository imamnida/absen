<!-- views/rekap_absen.php -->
<?php $this->load->view('include/atas.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Kelas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
                <li class="breadcrumb-item">Data Kelas</li>
                <li class="breadcrumb-item active">Data Kelas Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <?php if (isset($message)) : ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h5>

                        <!-- General Form Elements -->
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
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php $this->load->view('include/bawah.php'); ?>
