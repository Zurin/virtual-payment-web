<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>


  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
  <script src="<?php echo base_url() ?>assets/js/modernizr.custom.80028.js"></script>
      <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">

</head>

<body>
  <div class="login-wrap">
	<div class="login-html">
    <div class="" align="center" style="color:white;">
      <h1>V-PAY</h1>
    </div>
    <div class="hr"></div>
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Log in</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Daftar</label>
		<div class="login-form">

      <form class="" action="<?php echo base_url(); ?>home/proses_login" method="post">
        <div class="sign-in-htm">
  				<div class="group">
  					<label for="user" class="label">Username</label>
  					<input id="user" type="text" class="input" name="username" required="REQUIRED">
  				</div>
  				<div class="group">
  					<label for="pass" class="label">Password</label>
  					<input id="pass" type="password" class="input" data-type="password" name="password" required="REQUIRED">
  				</div>
          <div class="hr"></div>
  				<div class="group">
  					<input type="submit" class="button" value="Login">
  				</div>
          <?php
              $confirm=$this->session->flashdata('error');
              if(!$confirm==""){
          ?>
              <div id="note">
                <?php echo $confirm;?><a href="" id="close">[close]</a>
              </div>
          <?php
              }
          ?>
  			</div>
      </form>

      <form class="" action="<?php echo base_url(); ?>/home/proses_daftar" method="post">
        <div class="sign-up-htm">
          <div class="group">
            <label for="nama" class="label">Nama Lengkap</label>
            <input id="nama" type="text" name="nama"class="input" required="REQUIRED">
          </div>
  				<div class="group">
  					<label for="user" class="label">Username</label>
  					<input id="user" name="username" type="text" class="input" required="REQUIRED">
  				</div>
  				<div class="group">
  					<label for="pass" class="label">Password</label>
  					<input id="pass" name="password" type="password" class="input" data-type="password" required="REQUIRED">
  				</div>
  				<div class="group">
  					<label for="konfpass" class="label">Ulangi Password</label>
  					<input id="konfpass" name="konfpass" type="password" class="input" data-type="password" required="REQUIRED">
  				</div>
  				<div class="group">
  					<label for="pass" class="label">E-mail</label>
  					<input id="pass" name="email" type="email" class="input" required="REQUIRED">
  				</div>
          <div class="group">
            <label for="hp" class="label">No. HP</label>
            <input type="text" name="no_hp" id="hp" class="input" required="REQUIRED">
          </div>
          <div class="group">
            <label for="" class="label">&nbsp;</label>
            &nbsp;
          </div>
  				<div class="group">
  					<input type="submit" class="button" value="Daftar">
  				</div>
          <div class="group">
            <input type="reset" name="reset" class="button-cancel" value="Batal">
          </div>
          <?php
              $confirm=$this->session->flashdata('error');
              if(!$confirm==""){
          ?>
              <div id="note">
                <?php echo $confirm;?><a href="" id="close">[close]</a>
              </div>
          <?php
              }
          ?>

          <?php
              $sukses=$this->session->flashdata('error');
              if(!$sukses==""){
          ?>
              <div id="sukses">
                <?php echo $sukses;?><a href="" id="close">[close]</a>
              </div>
          <?php
              }
          ?>
  			</div>
      </form>


		</div>
	</div>
</div>

<script>
   close = document.getElementById("close");
   close.addEventListener('click', function() {
     note = document.getElementById("note");
     note.style.display = 'none';
     sukses = document.getElementById("sukses");
     sukses.style.display = 'none';
   }, false);
  </script>

</body>
</html>
