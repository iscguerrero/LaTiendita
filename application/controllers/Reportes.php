<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Reportes/Inicio');
	}

	public function VentasDiarias() {
		echo $this->templates->render('Reportes/VentasDiarias');
	}
	public function VentasMensuales() {
		echo $this->templates->render('Reportes/VentasMensuales');
	}
	public function ReporteGastos() {
		echo $this->templates->render('Reportes/ReporteGastos');
	}
	public function ReporteDevoluciones() {
		echo $this->templates->render('Reportes/ReporteDevoluciones');
	}
	public function ComparativoVentas() {
		echo $this->templates->render('Reportes/ComparativoVentas');
	}

	public function ObtenerVentasDiarias() {
		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$departamentos = $this->input->post('departamentos') !== null ? $this->input->post('departamentos') : array();
		$marcas = $this->input->post('marcas') !== null ? $this->input->post('marcas') : array();
		$estatus = $this->input->post('estatus');
		$anio = $this->input->post('anio');
		$fi = $anio . '-' . $this->input->post('mes') . '-01 00:00:00';
		$ff = $anio . '-' . $this->input->post('mes') . '-31 23:59:59';

		$ventas = $this->vn_remision_encabezado->rVentaMes($fi, $ff, $departamentos, $marcas, $estatus);
		$ventames = $piezasmes = 0;
		foreach ($ventas as $venta) {
			$ventames += $venta->venta;
			$piezasmes += $venta->piezas;
		}
		exit(json_encode(array('ventames' => $ventames, 'piezasmes' => $piezasmes, 'ventas' => $ventas)));
	}

	public function ObtenerVentasMensuales() {
		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$departamentos = $this->input->post('departamentos') !== null ? $this->input->post('departamentos') : array();
		$marcas = $this->input->post('marcas') !== null ? $this->input->post('marcas') : array();
		$estatus = $this->input->post('estatus');
		$fi = $this->str_to_date($this->input->post('de'));
		$ff = $this->str_to_date($this->input->post('a')) . ' 23:59:59';

		$ventas = $this->vn_remision_encabezado->rVentaAnio($fi, $ff, $departamentos, $marcas, $estatus);
		$ventaperiodo = $piezasperiodo = 0;
		foreach ($ventas as $venta) {
			$ventaperiodo += $venta->venta;
			$piezasperiodo += $venta->piezas;
		}
		exit(json_encode(array('ventaperiodo' => $ventaperiodo, 'piezasperiodo' => $piezasperiodo, 'ventas' => $ventas)));
	}

	public function ObtenerGastosPorDia() {
		$this->load->model('vn_gastos');
		$fi = $this->str_to_date($this->input->post('fi')) . ' 00:00:00';
		$ff = $this->str_to_date($this->input->post('ff')) . ' 23:59:59';

		$where = array(
			'fecha >=' => $fi,
			'fecha <=' => $ff,
		);
		$fields = "count(id) as ngasto";
		$ngastos = $this->vn_gastos->obtener($where, $fields);
		$ngastos = $ngastos['ngasto'];

		$gastos = $this->vn_gastos->gastos($fi, $ff, 'group');

		exit(json_encode(array('ngastos' => $ngastos, 'gastos' => $gastos)));
	}

	public function ObtenerDevolucionesPorDia() {
		$this->load->model('vn_devolucion_encabezado');
		$fi = $this->str_to_date($this->input->post('fi'));
		$ff = $this->str_to_date($this->input->post('ff'));

		$where = array(
			'fecha >=' => $fi,
			'fecha <=' => $ff,
		);
		$fields = "count(folio) as ndevolucion";
		$ndevoluciones = $this->vn_devolucion_encabezado->obtener($where, $fields);
		$ndevoluciones = $ndevoluciones['ndevolucion'];

		$devoluciones = $this->vn_devolucion_encabezado->rlistar($fi, $ff);

		exit(json_encode(array('ndevoluciones' => $ndevoluciones, 'devoluciones' => $devoluciones)));
	}

}
