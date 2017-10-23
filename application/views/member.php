<section class="content">
		<div class="box box-primary">
	            <div class="box-header">
	              <h3 class="box-title">Data Member</h3>
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
	                  <th>Username</th>
	                  <th>Nama Lengkap</th>
	                  <th>E-mail</th>
										<th>No HP</th>
                    <th>Deposit</th>
	                </tr>
	                </thead>
	                <tbody>
									<?php
										$i = 1;
										foreach ($member as $key => $nil) { ?>
	                	<tr>
											<td width="10"><?php echo $i; ?></td>
	                  	<td><?php echo $nil->username; ?></td>
                      <td><?php echo $nil->nama; ?></td>
                      <td><?php echo $nil->email; ?></td>
                      <td><?php echo $nil->no_hp ?></td>
                      <td>
                        <?php
                          $nom = $nil->deposit;
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

</section>
