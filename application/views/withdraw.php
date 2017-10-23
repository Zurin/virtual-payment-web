<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('wd_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('wd');
			if(!$sukses==""){
	?>
	<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $sukses; ?>
  </div>
	<?php } ?>
</section>
<section class="content">
<!-- general form elements -->
				<div class="col-md-6 col-md-offset-3">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">FORM WITHDRAW</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>home/proses_wd" method="post" enctype="multipart/form-data">
              <div class="box-body">
									<div class="form-group">
										<label for="jumlah_wd">Jumlah Withdraw</label>
										<input type="text" class="form-control" id="jumlah_wd" name="jumlah_wd" required="REQUIRED" placeholder="Masukkan jumlah withdraw">
									</div>
									<p class="text-danger">
										*Withdraw akan dikenai potongan sebesar <?php echo $potongan; ?>% dari jumlah withdraw
									</p>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
								<center>
									<button type="submit" class="btn btn-primary">Kirim</button>
									<button type="reset" name="reset" class="btn btn-danger">Batal</button>
								</center>
              </div>
            </form>
          </div>
				</div>
</section>
