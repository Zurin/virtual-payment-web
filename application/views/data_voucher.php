<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-warning">
		            <div class="box-header">
		              <h3 class="box-title">Voucher Richie Tersedia (Belum Dibeli) = <?php echo $jml_rchi; ?></h3>
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
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($richie as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td>
													<?php
														$kode = substr($nil->kode_voucher, 0, 10);
														echo $kode."xxxxxx";
													?>
												</td>
		                  	<td><?php echo $nil->nama_kategori; ?></td>
	                      <td align="right">
	                        <?php
	                          $nom = $nil->nominal;
	                          $nominal = number_format($nom, 2, ", ", ".");
	                          echo "Rp ".$nominal;
	                        ?>
	                      </td>

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
		              <h3 class="box-title">Voucher Olshop Tersedia (Belum Dibeli) = <?php echo $jml_olshop; ?></h3>
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
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($olshop as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td>
													<?php
														$kode = substr($nil->kode_voucher, 0, 10);
														echo $kode."xxxxxx";
													?>
												</td>
		                  	<td><?php echo $nil->nama_kategori; ?></td>
	                      <td align="right">
	                        <?php
	                          $nom = $nil->nominal;
	                          $nominal = number_format($nom, 2, ", ", ".");
	                          echo "Rp ".$nominal;
	                        ?>
	                      </td>

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
		<div class="col-md-12">
			<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Voucher Terjual</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="tableBeli" class="table table-striped table-responsive">
										<thead>
										<tr>
											<th colspan="2">Voucher richie terjual</th>
											<th colspan="4">: <?php echo $jml_sold_rchi; ?></th>
										</tr>
										<tr>
											<th colspan="2">Voucher olshop terjual</th>
											<th colspan="4">: <?php echo $jml_sold_olshop; ?></th>
										</tr>
										<tr>
											<th>No</th>
											<th>Kode Voucher</th>
											<th>Jenis Voucher</th>
											<th>Nominal</th>
											<th>Terjual ke</th>
											<th>Terjual oleh</th>
											<th>Tanggal</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
										<?php
											$i = 1;
											foreach ($terjual as $key => $nil) { ?>
											<tr>
												<td width="10"><?php echo $i; ?></td>
												<td>
													<?php
														$kode = substr($nil->kode_voucher, 0, 10);
														echo $kode."xxxxxx";
													?>
												</td>
												<td><?php echo $nil->nama_kategori; ?></td>
												<td align="right">
													<?php
														$nom = $nil->nominal;
														$nominal = number_format($nom, 2, ", ", ".");
														echo "Rp ".$nominal;
													?>
												</td>
												<td><?php echo $nil->nama; ?></td>
												<td><?php echo $nil->username; ?></td>
												<td><?php echo $nil->tanggal; ?></td>
												<td>
													<?php
														if ($nil->status=='valid') {
															echo "<span class='label label-success'>Valid</span>";
														} else {
															 echo "<span class='label label-danger'>Invalid</span>";
														}
													?>
												</td>
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
