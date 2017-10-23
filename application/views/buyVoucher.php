<section class="content">
  <!-- Profile Image -->
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">
          Apakah Anda yakin akan membeli voucher dengan data sesuai di bawah ini?
        </h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Kode Voucher</b> <span class="pull-right"><?php echo $kode_voucher; ?></span>
          </li>
          <li class="list-group-item">
            <b>Jenis Voucher</b> <span class="pull-right"><?php echo $nama_kategori; ?></span>
          </li>
          <li class="list-group-item">
            <b>Nominal</b>
            <span class="pull-right">
              <?php
                $nom = number_format($nominal, 2, ", ", ".");
                echo "Rp ".$nom;
              ?>
            </span>
          </li>
        </ul>
        <center>
          <a href="<?php echo base_url(); ?>home/proses_voucher/<?php echo $kode_voucher; ?>" class="btn btn-primary"><b>Ya</b></a>
          <a href="javascript:history.back()" class="btn btn-primary btn-danger"><b>Tidak</b></a>
        </center>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</section>
