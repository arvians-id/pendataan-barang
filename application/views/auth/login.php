<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/template/adminwrap/assets/images/favicon.png">
	<title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap/" />
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- page css -->
	<link href="<?= base_url() ?>assets/template/adminwrap/main/css/pages/login-register-lock.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/main/css/style.css" rel="stylesheet">

	<!-- You can change the theme colors from here -->
	<link href="<?= base_url() ?>assets/template/adminwrap/main/css/colors/default.css" id="theme" rel="stylesheet">
</head>

<body>
	<div class="preloader">
		<div class="loader">
			<div class="loader__figure"></div>
			<p class="loader__label">Admin Wrap</p>
		</div>
	</div>
	<section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?= base_url() ?>assets/template/adminwrap/assets/images/background/login-register.jpg);">
		<div class="login-box card">
			<div class="card-body">
				<form method="POST">
					<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
					<a href="javascript:void(0)" class="text-center db mb-3">
						<img src="<?= base_url('assets/mylayout/img/logo1.jpg') ?>" alt="Home" width="90" />
						<br>
						<img src="<?= base_url('assets/mylayout/img/logo2.jpg') ?>" alt="Home" width="160" />
					</a>
					<h3 class="text-center">PT ARTA BOGA CEMERLANG</h3>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success mt-2" role="alert">
							<?= $this->session->flashdata('success'); ?>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger mt-2" role="alert">
							<?= $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>
					<hr>
					<div class="form-group ">
						<label>Username</label>
						<div class="col-xs-12">
							<input class="form-control" value="<?= set_value('username') ?>" name="username" type="text" placeholder="Masukkan username anda">
							<small class="text-danger"><?= form_error('username') ?></small>
						</div>
					</div>
					<div class="form-group">
						<label>Password</label>
						<div class="col-xs-12">
							<input class="form-control" name="password" type="password" placeholder="Masukkan password anda">
							<small class="text-danger"><?= form_error('password') ?></small>
						</div>
					</div>
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-info btn-block text-uppercased" type="submit">Log In</button>
						</div>
					</div>
					<hr>
					<div class="form-group text-center">
						<div class="col-xs-12 text-center">
							<small>Jl. Lingkar Luar Barat Kav. 35-36, Cengkareng
								<br>Tlp/Fax 0817-700-777 email:customercare@ot.id
								<br>Jakarta Barat, 11740, Indonesia.
							</small>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/js/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
	<!--Custom JavaScript -->
	<script type="text/javascript">
		$(function() {
			$(".preloader").fadeOut();
		});
	</script>

</body>

</html>
