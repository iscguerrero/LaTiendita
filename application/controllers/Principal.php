<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Principal extends Base_Controller {
	function __construct(){
		parent::__construct();
	}
	public function Inicio() {
		echo $this->templates->render('Principal/Inicio');
	}
	public function HistoriaCaja() {
		echo $this->templates->render('Principal/HistoriaCaja');
	}
	public function Devoluciones() {
		echo $this->templates->render('Principal/Devoluciones');
	}
	public function Proveedores() {
		echo $this->templates->render('Principal/Proveedores');
	}
	public function ResumenFinanciero() {
		echo $this->templates->render('Principal/ResumenFinanciero');
	}

	public function ObtenerTiposGasto() {
		$this -> load -> model('vn_cat_gastos');
		$campos = 'cve_gasto, descripcion';
		$wheres = array();
		exit(json_encode($this->vn_cat_gastos->listar($wheres, $campos)));
	}

	public function AbrirCaja() {
		$this->form_validation->set_rules('apertura', 'Importe', 'required', array('required' => 'Debes proporcionar el importe con que se abrirá la caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->estatus();
		if( count($caja) > 0 && $caja->estatus == 'A' ) exit(json_encode(array('bandera' => false, 'msj' => 'La caja no fue cerrada la última vez que se aperturó, cierra la caja abierta y vuelve a aperturar')));

		$data = array(
			'importe_apertura' => $this->input->post('apertura'),
			'estatus' => 'A',
			'fecha_apertura' => date('Y-m-d H:i:s')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al aperturar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se aperturó con éxito ¿Deseas ir al punto de venta?')));
	}

	public function CerrarCaja() {
		$this->form_validation->set_rules('cierre', 'Importe', 'required', array('required' => 'Debes proporcionar el importe de cierre de caja'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_caja');

		$caja = $this->vn_caja->id();
		if (count($caja) == 0 || $caja->estatus == 'C') exit(json_encode(array('bandera' => false, 'msj' => 'No hay caja abierta, apertura antes de continuar')));

		$data = array(
			'id' => $caja->id,
			'importe_cierre' => $this->input->post('cierre'),
			'estatus' => 'C',
			'fecha_cierre' => date('Y-m-d H:i:s')
		);
		$this->vn_caja->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al cerrar la caja'))) : exit(json_encode(array('bandera' => true, 'msj' => 'La caja se cerro con éxito ¿Deseas finalizar sesión?')));
	}

	public function ObtenerHistoriaCaja() {
		$this->load->model('vn_caja');
		$inicio = $this->str_to_date($this->input->post('inicio'));
		$fin = $this->str_to_date($this->input->post('fin'));

		$campos = "date_format(fecha_apertura, '%Y-%m-%d') as fecha, DATE_FORMAT(fecha_apertura, '%d-%M-%Y') AS affecha, DATE_FORMAT(fecha_apertura, '%r') AS afhora, DATE_FORMAT(fecha_cierre, '%d-%M-%Y') AS cffecha, DATE_FORMAT(fecha_cierre, '%r') AS cfhora, importe_apertura as amonto, importe_cierre as cmonto";
		$where = array('fecha_apertura >=' => $inicio, 'fecha_apertura <=' => $fin . ' 23:59:59');
		$registros = $this->vn_caja->listar($where, $campos);

		foreach ($registros as $key => $registro) {
			$registros[$key]['csistema'] = $this->vn_caja->cierre_caja($registro['fecha']);
		}

		die(json_encode($registros));
	}

	public function NuevoGasto() {
		$this->form_validation->set_rules('importe', 'Importe', 'required', array('required' => 'Proporciona el importe del gasto'));
		$this->form_validation->set_rules('tipos', 'Tipos', 'required', array('required' => 'Proporciona el tipo de gasto que se efectuó'));
		$this->form_validation->set_rules('comentarios', 'Comentarios', 'required', array('required' => 'Proporciona una ligera descrición del motivo del gasto'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$this->load->model('vn_gastos');

		$data = array(
			'cve_gasto' => $this->input->post('tipos'),
			'cantidad' => $this->input->post('importe'),
			'descripcion' => $this->input->post('comentarios'),
			'fecha' => date('Y-m-d')
		);
		$this->vn_gastos->alta($data) == false ? exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al registrar el gasto'))) : exit(json_encode(array('bandera' => true, 'msj' => 'El gasto se registro con éxito, ¿Deseas ir al punto de venta?')));
	}

	public function ObtenerRemision() {
		$this->load->model('vn_remision_encabezado');
		exit(json_encode($this->vn_remision_encabezado->ObtenerRemision($this->input->post('codigo_de_barras'))));
	}

	public function EjecutarDevolucion() {
		$this->load->model('in_cat_productos');
		$this->load->model('in_stock');
		$this->load->model('in_kardex_movimientos');
		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$this->load->model('vn_devolucion_encabezado');
		$this->load->model('vn_devolucion_partidas');
		$productos = $this->input->post('productos');
		$devuelto = $this->input->post('devuelto');

		# Comprobamos que no se devuelvan mas productos de los vendidos
		foreach ($productos as $key => $item) {
			if ($item['devueltas'] > $item['piezas']) {
				exit(json_encode(array('bandera' => false, 'msj' => 'La cantidad(' . number_format($item['devueltas'], 2) . ') de ' . $item['producto'] . ' que quieres devolver es mayor a la cantidad vendida(' . $item['piezas'] . ')')));
			}
		}

		$this->db->trans_begin();

		$eencabezado = array(
			'folio' => $productos[0]['folio'],
			'estatus' => 'P'
		);
		$folio = $this->vn_remision_encabezado->alta($eencabezado);

		$dencabezado = array(
			'folio_remision' => $productos[0]['folio']
		);
		$dfolio = $this->vn_devolucion_encabezado->alta($dencabezado);
		$dtotal = 0;
		foreach ($productos as $key => $item) {
			$dtotal += $item['devuelto'];
			if($item['devueltas'] > 0) {
				$dstock = array(
					'cve_cat_producto' => $item['cve_cat_producto'],
					'existencia' => $item['devueltas'],
					'precio_unitario' => $item['precio_unitario'],
					'costo_unitario' => $item['costo_unitario'],
					'lote' => date('MdDy') . str_pad($item['cve_cat_producto'] * 1, 6, "0", STR_PAD_LEFT)
				);
				$this->in_stock->alta($dstock);
				$dkardex = array(
					'cve_cat_producto' => $item['cve_cat_producto'],
					'tipo_movimiento' => 'E',
					'cve_movimiento' => 'DV',
					'cantidad' => $item['devueltas'],
					'lote' => date('MdDy') . str_pad($item['cve_cat_producto'] * 1, 6, "0", STR_PAD_LEFT),
					'precio_unitario' => $item['precio_unitario'],
					'costo_unitario' => $item['costo_unitario'],
				);
				$this->in_kardex_movimientos->alta($dkardex);
				$dpartida = array(
					'id' => $item['id'],
					'piezas_devueltas' => $item['devueltas'],
					'estatus' => 'P'
				);
				$this->vn_remision_partidas->alta($dpartida);
				$dpartida = array(
					'folio' => $dfolio,
					'cve_cat_producto' => $item['cve_cat_producto'],
					'piezas' => $item['devueltas']
				);
				$this->vn_devolucion_partidas->alta($dpartida);
			}
		}

		$dencabezado = array(
			'folio' => $dfolio,
			'total' => $dtotal
		);
		$this->vn_devolucion_encabezado->alta($dencabezado);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al intentar registrar la devolución')));
		} else {
			$this->db->trans_commit();
			exit(json_encode(array('bandera' => true, 'msj' => 'El cambio para el cliente es de ' . number_format($devuelto, 2), 'folio' => $folio)));
		}

	}

	public function EstadoResultados() {
		$this->form_validation->set_rules('fi', 'Fecha Inicial', 'required', array('required' => 'Es necesario que proporciones la fecha inicial del estado de resultados'));
		$this->form_validation->set_rules('ff', 'Fecha Final', 'required', array('required' => 'Es necesario que proporciones la fecha final del estado de resultados'));
		if ($this->form_validation->run() === false) exit(json_encode(array('bandera' => false, 'msj' => 'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

		$fi = $this->str_to_date($this->input->post('fi'));
		$ff = $this->str_to_date($this->input->post('ff'));

		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$this->load->model('vn_devolucion_encabezado');
		$this->load->model('vn_gastos');
		$this->load->model('in_kardex_movimientos');
		$this->load->model('vn_caja');

		$where = array('fecha >= ' => $fi . ' 00:00:00', 'fecha <= ' => $ff . ' 23:59:59');
		$campos = 'sum(total) as total';
		$ingresos = $this->vn_remision_encabezado->obtener($where, $campos);

		$devoluciones = $this->vn_devolucion_encabezado->obtener($where, $campos);

		$campos = 'sum(cantidad) as total';
		$gastos = $this->vn_gastos->obtener($where, $campos);

		$where = array('tipo_movimiento' => 'S', 'cve_movimiento' => 'V', 'created_at >= ' => $fi . ' 00:00:00', 'created_at <= ' => $ff . ' 23:59:59');
		$campos = 'SUM(costo_unitario * cantidad) AS total';
		$costo = $this->in_kardex_movimientos->obtener($where, $campos);

		$where = array('fecha_apertura >= ' => $fi . ' 00:00:00', 'fecha_apertura <= ' => $ff . ' 23:59:59');
		$campos = 'sum(importe_apertura) as total';
		$caja = $this->vn_caja->obtener($where, $campos);

		$rventas = $this->vn_remision_encabezado->rventas($fi, $ff);
		$rgastos = $this->vn_gastos->gastos($fi, $ff);

		exit(json_encode(array(
			'bandera' => true,
			'ingresos' => $ingresos['total'],
			'costo' => $costo['total'],
			'caja' => $caja['total'],
			'utilidadbruta' => $ingresos['total'] - $costo['total'] + $caja['total'],
			'devoluciones' => $devoluciones['total'],
			'gastos' => $gastos['total'],
			'egresos' => $devoluciones['total'] + $gastos['total'],
			'utilidad' => $ingresos['total'] - $costo['total'] + $caja['total'] - $devoluciones['total'] - $gastos['total'],
			'rventas' => $rventas,
			'rgastos' => $rgastos
		)));
	}

}
