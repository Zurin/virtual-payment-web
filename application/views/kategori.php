<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('kategori_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('kategori');
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
		<div class="col-md-7">
	    <div class="box box-primary">
		            <div class="box-header">
		              <h3 class="box-title">Data Kategori</h3>
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
	                    <th>Kode Kategori</th>
		                  <th>Kategori</th>
											<th>Icon</th>
	                    <th>Aksi</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($kategori as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $nil->id_kategori; ?></td>
	                      <td><?php echo $nil->nama_kategori; ?></td>
												<td><img src="<?php echo base_url(); ?>assets/asset/kategori/<?php echo $nil->icon; ?>" alt="ICO" width="50" height="50"></td>
	                      <td>
	                        <a href="<?php echo base_url(); ?>admin/kategori_edit<?php echo "/".$nil->id_kategori; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
	                        <a href="<?php echo base_url(); ?>admin/kategori_hapus<?php echo "/".$nil->id_kategori; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
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
	  <div class="col-md-5">
	    <div class="box box-danger">
	      <div class="box-header">
	        <h3 class="box-title">Tambah Kategori</h3>
	        <div class="box-tools pull-right">
	          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
	          </button>
	        </div>
	      </div>
	      <!-- /.box-header -->
	      <!-- form start -->
	      <form role="form" action="<?php echo base_url(); ?>admin/kategori_proses" method="post" enctype="multipart/form-data">
	        <div class="box-body">
	            <div class="form-group">
	              <label for="kode">Kode kategori</label>
	              <input type="text" class="form-control" name="kode_kategori" id="kode" placeholder="Masukkan kode kategori" required="REQUIRED" maxlength="4">
	            </div>
	            <div class="form-group">
	              <label for="kategori">Kategori</label>
	              <input type="text" class="form-control" id="kategori" name="kategori" required="REQUIRED" placeholder="Masukkan judul kategori">
	            </div>
							<div class="form-group">
	              <label for="icon">Icon kategori</label>
	              <input type="file" class="form-control" id="icon" name="icon" required="REQUIRED">
	            </div>
							<p class="text-danger">Ukuran icon direkomendasikan beresolusi 200 x 200 px</p>
	        <!-- /.box-body -->
	        </div>
	        <div class="box-footer">
	          <center>
	            <button type="submit" class="btn btn-primary">Tambah</button>
	            <button type="reset" name="reset" class="btn btn-danger">Batal</button>
	          </center>
	        </div>
	      </form>
	  </div>
	</div>
	</div>
</section>
