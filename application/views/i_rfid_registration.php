<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>DAFTAR</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?=base_url();?>assets/images/logo.png">
    <link href="<?=base_url();?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .wrapper-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 600px;
        }
    </style>
</head>
<body class="fixed-left">
    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center pt-3">
                            <a href="#">
                                <img src="<?=base_url();?>assets/images/logo.png" alt="logo" height="200">
                            </a>
                        </div>
                        <div class="p-3">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open_multipart('register/register'); ?>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="nis" id="nis" required placeholder="NIS">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="nama" id="nama" required placeholder="Nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="telp" id="telp" required placeholder="Telepon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">Pilih Gender</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="alamat" id="alamat" required placeholder="Alamat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <select class="form-control" name="id_kelas" id="id_kelas" required>
                                            <option value="">Pilih Kelas</option>
                                            <?php foreach ($kelas as $k): ?>
                                                <option value="<?php echo $k->id; ?>"><?php echo $k->kelas; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <select class="form-control" name="id_kampus" id="id_kampus" required>
                                            <option value="">Pilih Kampus</option>
                                            <?php foreach ($kampus as $k): ?>
                                                <option value="<?php echo $k->id; ?>"><?php echo $k->kampus; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="penyakit" id="penyakit" required placeholder="Penyakit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="text" name="nomerortu" id="nomerortu" required placeholder="Nomor Orang Tua">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="foto">Foto:</label>
                                        <input class="form-control" type="file" name="foto" id="foto" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="kaka">Kartu Keluarga:</label>
                                        <input class="form-control" type="file" name="kaka" id="kaka" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="rumah">Foto Rumah:</label>
                                        <input class="form-control" type="file" name="rumah" id="rumah" required>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <div class="form-group text-center row m-t-20">
                                    <div class="col-12">
                                        <button class="btn btn-raised btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                            <div class="form-group m-t-10 mb-0 row">
                                <div class="col-12 m-t-20 text-center">
                                    <a href="#" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap-material-design.js"></script>
    <script src="<?=base_url();?>assets/js/modernizr.min.js"></script>
    <script src="<?=base_url();?>assets/js/detect.js"></script>
    <script src="<?=base_url();?>assets/js/fastclick.js"></script>
    <script src="<?=base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?=base_url();?>assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url();?>assets/js/waves.js"></script>
    <script src="<?=base_url();?>assets/js/jquery.nicescroll.js"></script>
    <script src="<?=base_url();?>assets/js/jquery.scrollTo.min.js"></script>
    <!-- App js -->
    <script src="<?=base_url();?>assets/js/app.js"></script>
</body>
</html>
