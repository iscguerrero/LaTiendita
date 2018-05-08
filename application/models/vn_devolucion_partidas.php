<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vn_devolucion_partidas extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_devolucion_partidas';
		$this->primary_key = 'id';
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