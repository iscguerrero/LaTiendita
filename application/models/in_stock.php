<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class in_stock extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'in_stock';
		$this->primary_key = 'id';
		$this->return_type = 'array';
	}

	# Obtener un registro
	public function obtener($where, $campos) {
		return $this->get($where, $campos);
	}

	# Retornar los registros de la tabla
	public function listar($wheres, $campos) {
		return $this->filter($wheres, $campos);
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

	# Obtener las existencias por lote de un producto
	public function lotes($cve_cat_producto) {
		$this->db->select("id, existencia, precio_unitario, costo_unitario, lote")
		->from('in_stock')
		->where('cve_cat_producto', $cve_cat_producto)
		->where('existencia >', 0)
		->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

}