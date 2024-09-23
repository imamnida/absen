<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Daftar</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/gi.png">
    <link href="<?= base_url(); ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
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
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .card-body {
            padding: 20px;
        }
        .text-center img {
            height: 150px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body class="fixed-left">
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center pt-3">
                            <a href="#">
                                <img src="<?= base_url(); ?>assets/images/logo.png" alt="logo">
                            </a>
                        </div>
                        <div class="p-3">
                            <?php if ($is_success): ?>
                                <div class="alert alert-success text-center">
                                    Registrasi Berhasil! Terima kasih telah mendaftar.
                                </div>
                            <?php else: ?>
                                <?php if (isset($upload_error)): ?>
                                    <div class="alert alert-danger text-center">
                                        <?= $upload_error ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo validation_errors(); ?>
                                <?php echo form_open_multipart('register/submit'); ?>
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <small class="form-text text-muted">Contoh: IMAM DIENUL BAYAN</small>
                                        <input class="form-control" type="text" name="nama" id="nama" required placeholder="Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir:</label>
                                        <small class="form-text text-muted">Contoh: Majalengka, 29 Agustus 2005</small>
                                        <input class="form-control" type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" required placeholder="Tempat, Tanggal Lahir">
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas:</label>
                                        <select class="form-control" id="kelas" name="id_kelas">
                                            <option value="">--Pilih Kelas--</option>
                                            <?php foreach ($kelas as $row): ?>
                                                <option value="<?= $row->id ?>"><?= $row->kelas ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nisn">NISN:</label>
                                        <small class="form-text text-muted">Contoh: 1212838392</small>
                                        <input class="form-control" type="text" name="nisn" id="nisn" required placeholder="NISN">
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK:</label>
                                        <small class="form-text text-muted">Contoh: 1212838392</small>
                                        <input class="form-control" type="number" name="nik" id="nik" required placeholder="NIK">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat:</label>
                                        <small class="form-text text-muted">Contoh: Desa Cibeureum, Kec. Talaga, Kab. Majalengka</small>
                                        <input class="form-control" type="text" name="alamat" id="alamat" required placeholder="Alamat">
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto:</label>
                                        <input class="form-control" type="file" name="foto" id="foto" required>
                                        <small class="form-text text-muted">Upload foto Anda di sini</small>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Daftar</button>
                                    </div>
                                <?php echo form_close(); ?>
                            <?php endif; ?>
                            <div class="form-group text-center">
                                <a href="#" class="text-muted">Already have an account?</a>
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
    <script src="<?= base_url(); ?>assets/js/app.js"></script>
</body>
</html>
