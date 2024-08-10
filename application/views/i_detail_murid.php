<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <!-- Page title and breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Daftar Kelas</a></li>
                            <li class="breadcrumb-item active">Detail Murid</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Murid</h4>
                </div>
            </div>
        </div>
        <!-- End page title and breadcrumb -->

        <div class="clearfix"></div>

        <!-- Murid details and photos -->
       
            <!-- Details column -->
            <div class="col-md-9 col-xl-9">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h1 class="mt-0 header-title d-flex justify-content-between align-items-center">
                            <?= $murid->nama; ?>
                            <a href="<?= base_url() ?>/admin/edit_rfid/<?= $murid->id_rfid ?>" class="btn btn-info btn-sm">
                                Edit <i class="fa fa-pencil"></i>
                            </a>
                        </h1>
                        <hr>
                        <td><img src="<?=base_url();?>./uploads/<?php echo $murid->foto;?>" class="img-circle" width="auto" height="100px" alt="User Image"></td>
                        <div class="table-responsive">
                        <pre>NISN:                       <?= $murid->nisn; ?></pre>
                        <pre>Kelas:                     <?= $murid->kelas; ?></pre>
                        <pre>Alamat:                    <?= $murid->alamat; ?></pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End details column -->
        </div>
        <!-- End murid details and photos -->
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>
