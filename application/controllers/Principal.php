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

	public function AbrirCaja() {
		$this->form_validation->set_rules('apertura', 'Importe', 'required', array('required' => 'Debes proporcionar el importe con que se abrirá la caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->estatus();
		if( count($caja) > 0 && $caja->estatus == 'A' ) exit(json_encode(array('bandera' => false, 'msj' => 'La caja no fue cerrada la última vez que se aperturó, cierra la caja abierta y vuelve a aperturar')));

		$data = array(
			'cantidad' => $this->input->post('apertura'),
			'estatus' => 'A',
			'fecha_apertura' => date('Y-m-d')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al aperturar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se aperturó con éxito ¿Deseas ir al punto de venta?')));
	}

	public function CerrarCaja() {
		$this->form_validation->set_rules('cierre', 'Importe', 'required', array('required' => 'Debes proporcionar el importe de cierre de caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->id();
		if (count($caja) == 0 || $caja->id == 'C') exit(json_encode(array('bandera' => false, 'msj' => 'No hay caja abierta, apertura antes de continuar')));

		$data = array(
			'id' => $caja->id,
			'cantidad' => $this->input->post('apertura'),
			'estatus' => 'C',
			'fecha_cierre' => date('Y-m-d')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al cerrar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se cerro con éxito ¿Deseas finalizar sesión?')));
	}

	public function ObtenerHistorialCaja() {
		
	}

}
