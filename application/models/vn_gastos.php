<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vn_gastos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_gastos';
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

	# Obtener un arreglo personalizado de los gastos en un periodo especifico
	public function gastos($fi, $ff, $group = null) {
		$this->db->select("sum(vg.cantidad) as cantidad, DATE_FORMAT(vg.fecha, '%d-%M-%Y') AS fecha, vcg.descripcion AS gasto, vg.descripcion as comentarios")
			->from('vn_gastos vg')
			->join('vn_cat_gastos vcg', 'vg.cve_gasto = vcg.cve_gasto', 'INNER')
			->where('vg.fecha >=', $fi)
			->where('vg.fecha <=', $ff);
			if($group != '') $this->db->group_by('fecha');
		$query = $this->db->get();
		return $query->result();
	}

}