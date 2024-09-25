<?php $this->load->view('include/w_header.php'); ?>
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">siswa</a></li>
                        <li class="breadcrumb-item active">siswa Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit siswa</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">General Form</h4>
                    <div class="general-label">
                    <form role="form" action="<?=base_url();?>wad/save_edit_siswa" method="post">              
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" placeholder="nama" value="<?php if(isset($nama)){echo $nama;}?>" required>
                </div>
                <div class="form-group">
                  <label>Nis</label>
                  <input type="text" name="nis" class="form-control" placeholder="Nis" value="<?php if(isset($nis)){echo $nis;}?>" required>
                </div>
                <div class="form-group">
                  <label>Telp</label>
                  <input type="text" name="telp" class="form-control" placeholder="telp" value="<?php if(isset($telp)){echo $telp;}?>" required>
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select name="gender" class="form-control">
                  <option <?php if($gender == "l"){echo "selected";} ?> value="l">Laki-Laki</option>
                    <option <?php if($gender == "p"){echo "selected";} ?> value="p">Perempuan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Kampus</label>
                  <select name="kampus_id" class="form-control">
                    <?php
                      foreach ($list_kampus as $kampus) {
                    ?>
                      <option <?php if($kampus != null && $kampus->id == $id_kampus){ ?> selected <?php } ?> value="<?php echo $kampus->id; ?>"><?php echo $kampus->kampus; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Kelas</label>
                  <select name="kelas_id" class="form-control">
                    <?php
                      foreach ($list_kelas as $kls) {
                    ?>
                      <option <?php if($kelas != null && $kls->id == $kelas->id){ ?> selected <?php } ?> value="<?php echo $kls->id; ?>"><?php echo $kls->kelas; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php if(isset($alamat)){echo $alamat;}?>" required>
                </div>
                <div class="form-group">
                  <label>Link Foto</label>
                  <input type="text" name="alamat" class="form-control" placeholder="Link Google Drive" value="<?php if(isset($foto)){echo $foto;}?>" required>
                </div>
                <div class="form-group">
                  <label>Link Kartu Keluarga</label>
                  <input type="text" name="alamat" class="form-control" placeholder="Link Google Drive" value="<?php if(isset($kaka)){echo $kaka;}?>" required>
                </div>
                <div class="form-group">
                  <label>Link Foto Rumah</label>
                  <input type="text" name="alamat" class="form-control" placeholder="Link Google Drive" value="<?php if(isset($rumah)){echo $rumah;}?>" required>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>              
            </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <?php $this->load->view('include/footer.php'); ?>