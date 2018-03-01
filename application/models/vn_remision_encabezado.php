<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_remision_encabezado extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_remision_encabezado';
		$this->primary_key = 'folio';
		$this->return_type = 'array';
	}

	#Metodo para obtener el nuevo folio de la precotizacion
	public function folio()
	{
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

}