<header class="topbar">
	<nav class="navbar top-navbar navbar-expand-md navbar-light">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html">
				<b>
					<img src="<?= base_url('assets/mylayout/img/logo1.jpg') ?>" alt="homepage" class="dark-logo" width="50" />
				</b>
				<span>
					<img src="<?= base_url('assets/mylayout/img/logo2.jpg') ?>" alt="homepage" class="dark-logo" width="150" />
				</span>
			</a>
		</div>
		<div class="navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<!-- This is  -->
				<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
				<li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
			</ul>
			<ul class="navbar-nav my-lg-0">
				<li class="nav-item dropdown u-pro">
					<a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><?= ucfirst($cekUser['username']) ?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
					<div class="dropdown-menu dropdown-menu-right">
						<ul class="dropdown-user">
							<li><a href="<?= base_url() ?>auth/logout"><i class="fa fa-power-off"></i> Keluar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>
