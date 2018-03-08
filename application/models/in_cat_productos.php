<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class in_cat_productos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'in_cat_productos';
		$this->primary_key = 'cve_cat_producto';
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

	# Retornar una lista customizada de productos
	public function customListar($marcas, $departamentos, $estatus) {
		$this->db->select('icp.cve_cat_producto, icp.cve_producto, icp.descripcion, icp.costo_unitario, icp.precio_unitario, icd.descripcion as descDepto, icm.descripcion as descMarca, sum(ie.existencia) as existencia');
		$this->db->from('in_cat_productos icp');
		$this->db->join('in_cat_departamentos icd', 'icp.cve_departamento = icd.cve_departamento', 'INNER');
		$this->db->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER');
		$this->db->join('in_stock ie', 'icp.cve_cat_producto = ie.cve_cat_producto', 'INNER');
		$this->db->group_by('icp.cve_cat_producto');
		if(count($marcas) > 0) $this->db->where_in('icp.cve_marca', implode(',', $marcas));
		if(count($departamentos) > 0) $this->db->where_in('icp.cve_departamento', implode(',', $departamentos));
		if(count($estatus) > 0) $this->db->where_in('icp.estatus', implode(',', $estatus));
		$query = $this->db->get();
		return $query->result();
	}

	# Busqueda de productos por medio del autocomplete
	public function buscarProducto($term) {
		$this->db->select('icp.codigo_de_barras, icp.cve_cat_producto, icp.descripcion as value, icd.descripcion as departamento, icm.descripcion as marca, icp.precio_unitario')
		->from('in_cat_productos icp')
		->join('in_cat_departamentos icd', 'icp.cve_departamento = icd.cve_departamento', 'INNER')
		->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER')
		->like('icp.descripcion', $term);
		$query = $this->db->get();
		return $query->result();
	}

	# Busqueda de productos por medio del codigo de barras
	public function buscarCodigo($codigo) {
		$this->db->select('icp.codigo_de_barras, icp.cve_cat_producto, icp.descripcion as value, icd.descripcion as departamento, icm.descripcion as marca')
		->from('in_cat_productos icp')
		->join('in_cat_departamentos icd', 'icp.cve_departamento = icd.cve_departamento', 'INNER')
		->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER')
		->where('icp.codigo_de_barras', $codigo);
		return $this->db->get()->row();
	}

	# Busqueda de productos por medio del codigo de barras
	public function buscarCveCat($cve_cat_producto) {
		$this->db->select('icp.codigo_de_barras, icp.cve_cat_producto, icp.descripcion as producto, icd.descripcion as departamento, icm.descripcion as marca, icp.precio_unitario')
		->from('in_cat_productos icp')
		->join('in_cat_departamentos icd', 'icp.cve_departamento = icd.cve_departamento', 'INNER')
		->join('in_cat_marcas icm', 'icp.cve_marca = icm.cve_marca', 'INNER')
		->where('icp.cve_cat_producto', $cve_cat_producto);
		return $this->db->get()->row();
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

	# Retorna el ultimo id insertado en la tabla
	public function id() {
		return $this->count();
	}

}