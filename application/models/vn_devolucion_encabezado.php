<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_devolucion_encabezado extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_devolucion_encabezado';
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

	public function rlistar($fi, $ff) {
		$this->db->select("sum(total) as total, date_format(fecha, '%d-%M-%Y') as ffecha")
		->from('vn_devolucion_encabezado')
		->where('fecha >= ', $fi.' 00:00:00')
		->where('fecha <= ', $ff.' 23:59:59')
		->group_by('ffecha');
		$query = $this->db->get();
		return $query->result();
	}


}