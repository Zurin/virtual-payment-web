<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Virtual Payment</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <?php
          $title = explode(" ", $judul);
        ?>
        <b><?php echo substr($title[0], 0, 1); ?></b><?php echo strtoupper(substr($title[1],0,3)); ?>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <?php
          $title = explode(" ", $judul);
        ?>
        <b><?php echo $title[0]; ?></b><?php echo $title[1]; ?>
      </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                if ($this->session->userdata('admin')==NULL){
                  if ($avatar=='') {
                 ?>
                   <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                <?php } else {?>
                  <img src="<?php echo base_url(); ?>assets/asset/profile/<?php echo $avatar; ?>" class="user-image" alt="User Image">
                <?php } } else { ?>
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                <?php }  ?>
              <span class="hidden-xs">
                <?php
                  if ($this->session->userdata('admin')==NULL)
                    $akun = $this->session->userdata('login');
                  else
                    $akun = $this->session->userdata('admin');
                  echo $akun['username'];
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

                <?php
                if ($this->session->userdata('admin')==NULL){
                  if ($avatar=='') {
                 ?>
                   <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php } else {?>
                  <img src="<?php echo base_url(); ?>assets/asset/profile/<?php echo $avatar; ?>" class="img-circle" alt="User Image">
                <?php } } else { ?>
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php }  ?>


                <p>
                  <?php echo $akun['username']; ?>
                  <?php if ($this->session->userdata('admin')==NULL){ ?>
                    <small><?php echo $nama; ?></small>
                  <?php } else { ?>
                    <small><?php echo $akun['nama']; ?></small>
                  <?php } ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <?php if ($this->session->userdata('admin')==NULL) { ?>
                <div class="pull-left">
                  <a href="<?php echo base_url(); ?>home/profile" class="btn btn-primary btn-flat">Profil</a>
                </div>
                <?php } ?>
                <div class="pull-right">
                  <a href="#" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#out">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <?php
    if ($this->session->userdata('admin')==NULL)
      include "sidebar.php";
    else
      include "adminSide.php";

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $content; ?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2017 <a href="#">Virtual Payment</a>.</strong>
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#tableBeli").DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $("#tableMilik").DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $("#tableInvalid").DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $("#tableInvalidIn").DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
  });
</script>

</body>
<div class="modal fade" id="out">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi Keluar</h4>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin akan keluar?</p>
              </div>
              <div class="modal-footer">
                <center>
                  <?php
                    if ($this->session->userdata('admin')==NULL)
                      $logout = "home/logout";
                    else
                      $logout = "admin/logout"
                  ?>
                  <a href="<?php echo base_url().$logout; ?>" class="btn btn-primary">YA</a>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">TIDAK</button>
                </center>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
</html>
