<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <b><?php echo $akun['username']; ?></b>
          <br>
          <?php echo $akun['nama']; ?>
        </p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">ADMINISTRATION MENU</li>
      <li class="treeview">
        <a href="<?php echo base_url() ?>admin/index">
          <i class="fa fa-home"></i> <span>Beranda</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url() ?>admin/pending">
          <i class="fa fa-shopping-cart"></i> <span>Pending Top Up</span>
          <?php
            if ($jmlTopUpPending>0) {
          ?>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php echo $jmlTopUpPending; ?></small>
          </span>
          <?php
            }
          ?>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url() ?>admin/pending_wd">
          <i class="fa fa-cart-arrow-down"></i> <span>Pending Withdraw</span>
          <?php
            if ($jmlWdPending>0) {
          ?>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php echo $jmlWdPending; ?></small>
          </span>
          <?php } ?>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-ticket"></i> <span>Voucher Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>admin/tambah_voucher"><i class="fa fa-plus"></i> Tambah Voucher</a></li>
          <li><a href="<?php echo base_url(); ?>admin/voucher_data"><i class="fa fa-ticket"></i> Data Voucher</a></li>
          <li><a href="<?php echo base_url(); ?>admin/kategori_voucher"><i class="fa fa-list"></i> Kategori Voucher</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url(); ?>admin/member">
          <i class="fa fa-users"></i> <span>Data Pengguna</span>
        </a>
      </li>
      <li class="treeview">
        <a href="<?php echo base_url(); ?>admin/setting">
          <i class="fa fa-cog"></i> <span>Pengaturan Lanjutan</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
