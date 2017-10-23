<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('voucher_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('voucher');
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
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">FORM TAMBAH VOUCHER</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>admin/add_voucher" method="post" enctype="multipart/form-data">
              <div class="box-body">
									<div class="form-group">
										<label for="kategori">Jenis Voucher</label>
										<select class="form-control" name="kategori">
                    	<?php
                        foreach ($kategori as $key => $value) {
                      ?>
                        <option value="<?php echo $value->id_kategori ?>"><?php echo $value->nama_kategori; ?></option>
                      <?php } ?>
                  </select>
              		</div>
									<div class="form-group">
	                  <label for="nominal">Nominal</label>
	                  <input class="form-control" type="text" id="nominal" name="nominal" required="REQUIRED">
	                </div>
									<div class="form-group">
	                  <label for="jumlah">Jumlah Voucher</label>
	                  <input class="form-control" type="number" id="jumlah" name="jumlah" required="REQUIRED">
	                </div>
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
