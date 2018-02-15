<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Reportes/Inicio');
	}

	public function VentasDiarias() {
		echo $this->templates->render('Reportes/VentasDiarias');
	}

}
