<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class in_cat_metricas extends CI_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'in_cat_metricas';
		$this->primary_key = 'cve_metrica';
		$this->return_type = 'array';
	}

	# Metodo para obtener la información de un registro de la taba
	public function obtenerRegistros() {
		return $this->get(
			array(
				'estatus' => 'A'
			),
			array('cve_metrica, metrica, descripcion, estatus')
		);
	}

}