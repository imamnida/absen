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
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- end page title end breadcrumb -->

      <!-- Form untuk menambah device -->
      <div class="row">
        <div class="col-12">
          <div class="card m-b-30">
            <div class="card-body">
              <h4 class="mt-0 header-title">Tambah Device</h4>
              <form id="add-device-form" action="<?= base_url(); ?>/devices/save_devices" method="post">
                <div class="form-group">
                  <label>Nama Devices</label>
                  <input type="text" name="nama" class="form-control" placeholder="nama devices" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End form untuk menambah device -->

      <div class="row">
        <div class="col-12">
          <div class="card m-b-30">
            <div class="card-body">
              <h4 class="mt-0 header-title">Data Alat</h4>

              <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                <thead>
                  <tr>
                    <th>No</th>
                   
                    <th>Name</th>
                    <th>Mode</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php if (empty($devices)) { ?>
                    <tr>
                      <td colspan="5" style="text-align:center">Data tidak ditemukan</td>
                    </tr>
                  <?php } else {
                    $no = 0;
                    foreach ($devices as $row) {
                      $no++; ?>
                      <tr>
                        <td style="text-align:center"><?php echo $no; ?></td>

                        <td style="text-align:center"><?php echo $row->nama_devices; ?></td>
                        <td style="text-align:center" class="mode-cell" data-id="<?= $row->id_devices ?>">
                          <?php echo $row->mode == "SCAN" ? "READER" : "ADD CARD"; ?>
                        </td>
                        <td style="text-align:center">
                          <button class="btn btn-sm btn-toggle mode-toggle" data-id="<?= $row->id_devices ?>" data-mode="<?= $row->mode ?>">
                            <?php echo $row->mode == "ADD" ? "READ" : "ADD"; ?>
                          </button>
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
}

$this->load->view('include/footer.php');
?>

<script>
  $(document).ready(function() {
    $('.mode-toggle').click(function() {
      var deviceId = $(this).data('id');
      var currentMode = $(this).data('mode');
      var newMode = currentMode == 'ADD' ? 'SCAN' : 'ADD';

      $.ajax({
        url: '<?= base_url("devices/update_device_mode") ?>',
        type: 'POST',
        data: {
          id: deviceId,
          mode: newMode
        },
        success: function(response) {
          var newModeText = newMode == 'ADD' ? 'ADD CARD' : 'READER';
          var newButtonText = newMode == 'ADD' ? 'Click to READER' : 'Click to ADD';
          $('.mode-cell[data-id="' + deviceId + '"]').text(newModeText);
          $('.mode-toggle[data-id="' + deviceId + '"]').data('mode', newMode).text(newButtonText);
        }
      });
    });

    $('#add-device-form').submit(function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
          location.reload(); // Reload the page to reflect new device
        }
      });
    });
  });
</script>
