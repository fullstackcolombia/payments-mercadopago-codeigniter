<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maintenance extends CI_Controller {

	function is_logged() {
		if(!$this->config->item('maintenance_fsc')){
			redirect('home');
		}
    }

	public function index(){
		$this->is_logged();
		echo '<!doctype html>
<html lang="es">
  <head>
    <title>Plataforma Mantenimiento</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="'.base_url('assets/css/bootstrap.min.css').'">
  </head>
  <body>
    <div class="container mt-5">
		<div class="jumbotron">
			<h1 class="display-3">Plataforma en mantenimiento!</h1>
			<p class="lead">La Plataforma se encuentra en mantenimiento. Espere que en breve se actualicen los m&oacute;dulos correspondientes para el correcto funcionamiento.</p>
			<hr class="my-4">
			<p>Nos encontramos realizando una actualizaci&oacute;n, este proceso puede tardar un poco, por favor espere pacientemente.</p>
		</div>
	</div>
  </body>
</html>';
		exit();
	}
}