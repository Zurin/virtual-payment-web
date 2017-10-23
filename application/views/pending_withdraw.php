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
	              <h3 class="box-title">Withdraw Pending</h3>
								<br>
								<h6 class="text-danger">Jumlah withdraw sudah dikenai potongan sebesar <?php echo $potongan; ?>%</h6>
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
	                  <th>ID Withdraw</th>
	                  <th>Jumlah Withdraw</th>
	                  <th>No Rekening</th>
										<th>Atas nama bank</th>
                    <th>Bank</th>
                    <th>Cabang</th>
                    <th>Status</th>
                    <th>Aksi</th>
	                </tr>
	                </thead>
	                <tbody>
									<?php
										$i = 1;
										foreach ($tampil as $key => $nil) { ?>
	                	<tr>
											<td width="10"><?php echo $i; ?></td>
	                  	<td><?php echo $nil->id_wd; ?></td>
                      <td>
                        <?php
                          $nom = ($nil->jumlah_wd) - (($potongan/100)*($nil->jumlah_wd));
                          $nominal = number_format($nom, 2, ", ", ".");
                          echo "Rp ".$nominal;
                        ?>
                      </td>
                      <td><?php echo $nil->no_rekening; ?></td>
                      <td><?php echo  $nil->atas_nama; ?></td>
                      <td><?php echo $nil->nama_bank; ?></td>
                      <td><?php echo $nil->cabang; ?></td>
											<td><span class="label label-warning"><?php echo $nil->status; ?></span></td>
                      <td>
                        <a href="<?php echo base_url().'admin/konfirmasi_wd/'.$nil->id_user.'/'.$nil->id_wd; ?>" class="btn btn-primary">Konfirmasi</a>
                        <a href="<?php echo base_url() ?>admin/tolak_wd/<?php echo $nil->id_user."/".$nil->id_wd; ?>" class="btn btn-danger">Tolak</a>
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
