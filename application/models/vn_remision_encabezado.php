<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_remision_encabezado extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_remision_encabezado';
		$this->primary_key = 'folio';
		$this->return_type = 'array';
	}

	# Obtener un registro
	public function obtener($where, $campos) {
		return $this->get($where, $campos);
	}

	#Metodo para obtener el nuevo folio de la precotizacion
	public function folio() {
		return $this->count();
	}

	# Retornar los registros de la tabla
	public function listar($wheres, $campos) {
		return $this->filter($wheres, $campos);
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

	# Generar toda la información de la remision
	public function ObtenerRemision($codigo) {
		$this->db->select("icp.cve_cat_producto, icp.costo_unitario, vre.folio, date_format(vre.fecha, '%d-%M-%Y') as fecha, vrp.id, (vrp.piezas - vrp.piezas_devueltas) as piezas, vrp.precio_unitario, (vrp.piezas - vrp.piezas_devueltas) * vrp.precio_unitario as total_partida, icp.descripcion as producto, 0 as devueltas, 0 as devuelto")
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->join('in_cat_productos icp', 'vrp.cve_cat_producto = icp.cve_cat_producto', 'INNER')
			->where('vre.codigo_de_barras', $codigo);
		$query = $this->db->get();
		return $query->result();
	}

	# Obtener las ventas por hora
	public function VentaHora() {
		$this->db->select("CONCAT(LPAD(HOUR(fecha), 2, 0), ':00') AS hora, SUM(total) as venta")
			->from('vn_remision_encabezado')
			->where('fecha >= ', date('Y-m-d'))
			->where('fecha <= ', date('Y-m-d H:i:s'))
			->group_by('hora')
			->order_by('hora');
		$query = $this->db->get();
		return $query->result();
	}

	# Obtener las ventas por dia
	public function VentaDia() {
		$this->db->select("LPAD(DAY(fecha), 2, '0') AS dia, SUM(total) as venta")
			->from('vn_remision_encabezado')
			->where('MONTH(fecha)', date('n'))
			->group_by('dia')
			->order_by('dia');
		$query = $this->db->get();
		return $query->result();
	}

	# Obtener las ventas por mes
	public function VentaMes() {
		$this->db->select("LPAD(MONTH(fecha), 2, '0') AS mes, SUM(total) as venta")
			->from('vn_remision_encabezado')
			->where('YEAR(fecha)', date('Y'))
			->group_by('mes')
			->order_by('mes');
		$query = $this->db->get();
		return $query->result();
	}

}