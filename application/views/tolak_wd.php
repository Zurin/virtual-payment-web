<section class="content">
  <!-- Profile Image -->
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <h3 class="profile-username text-center">
          Apakah Anda yakin akan menolak withdraw dengan data di bawah ini?
        </h3>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Id withdraw</b> <span class="pull-right"><?php echo $wd; ?></span>
          </li>
          <li class="list-group-item">
            <b>Atas nama</b> <span class="pull-right"><?php echo $atas_nama; ?></span>
          </li>
          <li class="list-group-item">
            <b>Jumlah withdraw</b>
            <span class="pull-right">
              <?php
                $nom = number_format($jumlah_wd, 2, ", ", ".");
                echo "Rp ".$nom;
              ?>
            </span>
          </li>
          <li class="list-group-item">
            <b>No rekening</b> <span class="pull-right"><?php echo $no_rek; ?></span>
          </li>
          <li class="list-group-item">
            <b>Bank</b> <span class="pull-right"><?php echo $bank; ?></span>
          </li>
          <li class="list-group-item">
            <b>Cabang</b> <span class="pull-right"><?php echo $cabang; ?></span>
          </li>
        </ul>
        <center>
          <a href="<?php echo base_url(); ?>admin/tolak_wd_proses/<?php echo $member."/".$wd ?>" class="btn btn-primary"><b>Ya</b></a>
          <a href="javascript:history.back()" class="btn btn-primary btn-danger"><b>Tidak</b></a>
        </center>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</section>
