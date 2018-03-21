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

	# Obtener un registro
	public function obtener($where, $campos) {
		return $this->get($where, $campos);
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

	# Retornar una lista customizada de productos
	public function customListar($marcas, $departamentos, $estatus, $inicio, $fin, $tipo_movimiento) {
		$this->db->select('icp.cve_cat_producto, icp.codigo_de_barras, icp.descripcion as producto, ikm.costo_unitario, ikm.precio_unitario, icm.descripcion as marca, ikm.cantidad, icd.descripcion as departamento, icmo.descripcion as motivo, date_format(created_at, "%d-%M-%Y") as ffecha')
		->from('in_kardex_movimientos ikm')
		->join('in_cat_movimientos icmo', 'ikm.cve_movimiento = icmo.cve_movimiento', 'INNER')
		->join('in_cat_productos icp', 'ikm.cve_cat_producto = icp.cve_cat_producto', 'INNER')
		->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER')
		->join('in_cat_departamentos icd', 'icd.cve_departamento = icp.cve_departamento', 'INNER')
		->where('ikm.tipo_movimiento', $tipo_movimiento)
		->where('ikm.created_at >=', $inicio)
		->where('ikm.created_at <=', $fin . ' 23:59:59');
		if (count($marcas) > 0) $this->db->where_in('icp.cve_marca', implode(',', $marcas));
		if (count($departamentos) > 0) $this->db->where_in('icp.cve_departamento', implode(',', $departamentos));
		if (count($estatus) > 0) $this->db->where_in('icp.estatus', $estatus);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

}