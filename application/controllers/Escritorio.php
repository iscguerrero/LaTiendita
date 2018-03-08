<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Escritorio extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Escritorio/Inicio');
	}

	public function ObtenerData() {
		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$this->load->model('vn_devolucion_encabezado');
		$this->load->model('vn_gastos');
		$this->load->model('in_stock');

		$where = array('fecha > ' => date('Y-m-d'), 'fecha <= ' => date('Y-m-d H:i:s'));
		$campos = 'sum(total) as total';
		$ventas = $this->vn_remision_encabezado->obtener($where, $campos);

		$devoluciones = $this->vn_devolucion_encabezado->obtener($where, $campos);

		$where = array('fecha' => date('Y-m-d'));
		$campos = 'sum(cantidad) as total';
		$gastos = $this->vn_gastos->obtener($where, $campos);

		$where = array('created_at > ' => date('Y-m-d'), 'created_at <= ' => date('Y-m-d H:i:s'));
		$campos = 'sum(existencia * precio_unitario) as total';
		$ingresos = $this->in_stock->obtener($where, $campos);

		$ventasHora = $this->vn_remision_encabezado->VentaHora();
		$ventasDia = $this->vn_remision_encabezado->VentaDia();
		$ventasMes = $this->vn_remision_encabezado->VentaMes();

		$piezasVentaDia = $this->vn_remision_partidas->PiezasVentaDia()->piezas;
		$piezasVentaMes = $this->vn_remision_partidas->PiezasVentaMes()->piezas;
		$piezasVentaAnio = $this->vn_remision_partidas->PiezasVentaAnio()->piezas;



		exit(json_encode(array('ventas'=>$ventas['total'], 'devoluciones'=>$devoluciones['total'], 'gastos'=>$gastos['total'], 'ingresos'=>$ingresos['total'], 'ventasHora'=>$ventasHora, 'piezasVentaDia'=> $piezasVentaDia, 'ventasDia'=>$ventasDia, 'piezasVentaMes'=>$piezasVentaMes, 'ventasMes'=>$ventasMes, 'piezasVentaAnio'=>$piezasVentaAnio)));
	}
}
