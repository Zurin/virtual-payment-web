<?php $akun = $this->session->userdata('login'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="callout callout-success">
      <h4>Selamat datang!</h4>
      <p><?php echo $akun['nama']; ?></p>
  </div>
</section>
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Deposit</span>
          <span class="info-box-number">
            <?php
              $depo = $dpst;
              $deposit = number_format($depo, 2, ", ", ".");
            ?>
            Rp <?php echo $deposit; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-cc"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Voucher Valid</span>
          <span class="info-box-number">
            <?php
              echo $vcValid;
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-cart-arrow-down"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Top Up Pending</span>
          <span class="info-box-number">
            <?php echo $jmlTopUp; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-credit-card-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Voucher Invalid</span>
          <span class="info-box-number">
            <?php echo $invalid; ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
