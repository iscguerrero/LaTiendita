<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Principal extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Principal/Inicio');
	}

	public function HistoriaCaja() {
		echo $this->templates->render('Principal/HistoriaCaja');
	}

	public function Devoluciones() {
		echo $this->templates->render('Principal/Devoluciones');
	}

	public function Proveedores() {
		echo $this->templates->render('Principal/Proveedores');
	}

	public function ResumenCaja() {
		echo $this->templates->render('Principal/ResumenCaja');
	}

	public function ResumenFinanciero() {
		echo $this->templates->render('Principal/ResumenFinanciero');
	}
}
