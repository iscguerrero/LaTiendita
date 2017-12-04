<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class in_cat_marcas extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'in_cat_marcas';
		$this->primary_key = 'cve_marca';
		$this->return_type = 'array';
	}

	# Retornar los registros de la tabla
	public function ObtenerRegistros($wheres, $campos) {
		return $this->filter($wheres, $campos);
	}

	# Nuevo registro para la tabla
	public function Alta($data) {
		return $this->save($data);
	}

}