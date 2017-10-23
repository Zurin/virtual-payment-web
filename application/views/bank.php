<section class="content-header">
  <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Setelah data bank Anda tersimpan, Anda hanya dapat mengubahnya 1 kali! Pastikan data yang Anda masukkan benar!
  </div>
	<?php
			$confirm=$this->session->flashdata('bank_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('bank');
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
    				<div class="col-md-6 col-md-offset-3">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">FORM BANK USER</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url().$link; ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
    									<div class="form-group">
    										<label for="nama_bank">Nama bank</label>
    										<input type="text" class="form-control" name="nama_bank" id="nama_bank" required="REQUIRED" value="<?php echo $nama_bank; ?>" <?php echo $edit; ?>>
    									</div>
    									<div class="form-group">
    										<label for="no_rekening">No rekening</label>
    										<input type="text" class="form-control" name="no_rekening" id="no_rekening" required="REQUIRED" value="<?php echo $no_rekening; ?>" <?php echo $edit; ?>>
    									</div>
                      <div class="form-group">
    										<label for="atas_nama">Atas nama</label>
    										<input type="text" class="form-control" name="atas_nama" id="atas_nama" required="REQUIRED" value="<?php echo $atas_nama; ?>" <?php echo $edit; ?>>
    									</div>
                      <div class="form-group">
    										<label for="cabang">Cabang</label>
    										<input type="text" class="form-control" name="cabang" id="cabang" required="REQUIRED" value="<?php echo $cabang; ?>" <?php echo $edit; ?>>
    									</div>
                  	</div>
                  <!-- /.box-body -->
                  <div class="box-footer">
    								<center>
    									<button type="submit" class="btn btn-primary" <?php echo $edit; ?>><?php echo $tombol; ?></button>
    									<button type="reset" name="reset" class="btn btn-danger" <?php echo $edit; ?>>Batal</button>
    								</center>
                  </div>
                </form>
              </div>
    				</div>
  </div>
</section>
