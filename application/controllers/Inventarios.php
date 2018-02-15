<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventarios extends Base_Controller {
	function __construct(){
		parent::__construct();
	}
	# Vistas
		public function Inicio() {
			echo $this->templates->render('Inventarios/Inicio');
		}
		public function Productos() {
			echo $this->templates->render('Inventarios/Productos');
		}
		public function IngresarProducto() {
			echo $this->templates->render('Inventarios/IngresarProducto');
		}
		public function EgresarProducto() {
			echo $this->templates->render('Inventarios/EgresarProducto');
		}
		public function HistorialIngresos() {
			echo $this->templates->render('Inventarios/HistorialIngresos');
		}
		public function HistorialEgresos() {
			echo $this->templates->render('Inventarios/HistorialEgresos');
		}
		public function DetalleInventario() {
			echo $this->templates->render('Inventarios/DetalleInventario');
		}
		public function MarcasDepartamentos() {
			echo $this->templates->render('Inventarios/MarcasDepartamentos');
		}
	# Listado de catálogos
		public function ObtenerMarcas() {
			$this->load->model('in_cat_marcas');
			$campos = array('cve_marca, descripcion, estatus');
			$wheres = array('estatus' => 'A');
			exit(json_encode($this->in_cat_marcas->listar($wheres, $campos)));
		}
		public function ObtenerDepartamentos() {
			$this->load->model('in_cat_departamentos');
			$campos = array('cve_familia, descripcion, estatus');
			$wheres = array('estatus' => 'A');
			exit(json_encode($this->in_cat_departamentos->listar($wheres, $campos)));
		}
	# Alta de nuevos registros
		public function CrudMarca() {
			$this->form_validation->set_rules('inputMarca', 'Descripción', 'required', array('required'=>'La descripción de la marca es necesaria'));
			if ($this->form_validation->run() === false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

			$data = array(
				'descripcion' => $this->input->post('inputMarca'),
				'estatus' => $this->input->post('inputStatusMarca'),
			);
			$this->load->model('in_cat_marcas');
			$this->in_cat_marcas->alta($data) == false ? exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al intentar agregar el registro'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito')));

		}

}
