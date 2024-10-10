<?php
if ($set == "dashboard") 
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Absensi Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #252F75;" class="font-sans">

    <div class="max-w-md mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold mr-2">A</div>
                <div>
                    <h1 class="font-bold" style="color: white;">Admin</h1>
                    <p class="text-sm text-gray-600" style="color: white;">Sistem Absensi</p>
                </div>
            </div>
            <div class="relative">
                <i class="fas fa-bell text-gray-600"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="bg-white rounded-lg p-5 mb-3 text-center">
            <img src="<?=base_url();?>assets/images/logogisaka.png" alt="Logo Sekolah" class="mx-auto mb-4" style="max-width: 150px;">
            <h2 class="text-xl font-bold">SELAMAT DATANG DI SISTEM INFORMASI ABSENSI TEPAT AKURAT</h2>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <!-- Jumlah Siswa -->
            <div class="bg-blue-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-graduate text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlsiswa; ?></h3>
                        <p class="text-sm">Jumlah Siswa</p>
                    </div>
                </div>
            </div>
            <!-- Scanner -->
            <div class="bg-green-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-qrcode text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlalat; ?></h3>
                        <p class="text-sm">Scanner</p>
                    </div>
                </div>
            </div>
            <!-- Siswa Masuk -->
            <div class="bg-yellow-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-door-open text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlmasuk; ?></h3>
                        <p class="text-sm">Siswa Masuk</p>
                    </div>
                </div>
            </div>
            <!-- Jumlah Kelas -->
            <div class="bg-indigo-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-school text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $kelas; ?></h3>
                        <p class="text-sm">Jumlah Kelas</p>
                    </div>
                </div>
            </div>
            <!-- Siswa Alfa -->
            <div class="bg-red-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-times text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jumlah_tidak_absensi; ?></h3>
                        <p class="text-sm">Siswa Alfa</p>
                    </div>
                </div>
            </div>
            <!-- Siswa Keluar -->
            <div class="bg-purple-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-door-closed text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlkeluar; ?></h3>
                        <p class="text-sm">Siswa Keluar</p>
                    </div>
                </div>
            </div>
            <!-- Siswa Izin -->
            <div class="bg-orange-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-check text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlizin; ?></h3>
                        <p class="text-sm">Siswa Izin</p>
                    </div>
                </div>
            </div>
            <!-- Siswa Sakit -->
            <div class="bg-gray-500 rounded-lg p-4 text-white">
                <div class="flex items-center justify-between">
                    <i class="fas fa-hospital text-3xl"></i>
                    <div class="text-right">
                        <h3 class="text-2xl font-bold"><?= $jmlsakit; ?></h3>
                        <p class="text-sm">Siswa Sakit</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t flex justify-between items-center p-2">
        <a href="<?=base_url();?>dashboard" class="flex flex-col items-center">
            <i class="fas fa-home text-blue-500"></i>
            <span class="text-xs">Home</span>
        </a>
        <a href="<?=base_url();?>setting" class="flex flex-col items-center">
            <i class="fas fa-chart-bar text-gray-500"></i>
            <span class="text-xs">Waktu Oprasional</span>
        </a>
        <a href="<?=base_url();?>izin" class="flex flex-col items-center">
            <i class="fas fa-qrcode text-gray-500"></i>
            <span class="text-xs">Izin</span>
        </a>
        <a href="<?=base_url();?>kelas/manage_holidays" class="flex flex-col items-center">
            <i class="fas fa-cog text-gray-500"></i>
            <span class="text-xs">Hari Libur</span>
        </a>
        <a href="<?=base_url();?>login/logout" class="flex flex-col items-center">
    <i class="fas fa-sign-out-alt text-gray-500"></i> <!-- Change the icon to 'sign-out-alt' for logout -->
    <span class="text-xs">Logout</span>
</a>

    </div>
    </div>
</body>
</html>


