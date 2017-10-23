<?php $akun = $this->session->userdata('admin'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="callout callout-success">
      <h4>Selamat datang di halaman utama Administrasi</h4>
      <p><?php echo $akun['nama']; ?></p>
  </div>
</section>
  <!-- Info boxes -->
  <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $jmlMember; ?></h3>

              <p>Jumlah Member</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/member" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $jmlVoucher; ?><sup style="font-size: 20px"></sup></h3>

              <p>Voucher Terjual</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark-round"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/voucher_data" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jmlVoucherAda; ?></h3>

              <p>Voucher Tersedia</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-pricetags"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/voucher_data" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $jmlTopUpPending; ?></h3>

              <p>Top Up Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-load-a"></i>
            </div>
            <a href="<?php echo base_url() ?>admin/pending" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><b>
                <?php
                  $nominal = number_format($dpst, 2, ", ", ".");
                  echo "Rp ".$nominal;
                ?>
              </b></h4>

              <p>Deposit Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
      </div>
  <!-- /.row -->
</section>
<!-- /.content -->
