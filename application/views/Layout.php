<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/logo.png') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $this->e($title)?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/paper-dashboard.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/themify-icons.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?>"/>
	<?php echo $this->section('css')?>
</head>
<body>
	<div class="wrapper">
		<div class="sidebar" data-background-color="brown" data-active-color="danger">
			<div class="logo">
				<a href="<?php echo base_url('Escritorio/Inicio') ?>" class="simple-text logo-mini">mSV</a>
				<a href="<?php echo base_url('Escritorio/Inicio') ?>" class="simple-text logo-normal">mS Vizarrón</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li>
						<a href="<?php echo base_url('Escritorio/Inicio') ?>">
							<i class="ti-panel"></i>
							<p>Escritorio</p>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('Punto/Inicio') ?>">
							<i class="ti-shopping-cart-full"></i>
							<p>Punto de Venta</p>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('Principal/Inicio') ?>">
							<i class="ti-home"></i>
							<p>Principal</p>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('Inventarios/Inicio') ?>">
							<i class="ti-clipboard"></i>
							<p>Inventarios</p>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('Reportes/Inicio') ?>">
							<i class="ti-stats-up"></i>
							<p>Reportes</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar bar1"></span>
							<span class="icon-bar bar2"></span>
							<span class="icon-bar bar3"></span>
						</button>
						<a class="navbar-brand" href="#Dashboard">
							<?php echo $this->e($sitepage)?>
						</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
									<i class="ti-settings"></i>
									<span class="hidden-xs hidden-sm notification">Perfil</span>
									<p class="hidden-md hidden-lg">Perfil<b class="caret"></b></p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url('Login/Salir') ?>"><i class="fa fa-sign-out"></i> Salir</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="content">
				<div class="container-fluid">
					<?php echo $this->section('vista')?>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script>, <i class="fa fa-heart heart"></i> G&O Consultora
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>

	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/perfect-scrollbar.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
	<script type="text/javascript"src="<?php echo base_url('assets/js/bootstrap-switch-tags.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-notify.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-selectpicker.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.cookie.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/paper-dashboard.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public/js/master.js') ?>"></script>
	<?php echo $this->section('js')?>
</html>