<?php
$this->load->View('include/header.php');

?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Kampus</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data Kampus</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add Kampus</h4>
                        <form action="" method="POST">
                            <div class="form-row align-items-center">
                                <div class="col-4">
                                    <label class="sr-only" for="inlineFormInputGroup">Nama Kampus</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" name="kampus" required placeholder="Nama Kampus" class="form-control">
                                    </div>
                                </div>                                                                           
                                <div class="col-2">
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
                    
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">            
                        <h4 class="mt-0 header-title">Data Kampus</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kampus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($kampus)){?>
                            <tr>
                                <td colspan="3">Data tidak ditemukan</td>
                            </tr>
                            <?php 
                            }else{
                                $no=0;
                                foreach($kampus as $row){ 
                                $no++;
                                ?>
                                <tr>
                                    <td style="text-align:start"><?php echo $no;?></td>
                                    <td style="text-align:start"><b class="text-primary"><?php echo $row->kampus;?></b></td>
                                    <td style="text-align:start">
                                        <a href="<?php site_url()?>hapus_kampus?id_kampus=<?=$row->id?>" class="btn btn-danger" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="fa fa-trash"></i></a>
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

            