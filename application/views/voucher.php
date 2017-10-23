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
	<div class="row">
	  <div class="col-md-6">
			<div class="box box-warning">
		            <div class="box-header">
		              <h3 class="box-title">Beli Voucher Richie</h3>
									<h5>Jumlah voucher tersedia : <?php echo $jml_rchi; ?></h5>
									<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="tableBeli" class="table table-bordered table-striped table-responsive">
		                <thead>
		                <tr>
											<th>No</th>
		                  <th>Kode Voucher</th>
		                  <th>Nominal</th>
											<th>Aksi</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($richie as $key => $value) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $value->kode_voucher; ?></td>
												<td>
													<?php
														$nom = $value->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><a href="<?php echo base_url(); ?>home/buy_voucher/<?php echo $value->kode_voucher; ?>" class="btn btn-primary">Beli Voucher</a></td>
		                	</tr>
										<?php
												$i++;
											}
										?>
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
	  </div>
		<div class="col-md-6">
			<div class="box box-primary">
		            <div class="box-header">
		              <h3 class="box-title">Beli Voucher Online Shop</h3>
									<h5>Jumlah voucher tersedia : <?php echo $jml_olshop; ?></h5>
									<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="tableInvalidIn" class="table table-bordered table-striped table-responsive">
		                <thead>
		                <tr>
											<th>No</th>
		                  <th>Kode Voucher</th>
		                  <th>Nominal</th>
											<th>Aksi</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($olshop as $key => $value) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $value->kode_voucher; ?></td>
												<td>
													<?php
														$nom = $value->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><a href="<?php echo base_url(); ?>home/buy_voucher/<?php echo $value->kode_voucher; ?>" class="btn btn-primary">Beli Voucher</a></td>
		                	</tr>
										<?php
												$i++;
											}
										?>
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
	  </div>
		<div class="col-md-6">
			<div class="box box-success">
		            <div class="box-header">
		              <h3 class="box-title">Voucher Valid</h3>
									<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="tableMilik" class="table table-bordered table-striped table-responsive">
		                <thead>
		                <tr>
											<th>No</th>
		                  <th>Kode Voucher</th>
		                  <th>Jenis Voucher</th>
		                  <th>Nominal</th>
											<th>Status</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($voucher_user as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $nil->kode_voucher; ?></td>
		                  	<td><?php echo $nil->nama_kategori; ?></td>
												<td>
													<?php
														$nom = $nil->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><span class="label label-success"><?php echo $nil->status; ?></span></td>
		                	</tr>
										<?php
												$i++;
											}
										?>
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
	  </div>
		<div class="col-md-6">
			<div class="box box-danger">
								<div class="box-header">
									<h3 class="box-title">Voucher Telah Digunakan</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="tableInvalid" class="table table-bordered table-striped table-responsive">
										<thead>
										<tr>
											<th>No</th>
											<th>Kode Voucher</th>
											<th>Jenis Voucher</th>
											<th>Nominal</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
										<?php
											$i = 1;
											foreach ($voucher_invalid as $key => $nil) { ?>
											<tr>
												<td width="10"><?php echo $i; ?></td>
												<td><?php echo $nil->kode_voucher; ?></td>
												<td><?php echo $nil->nama_kategori; ?></td>
												<td>
													<?php
														$nom = $nil->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><span class="label label-danger"><?php echo $nil->status; ?></span></td>
											</tr>
										<?php
												$i++;
											}
										?>
										</tbody>
									</table>
								</div>
								<!-- /.box-body -->
							</div>
	  </div>
	</div>
</section>
