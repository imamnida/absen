<?php
$this->load->view('include/header.php');

if ($set == "sql_interface") {
?>
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Database</a></li>
                            <li class="breadcrumb-item active">SQL Interface</li>
                        </ol>
                    </div>
                    <h4 class="page-title">SQL Command Interface</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">SQL Command Interface Created by Imamd</h4>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <textarea class="form-control" name="sql_query" rows="5" placeholder="Masukkan perintah SQL di sini"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="sql_file" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" value="Jalankan Perintah SQL">Jalankan Perintah SQL</button>
                                <button type="submit" name="drop_all_tables" class="btn btn-danger" value="DROP Semua Tabel">DROP Semua Tabel</button>
                                <button type="submit" name="truncate_all_tables" class="btn btn-warning" value="Kosongkan Semua Tabel">Kosongkan Semua Tabel</button>
                                <button type="submit" name="upload_database" class="btn btn-success" value="Unggah Database">Unggah Database</button>
                            </div>
                        </form>

                        <div class="output mt-4">
                            <?php echo $output; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container -->

</div> <!-- Page content Wrapper -->

<?php
}

$this->load->view('include/footer.php');
?>
