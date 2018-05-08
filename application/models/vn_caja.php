<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vn_caja extends Base_Model {
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

	# Obtener un registro
	public function obtener($where, $campos) {
		return $this->get($where, $campos);
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
		$this->db->select('id, estatus')
			->from('vn_caja')
			->order_by('id', 'DESC');
		return $this->db->get()->row();
	}

	# Obtenemos el importe de cierre de caja del dia seleccionado
	public function cierre_caja($fecha){
		$query = $this->db->query("SELECT IFNULL(SUM(total), 0) as total FROM vn_remision_encabezado WHERE fecha BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:59'");
		$venta = $query->result();
		$venta = $venta[0]->total;

		$query = $this->db->query("SELECT IFNULL(SUM(total), 0) as total FROM vn_devolucion_encabezado WHERE fecha BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:59'");
		$devolucion = $query->result();
		$devolucion = $devolucion[0]->total;

		$query = $this->db->query("SELECT IFNULL(SUM(cantidad), 0) as total FROM vn_gastos WHERE fecha = '$fecha'");
		$gasto = $query->result();
		$gasto = $gasto[0]->total;

		$query = $this->db->query("SELECT IFNULL(SUM(importe_apertura), 0) as total FROM vn_caja WHERE fecha_apertura BETWEEN '$fecha 00:00:00' AND '$fecha 23:59:59'");
		$caja = $query->result();
		$caja = $caja[0]->total;

		return $venta - $devolucion - $gasto + $caja;
	}

}