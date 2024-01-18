<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Daftar Kelas</a></li>
                            <li class="breadcrumb-item active"><?= $kelas->kelas; ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Kelas</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex">
                        <h4 class="mt-0 header-title">Data Murid Kelas : <?php echo $kelas->kelas; ?></h4>
                        <a class="ml-auto" href="<?=base_url()?>/admin/rekap_absen/<?= $kelas->id; ?>"><button class="btn btn-primary">Rekap Absen</button></a>

                        </div>
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nis</th>
                                        <th>UID RFID</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Telp</th>
                                        <th>Gender</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if(empty($murid)){
                                    ?>
                                    <tr>
                                        <td colspan="10">Data tidak ditemukan</td>
                                    </tr>                                
                                    <?php 
                                    } else {
                                        $no = 0;
                                        foreach($murid as $row){ 
                                            if ($row->nama != "") {
                                            $no++;
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $row->nis;?></td>
                                            <td style="min-width:150px;"><b class="text-success"><?php echo $row->uid;?></b></td>
                                            <td style="min-width:250px;"><?php echo $row->nama;?></td>
                                            <td style="min-width:100px;"><?php echo $row->kelas;?></td>
                                            <td><?php echo $row->telp;?></td>
                                            <td style="min-width:50x;"><?php echo $row->gender;?></td>
                                            <td style="min-width:250px;"><?php echo $row->alamat;?></td>
                                            <td style="min-width:200px;">
                                                <?php
                                                if (!empty($row->foto)) {
                                                    echo '<img src="' . $row->foto . '" alt="Foto Siswa" style="width: 100px; height: auto;">';
                                                } else {
                                                    echo 'Tidak ada foto';
                                                }
                                                ?>
                                            </td>
                                            <td style="min-width:100px;">
                                                <a href="<?=base_url()?>/admin/detail_murid/<?=$row->id_rfid?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="<?=base_url()?>/admin/edit_rfid/<?=$row->id_rfid?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    <?php 
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>    
                        </div>
                        
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>


<?php $this->load->view('include/footer.php'); ?>