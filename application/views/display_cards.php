<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print ID Card</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .card.kartu-siswa {
            position: relative;
            width: 85.6mm;
            height: 54mm;
            background-image: url('<?= base_url('assets/images/template.png'); ?>');
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            border: 2px solid #000;
            box-sizing: border-box;
            page-break-inside: avoid; 
            margin: 0 auto; /* Center the card */
        }

        .barcode {
            position: absolute;
            top: 68px;
            left: 10px;
            width: 120px;
            height: 30px;
        }

        .barcode img {
            width: 100%;
            height: auto;
        }

        .photo {
            position: absolute;
            top: 95px;
            left: 23px;
            width: 60px;
            height: 80px;
            background-size: cover;
            background-position: center;
            border-radius: 5px;
            border: 2px solid #fff;
        }

        .details {
            position: absolute;
            top: 99px;
            left: 100px;
            color: black;
            text-align: left;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
            line-height: 1;
        }

        .details table {
            border-collapse: collapse;
            width: 100%;
        }

        .details th, .details td {
            padding: 2px;
            text-align: left;
            font-size: 8px;
        }

        @media print {
            .card.kartu-siswa {
                page-break-before: always; /* Ensure each card starts on a new page */
                background-image: url('<?= base_url('assets/images/template.png'); ?>') !important;
                background-size: cover;
                background-position: center;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .photo {
                background-image: url('<?= base_url('uploads/'.$card['student']->foto); ?>') !important;
                background-size: cover;
                background-position: center;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            @page {
                size: 85.6mm 54mm; /* Set page size to ID card dimensions */
                margin: 0; /* No margin */
            }

            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
        }
    </style>
</head>
<body>
    <?php foreach ($cards as $card) { ?>
        <div class="card kartu-siswa">
            <div class="barcode">
                <img src="data:image/png;base64,<?= $card['barcode']; ?>" alt="Barcode">
            </div>
            <div class="photo" style="background-image: url('<?= base_url('uploads/'.$card['student']->foto); ?>');"></div>
            <div class="details">
                <table>
                    <tr>
                        <th>Nama</th>
                        <td><strong>: <?= $card['student']->nama; ?></strong></td>
                    </tr>
                    <tr>
                        <th>tanggal_lahir</th>
                        <td><strong>: <?= $card['student']->tanggal_lahir; ?></strong></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td><strong>: <?= $card['student']->nik; ?></strong></td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td><strong>: <?= $card['student']->nisn; ?></strong></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><strong>: <?= $card['student']->alamat; ?></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php } ?>
</body>
</html>
