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

	public function ObtenerTiposGasto() {
		$this -> load -> model('vn_cat_gastos');
		$campos = 'cve_gasto, descripcion';
		$wheres = array();
		exit(json_encode($this->vn_cat_gastos->listar($wheres, $campos)));
	}

	public function AbrirCaja() {
		$this->form_validation->set_rules('apertura', 'Importe', 'required', array('required' => 'Debes proporcionar el importe con que se abrirá la caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->estatus();
		if( count($caja) > 0 && $caja->estatus == 'A' ) exit(json_encode(array('bandera' => false, 'msj' => 'La caja no fue cerrada la última vez que se aperturó, cierra la caja abierta y vuelve a aperturar')));

		$data = array(
			'importe_apertura' => $this->input->post('apertura'),
			'estatus' => 'A',
			'fecha_apertura' => date('Y-m-d H:i:s')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al aperturar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se aperturó con éxito ¿Deseas ir al punto de venta?')));
	}

	public function CerrarCaja() {
		$this->form_validation->set_rules('cierre', 'Importe', 'required', array('required' => 'Debes proporcionar el importe de cierre de caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->id();
		if (count($caja) == 0 || $caja->estatus == 'C') exit(json_encode(array('bandera' => false, 'msj' => 'No hay caja abierta, apertura antes de continuar')));

		$data = array(
			'id' => $caja->id,
			'importe_cierre' => $this->input->post('cierre'),
			'estatus' => 'C',
			'fecha_cierre' => date('Y-m-d H:i:s')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al cerrar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se cerro con éxito ¿Deseas finalizar sesión?')));
	}

	public function ObtenerHistoriaCaja() {
		$this->load->model('vn_caja');
		$inicio = $this->str_to_date($this->input->post('inicio'));
		$fin = $this->str_to_date($this->input->post('fin'));

		$campos = "DATE_FORMAT(fecha_apertura, '%d-%M-%Y') AS affecha, DATE_FORMAT(fecha_apertura, '%r') AS afhora, DATE_FORMAT(fecha_cierre, '%d-%M-%Y') AS cffecha, DATE_FORMAT(fecha_cierre, '%r') AS cfhora, importe_apertura as amonto, importe_cierre as cmonto";
		$where = array('fecha_apertura >=' => $inicio, 'fecha_apertura <=' => $fin . ' 23:59:59');

		die(json_encode($this->vn_caja->listar($where, $campos)));
	}

	public function NuevoGasto() {
		$this->form_validation->set_rules('importe', 'Importe', 'required', array('required' => 'Proporciona el importe del gasto'));
		$this->form_validation->set_rules('tipos', 'Tipos', 'required', array('required' => 'Proporciona el tipo de gasto que se efectuó'));
		$this->form_validation->set_rules('comentarios', 'Comentarios', 'required', array('required' => 'Proporciona una ligera descrición del motivo del gasto'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_gastos');

		$data = array(
			'cve_gasto' => $this->input->post('tipos'),
			'cantidad' => $this->input->post('importe'),
			'descripcion' => $this->input->post('comentarios'),
			'fecha' => date('Y-m-d')
		);
		$this->vn_gastos->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al registrar el gasto'))) : exit(json_encode(array('bandera' => true, 'msj' => 'El gasto se registro con éxito, ¿Deseas ir al punto de venta?')));
	}

}
