<section class="content">
  <!-- Profile Image -->
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">
          Apakah Anda yakin akan menghapus data bank dengan data di bawah ini?
        </h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Nama bank</b> <span class="pull-right"><?php echo $nama_bank; ?></span>
          </li>
          <li class="list-group-item">
            <b>No. rekening</b> <span class="pull-right"><?php echo $no_rekening; ?></span>
          </li>
          <li class="list-group-item">
            <b>Atas nama</b> <span class="pull-right"><?php echo $atas_nama; ?></span>
          </li>
        </ul>
        <center>
          <a href="<?php echo base_url(); ?>admin/hapus_bank_proses/<?php echo $id_bank; ?>" class="btn btn-primary"><b>Ya</b></a>
          <a href="javascript:history.back()" class="btn btn-primary btn-danger"><b>Tidak</b></a>
        </center>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</section>
