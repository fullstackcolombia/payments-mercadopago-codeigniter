<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Miguel Leon">
		<meta name="generator" content="FSC">
		<title><?php echo $title; ?> - FSC</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
		<style>
		  .bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		  }

		  @media (min-width: 768px) {
			.bd-placeholder-img-lg {
			  font-size: 3.5rem;
			}
		  }
		</style>
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url('assets/css/floating-labels.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<div class="w-100 absolute fixed-top">
			<p class="mt-1 mb-1 text-muted text-center">Usuarios de prueba</p>
			<p class="mt-1 mb-1 text-muted text-center">Email: <b>admin@fullstackcolombia.com</b> ,Clave: <b>admin</b></p>
			<p class="mt-1 mb-1 text-muted text-center">Email: <b>example@fullstackcolombia.com</b> ,Clave: <b>example</b></p>
		</div>
		<form enctype="multipart/form-data" method="post" class="form-signin mt-5">
			<div class="text-center mb-4">
				<img class="mb-4" src="<?php echo base_url('assets/images/favicon.ico'); ?>" alt="" width="52" height="52">
				<h1 class="h3 mb-3 font-weight-normal">Login</h1>
				<p>Introduzca su <code>correo</code> y su <code>contrase&ntilde;a</code> para iniciar sesi&oacute;n</p>
				<?php if (@$error_credenciales or @validation_errors()) { ?>
				<div class="alert alert-danger" role="alert">
				<?php if (@$error_credenciales): ?>Sus credenciales no son v&aacute;lidas<?php endif; ?>
				<?php echo @validation_errors(); ?>
				</div>
				<?php } ?>
			</div>
			<div class="form-label-group">
				<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Correo" value="<?php echo set_value('email'); ?>" required autofocus>
				<label for="inputEmail">Correo</label>
			</div>
			<div class="form-label-group">
				<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a" required>
				<label for="inputPassword">Contrase&ntilde;a</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
			<p class="mt-5 mb-3 text-muted text-center">&copy; FSC-APP</p>
		</form>
	</body>
</html>
