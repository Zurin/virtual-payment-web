<section class="content">
<!-- general form elements -->
				<div class="col-md-6 col-md-offset-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">FORM EDIT DESKRIPSI</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>admin/edit_des_proses" method="post" enctype="multipart/form-data">
              <div class="box-body">
                  <input type="hidden" name="id_deskripsi" value="<?php echo $id_deskripsi; ?>">
									<div class="form-group">
										<label for="ket">Keterangan</label>
										<input type="text" class="form-control" name="keterangan" id="ket" readonly value="<?php echo $keterangan; ?>">
									</div>
									<div class="form-group">
										<label for="isi">Isi</label>
										<textarea name="isi" rows="8" cols="80"><?php echo $isi; ?></textarea>
									</div>
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
