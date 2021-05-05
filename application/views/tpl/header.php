<?php $o_log_user = $this->default_model->get_one_where('pxo_user',array('id' => $us_log->id)); ?>
<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/dashboard.css'); ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/mp.css'); ?>" rel="stylesheet">
		<link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
		<title><?php echo $title; ?> - FSC</title>
	</head>
	<body>
		<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo site_url(); ?>">FSC PLEXO</a>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<nav class="col-md-2 d-none d-md-block bg-light sidebar">
					<div class="sidebar-sticky">
						<ul class="nav flex-column">
							<li class="nav-item"><a class="nav-link <?php echo $active_menu=='home'?'active':''; ?>" href="<?php echo site_url('home'); ?>">Dashboard</a></li>
						</ul>
					</div>
				</nav>
				
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">