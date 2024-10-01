<?php
$this->load->view('include/header.php');
?>

<div class="page-content-wrapper">
    <div class="container-fluid">
      
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Kelas</a></li>
                            <li class="breadcrumb-item active">WAKTU LIBUR</li>
                        </ol>
                    </div>
                    <h4 class="page-title">WAKTU LIBUR</h4>
                </div>
            </div>
        </div>

      
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">TAMBAHKAN HARI LIBUR</h4>
                        <form action="<?php echo base_url('kelas/manage_holidays'); ?>" method="post">
                            <div class="form-row align-items-center">
                                <div class="col-4">
                                    <label class="sr-only" for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="col-4">
                                    <label class="sr-only" for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Tambah Hari Libur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>

       
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">DAFTAR LIBUR</h4>

                      
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                      
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($holidays)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1; ?>
                                    <?php foreach($holidays as $holiday): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($holiday->tanggal)); ?></td>
                                            <td><?php echo $holiday->keterangan; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('kelas/delete_holiday/'.$holiday->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </a>
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

<?php
$this->load->view('include/footer.php');
?>
