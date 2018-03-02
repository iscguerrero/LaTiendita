<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_remision_partidas extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_remision_partidas';
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

	# Metodo para obtener la descripcion detallada de las partidas de la venta
	public function partidas($folio) {
		$this->db->select('vrp.piezas, vrp.precio_unitario, vrp.total, icp.descripcion')
		->from('vn_remision_partidas vrp')
		->join('in_cat_productos icp', 'vrp.cve_cat_producto = icp.cve_cat_producto', 'INNER')
		->where('vrp.folio', $folio);
		$query = $this->db->get();
		return $query->result();
	}

}