<section class="content-header">
	<?php
			$confirm=$this->session->flashdata('config_error');
			if(!$confirm==""){
	?>
	<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $confirm; ?>
  </div>
	<?php } ?>
	<?php
			$sukses=$this->session->flashdata('config');
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
    <div class="col-md-3">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">Potongan Withdraw</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?php echo base_url(); ?>admin/potongan_proses" method="post" enctype="multipart/form-data">
          <div class="box-body">
              <input type="hidden" name="id_potongan" value="<?php echo $id_potongan; ?>">
              <div class="form-group">
                <label for="kode">Potongan</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="potongan" id="kode" required="REQUIRED" value="<?php echo $potongan; ?>">
                  <span class="input-group-btn"><button type="button" class="btn btn-success">%</button></span>
                </div>
              </div>
          <!-- /.box-body -->
          </div>
          <div class="box-footer">
            <center>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </center>
          </div>
        </form>
    </div>
  </div>

<div class="col-md-9">
  <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Deskripsi</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Keterangan</th>
                  <th>Isi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1;
                  foreach ($deskripsi as $key => $nil) { ?>
                  <tr>
                    <td width="10"><?php echo $i; ?></td>
                    <td><?php echo $nil->nama_deskripsi; ?></td>
                    <td width="60%"><?php echo $nil->isi; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>admin/deskripsi_edit<?php echo "/".$nil->id_; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
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
          <h3 class="box-title">Tambah Data Bank</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?php echo base_url(); ?>admin/bank_tambah" method="post" enctype="multipart/form-data">
          <div class="box-body">
              <div class="form-group">
                <label for="nama">Nama bank</label>
                <input type="text" class="form-control" name="nama_bank" id="nama" required="REQUIRED" placeholder="Masukkan nama bank">
              </div>
              <div class="form-group">
                <label for="rek">No. Rekening</label>
                <input type="text" class="form-control" name="no_rekening" id="rek" required="REQUIRED" placeholder="Masukkan no. rekening">
              </div>
              <div class="form-group">
                <label for="nama">Atas nama</label>
                <input type="text" class="form-control" name="atas_nama" id="nama" required="REQUIRED" placeholder="Masukkan atas nama rekening bank">
              </div>
          <!-- /.box-body -->
          </div>
          <div class="box-footer">
            <center>
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="reset" name="reset" class="btn btn-danger">Batal</button>
            </center>
          </div>
        </form>
      </div>
    </div>

		<div class="col-md-7">
	    <div class="box box-primary">
		            <div class="box-header">
		              <h3 class="box-title">Data Bank</h3>
									<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table class="table table-bordered table-striped table-responsive">
		                <thead>
		                <tr>
											<th>No</th>
	                    <th>Nama Bank</th>
		                  <th>No. Rekening</th>
											<th>Atas Nama</th>
                      <th>Aksi</th>
		                </tr>
		                </thead>
		                <tbody>
										<?php
											$i = 1;
											foreach ($bank as $key => $nil) { ?>
		                	<tr>
												<td width="10"><?php echo $i; ?></td>
		                  	<td><?php echo $nil->nama_bank; ?></td>
	                      <td><?php echo $nil->no_rekening; ?></td>
												<td><?php echo $nil->atas_nama; ?></td>
	                      <td>
	                        <a href="<?php echo base_url(); ?>admin/bank_edit<?php echo "/".$nil->id_bank; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
	                        <a href="<?php echo base_url(); ?>admin/bank_hapus<?php echo "/".$nil->id_bank; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
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
