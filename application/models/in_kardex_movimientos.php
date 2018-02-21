<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class in_kardex_movimientos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'in_kardex_movimientos';
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