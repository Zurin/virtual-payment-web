<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">

          <?php
            if ($avatar=='') {
           ?>
             <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
          <?php } else {?>
            <img src="<?php echo base_url(); ?>assets/asset/profile/<?php echo $avatar; ?>" class="img-circle" alt="User Image" width="50" height="50">
          <?php } ?>

      </div>
      <div class="pull-left info">
        <p>
          <b><?php echo $akun['username']; ?></b>
          <br>
          <?php echo $nama; ?>
        </p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <li class="treeview <?php if($halaman=="beranda") echo "active"; ?>">
        <a href="<?php echo base_url() ?>home/index">
          <i class="fa fa-home"></i> <span>Beranda</span>
        </a>
      </li>
      <li class="treeview <?php if($halaman=="topup"||$halaman=="wd"||$halaman=="voucher") echo "active"; ?>">
        <a href="#">
          <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu <?php if($halaman=="topup"||$halaman=="wd"||$halaman=="voucher") echo "active"; ?>">
          <li class="<?php if($halaman=="topup") echo "active"; ?>"><a href="<?php echo base_url(); ?>home/topup"><i class="fa fa-credit-card"></i> Top Up</a></li>
          <li class="<?php if($halaman=="wd") echo "active"; ?>"><a href="<?php echo base_url(); ?>home/req_wd"><i class="fa fa-external-link"></i> Withdraw</a></li>
          <li class="<?php if($halaman=="voucher") echo "active"; ?>"><a href="<?php echo base_url(); ?>home/voucher"><i class="fa fa-ticket"></i> Voucher Area</a></li>
        </ul>
      </li>
      <li class="treeview <?php if($halaman=="pending_topup"||$halaman=="pending_wd"||$halaman=="beli") echo "active"; ?>">
        <a href="#">
          <i class="fa fa-bell"></i> <span>Notifikasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu <?php if($halaman=="pending_topup"||$halaman=="pending_wd"||$halaman=="beli") echo "active"; ?>">
          <li class="<?php if($halaman=="pending_topup") echo "active"; ?>">
            <a href="<?php echo base_url(); ?>home/pending_top_up"><i class="fa fa-check-circle"></i>
              <span>Top Up Pending</span>
              <?php
                if ($jmlTopUp>0) {
              ?>
              <span class="pull-right-container">
                <small class="label pull-right bg-red"><?php echo $jmlTopUp; ?></small>
              </span>
              <?php
                }
              ?>
            </a></li>
            <li class="<?php if($halaman=="pending_wd") echo "active"; ?>">
              <a href="<?php echo base_url(); ?>home/pending_wd"><i class="fa fa-check-square"></i>
                <span>Withdraw Pending</span>
                <span class="pull-right-container">
                  <?php
                    if ($jmlWd>0) {
                  ?>
                  <span class="pull-right-container">
                    <small class="label pull-right bg-red"><?php echo $jmlWd; ?></small>
                  </span>
                  <?php
                    }
                  ?>
                </span>
              </a>
            </li>
          <li class="<?php if($halaman=="beli") echo "active"; ?>">
            <a href="<?php echo base_url(); ?>home/history_pembelian"><i class="fa fa-strikethrough"></i>
              <span>History Transaksi</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview <?php if($halaman=="bank") echo "active"; ?>">
        <a href="<?php echo base_url(); ?>home/info_bank">
          <i class="fa fa-info-circle"></i> <span>Informasi Bank</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
