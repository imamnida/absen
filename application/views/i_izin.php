<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Siswa</a></li>
                            <li class="breadcrumb-item active">Izin Hari Ini</li>
                        </ol>
                    </div>
                    <h4 class="page-title">SISWA TIDAK HADIR HARI INI</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">            
                        <h4 class="mt-0 header-title">Class List</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Murid Tidak Hadir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($kelas)): ?>
                                    <tr>
                                        <td colspan="4">Data tidak ditemukan</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1; ?>
                                    <?php foreach($kelas as $row): ?>
                                        <tr>
                                            <td style="text-align:start"><?php echo $no++; ?></td>
                                            <td style="text-align:start"><b class="text-primary"><?php echo $row->kelas; ?></b></td>
                                            <?php 
                                            // Mengambil jumlah siswa di dalam kelas yang tidak hadir hari ini
                                            $jumlah_tidak_hadir = isset($jumlah_tidak_hadir_per_kelas[$row->id]) ? $jumlah_tidak_hadir_per_kelas[$row->id] : 0;
                                            ?>
                                            <td style="text-align:start"><?php echo $jumlah_tidak_hadir; ?></td>
                                            <td style="text-align:start">
                                                <a href="<?= base_url() ?>izin/detail/<?= $row->id ?>" class="btn btn-success" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<?php $this->load->view('include/footer.php'); ?>
