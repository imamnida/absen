<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi | Barcode</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png">
    <link href="<?= base_url(); ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Absensi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">Safety</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Fast</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Accurate</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="col-md-12 text-center mb-3">
        <h2><?= $this->session->userdata('nama'); ?></h2>
    </div>

    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo" height="150">
                                    </div>
                                    <?php if (isset($message) && !empty($message)) : ?>
                                        <div class="alert alert-dismissible fade show mt-3 <?= $message_type == 'success' ? 'alert-primary' : ($message_type == 'warning' ? 'alert-warning' : 'alert-danger'); ?>" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><?= $message_type == 'success' ? 'Well done!' : ($message_type == 'warning' ? 'Warning!' : 'Oh snap!'); ?></strong> <?= $message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="px-3 pb-3">
                                        <form id="absensiForm" action="<?= site_url('absensi_hp/absen'); ?>" method="post">
                                            <div class="form-group">
                                                <label for="nisn">NISN:</label>
                                                <input type="text" class="form-control" name="nisn" id="nisn" required style="color: black;" value="<?= $this->session->userdata('nisn'); ?>" readonly>
                                            </div>
                                            <input type="hidden" name="id_devices" value="5">
                                            <button type="button" class="btn btn-success btn-block" onclick="submitForm('masuk')">Absen Masuk</button>
                                            <button type="button" class="btn btn-danger btn-block" onclick="submitForm('keluar')">Absen Keluar</button>
                                        </form>
                                    </div>
                                    <div id="error-message" class="alert alert-danger d-none mt-3" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-material-design.js"></script>
    <script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/detect.js"></script>
    <script src="<?= base_url(); ?>assets/js/fastclick.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url(); ?>assets/js/waves.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>

    <script>
    function submitForm(action) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                const form = document.getElementById('absensiForm');
                
                // Remove existing hidden inputs if any to prevent duplication
                ['latitude', 'longitude', 'action'].forEach(name => {
                    const existingInput = document.querySelector(`input[name="${name}"]`);
                    if (existingInput) {
                        existingInput.remove();
                    }
                });

                let latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude';
                latInput.value = userLat;
                form.appendChild(latInput);

                let lngInput = document.createElement('input');
                lngInput.type = 'hidden';
                lngInput.name = 'longitude';
                lngInput.value = userLng;
                form.appendChild(lngInput);

                let actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = action;
                form.appendChild(actionInput);

                form.submit();
            }, () => {
                alert('Gagal mendapatkan lokasi Anda.');
            });
        } else {
            alert('Geolokasi tidak didukung oleh browser ini.');
        }
    }
    </script>

</body>

</html>
