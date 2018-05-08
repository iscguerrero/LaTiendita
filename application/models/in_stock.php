<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class In_stock extends Base_Model {
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
	public function lotes($cve_cat_producto){
		$this->db->select("id, existencia, precio_unitario, costo_unitario, lote")
			->from('in_stock')
			->where('cve_cat_producto', $cve_cat_producto)
			->where('existencia >', 0)
			->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	# Obtener las existencias por lote de un producto
	public function stock() {
		$this->db->select("icp.cve_cat_producto, icp.descripcion as producto, icm.descripcion as marca, icd.descripcion as departamento, sum(is.precio_unitario * is.existencia) as precio, sum(is.costo_unitario * is.existencia) as costo, sum(is.existencia) as existencia, sum(is.precio_unitario * is.existencia) - sum(is.costo_unitario * is.existencia) as utilidad")
		->from('in_stock is')
		->join('in_cat_productos icp', 'is.cve_cat_producto = icp.cve_cat_producto', 'INNER')
		->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER')
		->join('in_cat_departamentos icd', 'icd.cve_departamento = icp.cve_departamento', 'INNER')
		->where('is.existencia >', 0)
		->group_by('is.cve_cat_producto')
		->order_by('icp.descripcion', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	# Funcion para obtener el numero de items existentes en el inventario
	public function items() {
		$this->db->select("cve_cat_producto")
			->from('in_stock')
			->where('existencia >', 0)
			->group_by('cve_cat_producto');
		$query = $this->db->get();
		return $query->result();
	}

}