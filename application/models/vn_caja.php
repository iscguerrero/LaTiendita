<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_caja extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_caja';
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

	# Comprobar el estatus de la caja
	public function estatus(){
		$this->db->select('estatus')
		->from('vn_caja')
		->order_by('id', 'DESC');
		return $this->db->get()->row();
	}

	# Obtener el último id de la caja aperturada
	public function id() {
		$this->db->select('id')
			->from('vn_caja')
			->order_by('id', 'DESC');
		return $this->db->get()->row();
	}

}