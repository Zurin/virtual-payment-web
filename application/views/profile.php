<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('profile_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('profile');
			if(!$sukses==""){
	?>
	<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $sukses; ?>
  </div>
	<?php } ?>
</section>
<section class="content">
  <div class="row">
    <!-- general form elements -->
            <div class="col-md-8 col-md-offset-2">
                  <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">UBAH AVATAR</h3>
                    </div>
                    <form action="<?php echo base_url(); ?>home/proses_avatar" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <center>
                        <?php
                          if ($avatar=='') {
                         ?>
                           <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                        <?php } else {?>
                          <img src="<?php echo base_url(); ?>assets/asset/profile/<?php echo $avatar; ?>" class="img-circle" alt="User Image" width="215" height="215">
                        <?php } ?>
                      </center>
                      <div class="form-group">
                        <label for="avatar">File Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" required="REQUIRED">
                      </div>
                      <p>Upload gambar dengan tinggi dan lebar yang sama (persegi) untuk menghasilkan avatar yang sesuai.</p>
                    </div>
                    <div class="box-footer">
                      <center>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                      </center>
                    </div>
                  </form>
                </div>
            </div>
    				<div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">BASIC INFO</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url(); ?>home/proses_profile" method="post" enctype="multipart/form-data">
                  <div class="box-body">
    									<div class="form-group">
    										<label for="nama">Nama Lengkap</label>
    										<input type="text" class="form-control" name="nama" id="nama" required="REQUIRED" value="<?php echo $nama; ?>">
    									</div>
    									<div class="form-group">
    										<label for="email">E-mail</label>
    										<input type="email" class="form-control" name="email" id="email" required="REQUIRED" value="<?php echo $email; ?>">
    									</div>
                      <div class="form-group">
    										<label for="no_hp">No. HP</label>
    										<input type="text" class="form-control" name="no_hp" id="no_hp" required="REQUIRED" value="<?php echo $no_hp; ?>" maxlength="13">
    									</div>
                  	</div>
                  <!-- /.box-body -->
                  <div class="box-footer">
    								<center>
    									<button type="submit" class="btn btn-primary">Simpan</button>
    									<button type="reset" name="reset" class="btn btn-danger">Batal</button>
    								</center>
                  </div>
                </form>
              </div>
    				</div>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">UBAH PASSWORD</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>home/proses_password" method="post" enctype="multipart/form-data">
              <div class="box-body">
                  <div class="form-group">
                    <label for="password1">Password Lama</label>
                    <input type="password" class="form-control" name="password1" id="password1" required="REQUIRED" placeholder="Masukkan password lama">
                  </div>
                  <div class="form-group">
                    <label for="password2">Password Baru</label>
                    <input type="password" class="form-control" name="password2" id="password2" required="REQUIRED" placeholder="Masukkan password baru">
                  </div>
                  <div class="form-group">
                    <label for="password1">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" name="konf_password" id="konf_password" required="REQUIRED" placeholder="Masukkan ulang password baru Anda">
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <center>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" name="reset" class="btn btn-danger">Batal</button>
                </center>
              </div>
            </form>
          </div>
        </div>
</section>
