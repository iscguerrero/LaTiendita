<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img/logo.png') ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>La Tiendita</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/paper-dashboard.css') ?>"/>
	<link rel="stylesheet" 
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome4.min.css') ?>">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Muli:400,300' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/themify-icons.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?>"/>
</head>
<body>
	<nav class="navbar navbar-transparent navbar-absolute">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url() ?>">miniSuper Vizarrón</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
				</ul>
			</div>
		</div>
	</nav>

	<div class="wrapper wrapper-full-page">
		<div class="full-page login-page" data-color="" data-image="<?php echo base_url('assets/img/background/bg.jpg') ?>">
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
							<form method="#" action="#" id="formAcceder">
								<div class="card" data-background="color" data-color="blue">
									<div class="card-header">
										<h3 class="card-title">Acceso</h3>
									</div>
									<div class="card-content">
										<div class="form-group">
											<label>Usuario</label>
											<input type="text" class="form-control input-no-border" name="cve_usuario" id="cve_usuario" placeholder="Usuario">
										</div>
										<div class="form-group">
											<label>Contraseña</label>
											<input type="password" class="form-control input-no-border" placeholder="Contraseña" name="contrasenia" id="contrasenia">
										</div>
									</div>
									<div class="card-footer text-center">
										<button type="submit" class="btn btn-fill btn-wd"><i class="fa fa-sign-in"></i> Acceder</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer footer-transparent">
				<div class="container">
					<div class="copyright">
						&copy; <script>document.write(new Date().getFullYear())</script>, DG Consultora <i class="fa fa-heart"></i> <i>ideas nacen, proyectos se cumplen</i>
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>

	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/perfect-scrollbar.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/es6-promise-auto.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/sweetalert2.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-switch-tags.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/paper-dashboard.js') ?>"></script>
	<script src="<?php echo base_url('public/js/master.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Login/Index.js') ?>"></script>
</html>
