<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('tolak');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('konfirmasi');
			if(!$sukses==""){
	?>
	<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $sukses; ?>
  </div>
	<?php } ?>
</section>
<section class="content">
		<div class="box box-warning">
	            <div class="box-header">
	              <h3 class="box-title">Top Up Pending</h3>
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
	                  <th>Pengirim</th>
	                  <th>Jumlah Top Up</th>
	                  <th>Rekening Tujuan</th>
										<th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
	                </tr>
	                </thead>
	                <tbody>
									<?php
										$i = 1;
										foreach ($tampil as $key => $nil) { ?>
	                	<tr>
											<td width="10"><?php echo $i; ?></td>
	                  	<td><?php echo $nil->pengirim; ?></td>
                      <td>
                        <?php
                          $nom = $nil->jumlah_topup;
                          $nominal = number_format($nom, 2, ", ", ".");
                          echo "Rp ".$nominal;
                        ?>
                      </td>
                      <td><?php echo strtoupper($nil->rek_tujuan); ?></td>
											<td><span class="label label-warning"><?php echo $nil->status; ?></span></td>
                      <td>
                        <img src="<?php echo base_url(); ?>assets/asset/bukti/<?php echo $nil->bukti; ?>" alt="nothing" width="100" height="50" />
                        <br/>
                        <a href="<?php echo base_url(); ?>assets/asset/bukti/<?php echo $nil->bukti; ?>" target="_blank">Lihat Bukti</a>
                      </td>
                      <td>
                        <a href="<?php echo base_url() ?>admin/konfirmasi_topUp/<?php echo $nil->id_user."/".$nil->id_topup ?>" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Konfirmasi</a>
                        <a href="<?php echo base_url() ?>admin/tolak_topUp/<?php echo $nil->id_user."/".$nil->id_topup ?>" class="btn btn-danger"><i class="fa fa-times"></i> Tolak</a>
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
