<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Hari Libur</title>
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

       
        <!-- Add Holiday Form -->
        <div class="bg-white rounded-lg p-5 mb-6">
            <h2 class="text-xl font-bold mb-4">TAMBAHKAN HARI LIBUR</h2>
            <form action="<?php echo base_url('kelas/manage_holidays'); ?>" method="post" class="flex flex-wrap -mx-2">
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <input type="date" class="w-full p-2 border rounded" id="tanggal" name="tanggal" required>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <input type="text" class="w-full p-2 border rounded" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Tambah Hari Libur</button>
                </div>
            </form>
        </div>

        <!-- Holiday List -->
        <div class="bg-white rounded-lg p-5">
            <h2 class="text-xl font-bold mb-4">DAFTAR LIBUR</h2>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $this->session->flashdata('success'); ?></span>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Keterangan</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($holidays)): ?>
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach($holidays as $holiday): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $no++; ?></td>
                                    <td class="border px-4 py-2"><?php echo date('Y-m-d', strtotime($holiday->tanggal)); ?></td>
                                    <td class="border px-4 py-2"><?php echo $holiday->keterangan; ?></td>
                                    <td class="border px-4 py-2">
    <a href="<?php echo base_url('kelas/delete_holiday/'.$holiday->id); ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded text-xs" onclick="return confirm('Are you sure?')">
        <i class="fa fa-trash"></i> <!-- Only the trash icon -->
    </a>
</td>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
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