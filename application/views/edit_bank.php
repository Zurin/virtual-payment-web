<section class="content">
<!-- general form elements -->
				<div class="col-md-6 col-md-offset-3">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">FORM EDIT BANK</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url(); ?>admin/edit_bank_proses" method="post" enctype="multipart/form-data">
              <div class="box-body">
                  <input type="hidden" name="id_bank" value="<?php echo $id_bank; ?>">
									<div class="form-group">
										<label for="bank">Nama bank</label>
										<input type="text" class="form-control" name="nama_bank" id="bank" value="<?php echo $nama_bank; ?>">
									</div>
                  <div class="form-group">
										<label for="no_rek">No. rekening</label>
										<input type="text" class="form-control" name="no_rekening" id="no_rek" value="<?php echo $no_rekening; ?>">
									</div>
                  <div class="form-group">
										<label for="atas_nama">Atas nama</label>
										<input type="text" class="form-control" name="atas_nama" id="atas_nama" value="<?php echo $atas_nama; ?>">
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
