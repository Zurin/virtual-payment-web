<section class="content">
  <!-- Profile Image -->
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">
          Apakah Anda yakin akan mengkonfirmasi top up dengan data di bawah ini?
        </h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Kode Top Up</b> <span class="pull-right"><?php echo $topup; ?></span>
          </li>
          <li class="list-group-item">
            <b>Pengirim</b> <span class="pull-right"><?php echo $pengirim; ?></span>
          </li>
          <li class="list-group-item">
            <b>Nominal Top Up</b>
            <span class="pull-right">
              <?php
                $nom = number_format($jumlah, 2, ", ", ".");
                echo "Rp ".$nom;
              ?>
            </span>
          </li>
          <li class="list-group-item">
            <b>Rekening Tujuan</b> <span class="pull-right"><?php echo strtoupper($tujuan); ?></span>
          </li>
          <li class="list-group-item">
            <b>Bukti Transfer</b>
            <span class="pull-right">
              <a href="<?php echo base_url(); ?>assets/asset/bukti/<?php echo $bukti ?>" target="_blank">Lihat bukti</a>
            </span>
          </li>
        </ul>
        <center>
          <a href="<?php echo base_url(); ?>admin/konfirmasi_proses/<?php echo $member."/".$topup ?>" class="btn btn-primary"><b>Ya</b></a>
          <a href="javascript:history.back()" class="btn btn-primary btn-danger"><b>Tidak</b></a>
        </center>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</section>
