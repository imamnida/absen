<?php
$this->load->View('include/w_header.php');

?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Kelas</a></li>
                            <li class="breadcrumb-item active">Kelas_list</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Class-List</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        
                    
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">            
                        <h4 class="mt-0 header-title">Class List</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Jumlah Murid</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($kelas)){?>
                            <tr>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                                <td>Data tidak ditemukan</td>
                            </tr>
                            <?php 
                            }else{
                                $no=0;
                                foreach($kelas as $row){ 
                                $no++;
                                ?>
                                <tr>
                                    <td style="text-align:start"><?php echo $no;?></td>
                                    <td style="text-align:start"><b class="text-primary"><?php echo $row->kelas;?></b></td>
                                    <?php 
                                    $jumlah_murid = $w_admin->count_murid($row->id);
                                    ?>
                                    <td style="text-align:start"><?php echo $jumlah_murid; ?></td>
                                    <td style="text-align:start">
                                        <a href="<?=base_url()?>wad/lihat_kelas?id_kelas=<?=$row->id?>" class="btn btn-success" title="Lihat Rekap"><i class="fa fa-eye"></i></a>
                                        <a href="<?php site_url()?>hapus_kelas?id_kelas=<?=$row->id?>" class="btn btn-danger" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                                        <a class="ml-auto" href="<?= base_url() ?>/wad/rekap_absen/<?= $row->id; ?>"><button class="btn btn-primary">Rekap Absen</button></a>
                                    </td>
                                </tr>
                            <?php 
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

<?php
$this->load->view('include/footer.php');
?>

            