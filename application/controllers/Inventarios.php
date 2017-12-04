<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventarios extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Index() {
		echo $this->templates->render('Inventarios/Inicio');
	}

	public function MarcasDepartamentos() {
		echo $this->templates->render('Inventarios/MarcasDepartamentos');
	}

	public function ObtenerMarcas() {
		$this->load->model('in_cat_marcas');
		$campos = array('cve_marca, descripcion, estatus');
		$wheres = array(
			'estatus' => 'A'
		);
		$data = $this->in_cat_marcas->ObtenerRegistros($wheres, $campos);
		exit(json_encode(array('bandera'=>true, 'data'=>$data)));
	}

	public function AltaMarca() {
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required', array('required'=>'La descripción de la marca es necesaria'));
		if ($this->form_validation->run() === false) {
			exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));
		} else {
			$data = array(
				'descripcion' => $this->input->post('descripcion')
			);
			$this->load->model('in_cat_marcas');
			$response = $this->in_cat_marcas->Alta($data);
			if($response != false) {
				exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito', 'data'=>$response)));
			} else {
				exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al intentar agregar el registro')));
			}
		}
	}

}
