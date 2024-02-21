<?php
$this->load->View('include/header.php');

if ($set == "devices") {
  ?>

  <div class="page-content-wrapper ">

    <div class="container-fluid">

      <div class="row">
        <div class="col-sm-12">
          <div class="page-title-box">
            <div class="btn-group float-right">
              <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Alat</a></li>
                <li class="breadcrumb-item active">Data Alat</li>
              </ol>
            </div>
            <h4 class="page-title">Reader</h4>
          </div>
          <a href="<?php base_url() ?>add_devices"><button type="button" class="btn btn-success"><i
                class="fa fa-dashboard (alias)"></i> Tambah Device</button></a>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- end page title end breadcrumb -->

      <div class="row">
        <div class="col-12">
          <div class="card m-b-30">
            <div class="card-body">
              <h4 class="mt-0 header-title">Data Alat</h4>

              <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id Device</th>
                    <th>Name</th>
                    <th>Mode</th>
                    <th>Action</th>

                  </tr>
                </thead>

                <tbody>
                  <?php if (empty($devices)) { ?>
                    <tr>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                      <td>Data tidak ditemukan</td>
                    </tr>
                  <?php } else {
                    $no = 0;
                    foreach ($devices as $row) {
                      $no++; ?>
                      <tr>
                        <td style="text-align:center">
                          <?php echo $no; ?>
                        </td>
                        <td style="text-align:center"><b class="text-success">
                            <?php echo $row->id_devices; ?>
                          </b></td>
                        <td style="text-align:center">
                          <?php echo $row->nama_devices; ?>
                        </td>
                        <td style="text-align:center">
                          <?php
                          if ($row->mode == "SCAN") {
                            echo "READER";
                          } else if ($row->mode == "ADD") {
                            echo "ADD CARD";
                          } else {
                            echo "UNKNOWN";
                          }
                          ?>
                        </td>
                        <td style="text-align:center">
                          <a href="<?= base_url() ?>/admin/edit_devices/<?= $row->id_devices ?>" class="btn btn-success"
                            title="rubah nama"><i class="fa fa-pencil"></i></a>
                          <a href="<?= base_url() ?>/admin/edit_devices_mode/<?= $row->id_devices ?>" class="btn btn-danger"
                            title="rubah mode"><i class="fa fa-gears (alias)"></i></a>
                          <!-- <a href="<?php site_url() ?>/admin/hapus_devices/<?= $row->id_devices ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a> -->
                        </td>
                      </tr>
                    <?php }
                  } ?>
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
} else if ($set == "add-devices") {
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
                  <li class="breadcrumb-item active">Add Device</li>
                </ol>
              </div>
              <h4 class="page-title">Add Devicer</h4>
            </div>


          </div>
          <div class="clearfix"></div>
        </div>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php echo "<br>";
                echo $this->session->flashdata('pesan'); ?>
                  <br>
                  <h1 class="box-title">Tambah Alat</h1>
                </div>
                <!-- /.box-header -->
                <form role="form" action="<?= base_url(); ?>/admin/save_devices" method="post">
                  <div class="box-body">
                    <!-- <div class="form-group"> -->
                    <!-- <input type="hidden" name="id" value=""> -->
                    <!-- <label>ID Alat</label>
                  <input type="number" name="id" class="form-control" placeholder="id (number)" required>
                </div> -->
                    <div class="form-group">
                      <label>Nama Devices</label>
                      <input type="text" name="nama" class="form-control" placeholder="nama devices" required>
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
    <?php
} else if ($set == "edit-devices") {
  ?>
        <div class="page-content-wrapper dashborad-v">

          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-title-box">
                  <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                      <li class="breadcrumb-item"><a href="#">admin</a></li>
                      <li class="breadcrumb-item active">Device</li>
                    </ol>
                  </div>
                  <h4 class="page-title">Edit Device</h4>
                </div>
              </div>

            </div>
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                  <?php echo "<br>";
                  echo $this->session->flashdata('pesan'); ?>
                      <br>

                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?= base_url(); ?>/admin/save_edit_devices" method="post">
                      <div class="box-body">
                        <div class="form-group">
                          <input type="hidden" name="id" value="<?php if (isset($id)) {
                            echo $id;
                          } ?>">
                          <!-- <label>ID Device</label>
                  <input type="number" name="id" class="form-control" placeholder="Enter id" required> -->
                        </div>
                        <div class="form-group">
                          <label>Nama Alat</label>
                          <input type="text" name="nama" value="<?php if (isset($nama_devices)) {
                            echo $nama_devices;
                          } ?>"
                            class="form-control" placeholder="nama bus" required>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
          </div>
      <?php
} else if ($set == "edit-devices-mode") {
  ?>
            <style>
              .labelmode {
                position: relative;
                display: inline-block;
                width: 65px;
                height: 34px;
              }

              .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
              }

              .switch input {
                display: none;
              }

              .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #2196F3;
                -webkit-transition: .4s;
                transition: .4s;
              }

              .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
              }

              input:checked+.slider {
                background-color: #2196F3;
              }

              input:focus+.slider {
                box-shadow: 0 0 1px #2196F3;
              }

              input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
              }

              .slider.round {
                border-radius: 34px;
              }

              .slider.round:before {
                border-radius: 50%;
              }
            </style>
            <div class="page-content-wrapper dashborad-v">

              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="page-title-box">
                      <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                          <li class="breadcrumb-item"><a href="#">admin</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                      </div>
                      <h4 class="page-title">Dashboard</h4>
                    </div>
                  </div>

                </div>
                <section class="content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                    <?php echo $this->session->flashdata('pesan'); ?>
                          <br>


                          <form action="<?= base_url(); ?>/admin/save_edit_devices_mode" method="post">
                            <input type="hidden" name="id" value="<?php if (isset($id)) {
                              echo $id;
                            } ?>">
                            <div class="col-md-12 text-center">
                              <label class="labelmode">
                                READER
                              </label>
                              <label class="switch">
                                <input type="checkbox" name="mode" <?php if ($mode == "ADD")
                                  echo "checked"; ?>>
                                <span class="slider round"></span>
                              </label>
                              <label class="labelmode">
                                ADD CARD
                              </label>
                            </div>
                            <div class="col-md-12 text-center" style="padding-top:30px; padding-bottom:30px;">
                              <input type="submit" class="btn btn-danger" value="Set Mode">
                            </div>
                          </form>
                        </div>
                        <!-- /.box-header -->

                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </section>
                <!-- /.content -->
              </div>
        <?php
}

$this->load->view('include/footer.php');
?>

    </div> <!-- penutup header -