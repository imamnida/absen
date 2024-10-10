<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Tidak Hadir Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #252F75;" class="font-sans">
    <div class="max-w-4xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold mr-2">A</div>
                <div>
                    <h1 class="font-bold text-white">Admin</h1>
                    <p class="text-sm text-white">Sistem Absensi</p>
                </div>
            </div>
            <div class="relative">
                <i class="fas fa-bell text-white"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
            </div>
        </div>


        <h2 class="text-2xl font-bold text-white-800 mb-4">Siswa Tidak Hadir Hari Ini</h2>

        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Kelas</h3>
            <?php if(empty($kelas)): ?>
                <p class="text-gray-600">Data tidak ditemukan</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach($kelas as $row): ?>
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-semibold text-blue-600"><?php echo $row->kelas; ?></h4>
                                    <?php 
                                    $jumlah_tidak_absensi = isset($jumlah_tidak_absensi_per_kelas[$row->id]) ? $jumlah_tidak_absensi_per_kelas[$row->id] : 0;
                                    ?>
                                    <p class="text-sm text-gray-600">Jumlah Murid Tidak Hadir: <?php echo $jumlah_tidak_absensi; ?></p>
                                </div>
                                <a href="<?= base_url() ?>izin/detail/<?= $row->id ?>" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-600">
                                    <i class="fas fa-eye mr-2"></i>Detail
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Navigation Footer -->
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
</body>
</html>