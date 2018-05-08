<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vn_cat_gastos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_cat_gastos';
		$this->primary_key = 'cve_gasto';
		$this->return_type = 'array';
	}

	# Retornar los registros de la tabla
	public function listar($wheres, $campos) {
		return $this->filter($wheres, $campos);
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

}