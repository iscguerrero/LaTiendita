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

	# Funcion para obtener el total de productos vendidas en piezas
	public function PiezasVentaDia() {
		$this->db->select('sum(vrp.piezas) as piezas')
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->where('vre.fecha >= ', date('Y-m-d'))
			->where('vre.fecha <= ', date('Y-m-d H:i:s'));
		return $this->db->get()->row();
	}

	# Funcion para obtener el total de productos vendidos en el mes
	public function PiezasVentaMes() {
		$this->db->select('sum(vrp.piezas) as piezas')
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->where('MONTH(fecha)', date('n'));
		return $this->db->get()->row();
	}

	# Funcion para obtener el total de productos vendidos en el anio
	public function PiezasVentaAnio() {
		$this->db->select('sum(vrp.piezas) as piezas')
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->where('YEAR(fecha)', date('Y'));
		return $this->db->get()->row();
	}

}