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

	# Generar listado de remisiones para el estado de resultados
	public function rventas($fi, $ff) {
		$this->db->select("vre.folio, vre.codigo_de_barras, DATE_FORMAT(vre.fecha, '%d-%M-%Y') AS fecha, vre.total AS ventas, SUM(vrp.costo_unitario * piezas) AS costo, SUM(vrp.precio_unitario * piezas_devueltas) AS devoluciones")
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->where('vre.fecha >= ', $fi . ' 00:0:00')
			->where('vre.fecha <= ', $ff . ' 23:59:59')
			->group_by('vre.folio');
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
	public function VentaDia($mes = '', $anio = '') {
		if($mes=='') $mes = date('n');
		if($anio=='') $anio = date('Y');
		$this->db->select("LPAD(DAY(fecha), 2, '0') AS dia, SUM(total) as venta")
			->from('vn_remision_encabezado')
			->where('MONTH(fecha)', $mes)
			->where('YEAR(fecha)', $anio)
			->group_by('dia')
			->order_by('dia');
		$query = $this->db->get();
		return $query->result();
	}

	# Obtener las ventas por dia con parametros
	public function rVentaMes($fi, $ff, $departamentos, $marcas, $estatus) {
		$this->db->select("LPAD(DAY(fecha), 2, '0') AS dia, SUM(vrp.total) as venta, sum(vrp.piezas) as piezas")
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->join('in_cat_productos icp', 'vrp.cve_cat_producto = icp.cve_cat_producto', 'INNER')
			->where('fecha >=', $fi)
			->where('fecha <=', $ff);
			if(count($marcas) > 0) $this->db->where_in('icp.cve_marca', $marcas);
			if(count($departamentos) > 0) $this->db->where_in('icp.cve_departamento', $departamentos);
			if(count($estatus) > 0) $this->db->where_in('icp.estatus', $estatus);
			$this->db->group_by('dia');
			$this->db->order_by('dia');
		$query = $this->db->get();
		return $query->result();
		#echo $this->db->get_compiled_select();
	}

	# Obtener las ventas por dia con parametros
	public function rVentaAnio($fi, $ff, $departamentos, $marcas, $estatus) {
		$this->db->select("LPAD(MONTH(fecha), 2, '0') AS mes, SUM(vrp.total) as venta, sum(vrp.piezas) as piezas")
			->from('vn_remision_encabezado vre')
			->join('vn_remision_partidas vrp', 'vre.folio = vrp.folio', 'INNER')
			->join('in_cat_productos icp', 'vrp.cve_cat_producto = icp.cve_cat_producto', 'INNER')
			->where('fecha >=', $fi)
			->where('fecha <=', $ff);
			if(count($marcas) > 0) $this->db->where_in('icp.cve_marca', $marcas);
			if(count($departamentos) > 0) $this->db->where_in('icp.cve_departamento', $departamentos);
			if(count($estatus) > 0) $this->db->where_in('icp.estatus', $estatus);
			$this->db->group_by('mes');
			$this->db->order_by('mes');
		$query = $this->db->get();
		return $query->result();
		#echo $this->db->get_compiled_select();
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