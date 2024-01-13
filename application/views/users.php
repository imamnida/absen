<?php
$this->load->View('include/atas.php');

if ($set=="list-users") {
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>List User</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item active">Data Users</li>
    </ol>
  </nav>
  <a href="<?php base_url()?>add_users"><button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i> Tambah Users</button></a>
</div><!-- End Page Title -->
<?php echo "<br>"; echo $this->session->flashdata('pesan');?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">List</h5>
          <!-- Table with stripped rows -->
          <div class="box-body table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
              <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($data)){?>
                <tr>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <?php } else{
                $no=0;
                foreach($data as $row){ $no++;?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama;?></td>
                  <td><?php echo $row->email;?></td>
                  <td><?php echo $row->username;?></td>
                  <td><img src="<?=base_url();?>imam/assets/img/<?php echo $row->avatar;?>" class="img-circle" width="auto" height="100px" alt="User Image"></td>
                  <td>
                    <?php
                    if ($row->id_user != 1){
                    ?>
                      <a href="<?=base_url()?>admin/edit_users/<?=$row->id_user?>" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                      <a href="<?=base_url()?>admin/hapus_users/<?=$row->id_user?>" class="btn btn-danger" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
                <?php }}?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>
                  </div>

    </div>
  </div>
 
</section>
<?php
} else if ($set=="add-users") {
?>
  <main id="main" class="main">

<div class="pagetitle">
  <h1>Add Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php base_url()?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Data User</li>
      <li class="breadcrumb-item active">Add Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-mg-auto">
    <?php echo $this->session->flashdata('pesan');?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tambah Users</h5>

          <!-- General Form Elements -->
          <?php echo form_open_multipart(base_url().'admin/save_users'); ?>
              <div class="box-body">
                <div class="form-group">
                  <!-- <input type="hidden" name="id" value=""> -->
                  <label>Nama Users</label>
                  <input type="text" name="users" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="pass" class="form-control" value="">
                </div>
                <div class="form-group">
                  <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                  <input type="file" name="image" id="InputFile" value="" required>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>

    </div>

   
  </div>
</section>

</main><!-- End #main -->
        <?php
} else if ($set=="edit-users") {
?> <main id="main" class="main">

<div class="pagetitle">
  <h1>Edit Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php base_url()?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item"><a href="<?php base_url()?>admin/list-user">User List</a></li>
      <li class="breadcrumb-item active"><a href="<?php base_url()?>admin/dashboard">Edit</a></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-mg-auto">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit</h5>

          <!-- General Form Elements -->
          <form role="form" action="<?=base_url();?>admin/save_edit_users" enctype="multipart/form-data" method="post" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>">
                  <label>Nama Users</label>
                  <input type="text" name="users" class="form-control" value="<?php if(isset($nama)){echo $nama;}?>" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php if(isset($username)){echo $username;}?>">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <input type="password" name="pass" class="form-control" value="<?php if(isset($password)){echo $password;}?>">
                    <div class="input-group-addon">
                      Ganti Password ? <input type="checkbox" name="changepass">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                <img src="<?=base_url();?>components/dist/img/<?php if(isset($avatar)){echo $avatar;}?>" width="auto" height="200px"><br>
                  <input type="hidden" name="img" value="<?php if(isset($avatar)){echo $avatar;}?>">
                  <label for="InputFile">Pilih Foto ("jpg", "jpeg", "gif", "png")</label>
                  <input type="file" name="image" id="InputFile">
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
      </div>

    </div>

   
  </div>
</section>

</main><!-- End #main -->
<?php
} 

$this->load->view('include/bawah.php');
?>