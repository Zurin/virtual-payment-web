<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('topup_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('topup');
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
	  <div class="col-md-6">
			<!-- general form elements -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">FORM TOP UP</h3>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->
			            <form role="form" action="<?php echo base_url(); ?>home/topup_proses" method="post" enctype="multipart/form-data">
			              <div class="box-body">
												<div class="form-group">
													<label for="pengirim">Nama pengirim</label>
													<input type="text" class="form-control" name="pengirim" id="pengirim" placeholder="Masukkan nama pengirim" required="REQUIRED">
												</div>
												<div class="form-group">
													<label for="jumlah">Jumlah Pembelian</label>
													<input type="text" class="form-control" id="jumlah" name="jumlah" required="REQUIRED" placeholder="Masukkan nominal jumlah pembelian (misal 10000)">
												</div>
												<div class="form-group">
													<label for="tujuan">Transfer ke rekening</label>
													<!--<select class="form-control" name="tujuan">
			                    	<option value="bri">BRI</option>
			                    	<option value="bni">BNI</option>
			                    	<option value="mandiri">Mandiri</option>
			                    	<option value="bca">BCA</option>
			                  	</select>-->
													<select name="tujuan" class="form-control">
															<?php foreach ($bank as $key => $value){ ?>
																<option value="<?php echo $value->nama_bank ?>">
																	<?php echo $value->nama_bank ?>
																</option>
															<?php } ?>
													</select>
			              		</div>
												<div class="form-group">
				                  <label for="bukti">Bukti Transfer</label>
				                  <input class="form-control" type="file" id="bukti" name="bukti" required="REQUIRED">
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
		<div class="col-md-6">
			          <div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">INFO</h3>
			            </div>
			            <!-- /.box-header -->

			              <div class="box-body">
											<p><?php echo $deskripsi; ?></p>
			              </div>
			              <!-- /.box-body -->
			              <div class="box-footer">
											<table class="table table-responsive table-striped table-hover">
												<tr>
													<th>Nama Bank</th>
													<th>No. Rekening</th>
													<th>Atas Nama</th>
												</tr>
												<?php foreach ($bank as $key => $value){ ?>
													<tr>
														<td><?php echo $value->nama_bank; ?></td>
														<td><?php echo $value->no_rekening; ?></td>
														<td><?php echo $value->atas_nama; ?></td>
													</tr>
												<?php } ?>
											</table>
			              </div>
			          </div>
		</div>
	</div>
</section>
