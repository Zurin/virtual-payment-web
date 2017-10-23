<section class="content">
	<div class="row">
	  <div class="col-md-6">
			<div class="box box-success">
		            <div class="box-header">
		              <h3 class="box-title">Income</h3>
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
		                  <th>ID Transaksi</th>
		                  <th>Jenis Transaksi</th>
		                  <th>Nominal</th>
											<th>Tanggal Transaksi</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($income as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $nil->id_transaksi; ?></td>
		                  	<td><?php echo $nil->jenis_transaksi; ?></td>
	                      <td>
	                        <?php
	                          $nom = $nil->nominal;
	                          $nominal = number_format($nom, 2, ", ", ".");
	                          echo "Rp ".$nominal;
	                        ?>
	                      </td>
												<td><?php echo $nil->tgl_transaksi; ?></td>
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
			<div class="box box-warning">
								<div class="box-header">
									<h3 class="box-title">Pembelian Voucher</h3>
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
											<th>ID Transaksi</th>
											<th>Nominal</th>
											<th>Tanggal Transaksi</th>
										</tr>
										</thead>
										<tbody>
										<?php
											$i = 1;
											foreach ($voucher as $key => $nil) { ?>
											<tr>
												<td width="10"><?php echo $i; ?></td>
												<td><?php echo $nil->id_transaksi; ?></td>
												<td>
													<?php
														$nom = $nil->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><?php echo $nil->tgl_transaksi; ?></td>
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
									<h3 class="box-title">Withdraw</h3>
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
												<th>ID Transaksi</th>
												<th>Nominal</th>
												<th>Tanggal Transaksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$i = 1;
											foreach ($wd as $key => $value) { ?>
											<tr>
												<td width="10"><?php echo $i; ?></td>
												<td><?php echo $value->id_transaksi; ?></td>
												<td>
													<?php
														$jml = $value->nominal;
														$jumlah = number_format($jml, 2, ", ", ".");
														echo "Rp ".$jumlah;
													?>
												</td>
												<td><?php echo $value->tgl_transaksi; ?></td>
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
