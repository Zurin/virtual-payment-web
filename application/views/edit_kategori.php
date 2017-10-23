<section class="content">
<!-- general form elements -->
				<div class="col-md-6 col-md-offset-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">FORM EDIT KATEGORI</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>admin/edit_kat_proses" method="post" enctype="multipart/form-data">
              <div class="box-body">
									<div class="form-group">
										<label for="kode_kat">Kode Kategori</label>
										<input type="text" class="form-control" name="kode_kat" id="kode_kat" readonly value="<?php echo $kode; ?>">
									</div>
									<div class="form-group">
										<label for="nama_kat">Judul Kategori</label>
										<input type="text" class="form-control" id="nama_kat" name="nama_kat" required="required" value="<?php echo $kategori; ?>">
									</div>
									<div class="form-group">
			              <label for="icon">Icon kategori</label>
			              <input type="file" class="form-control" id="icon" name="icon" value="<?php echo $icon; ?>">
			            </div>
									<p class="text-danger">Ukuran icon direkomendasikan beresolusi 200 x 200 px</p>
              	</div>
              <!-- /.box-body -->
              <div class="box-footer">
								<center>
									<button type="submit" class="btn btn-primary">Simpan</button>
									<a href="javascript:history.back()" class="btn btn-danger">Batal</a>
								</center>
              </div>
            </form>
          </div>
				</div>
</section>
