<?php
$this->load->View('include/header.php');

if ($set=="histori") {
?>
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Device</a></li>
                        <li class="breadcrumb-item active">Histori</li>
                    </ol>
                </div>
                <h4 class="page-title">Histori</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">            
                                            <h4 class="mt-0 header-title">Histori Device</h4>
                                                      
                                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                                <thead>
                                                <tr>
                                                <th>ID Histori</th>
                <th>UID siswa</th>
                <th>Keterangan</th>
                <th>Nama Device</th>
                <th>Waktu</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                <?php if(empty($histori)){?>
                <tr>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                </tr>
                <?php } else{
                foreach($histori as $row){ ?>
                <tr>
                  <td><b class="text-success"><?php echo $row->id_histori;?></b></td>
                  <td><?php echo $row->uid;?></td>
                  <td><?php echo $row->keterangan;?></td>
                  <td><?php echo $row->nama_devices;?> (<?php echo $row->id_devices;?>)</td>
                  <td><?php echo date("d M Y, H:i:s",$row->waktu);?></td>
                </tr>
                <?php }}?>
                                                     </tbody>
                                            </table>            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->
                <?php
} 

$this->load->view('include/footer.php');
?>