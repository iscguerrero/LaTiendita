<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Punto extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Punto/Inicio');
	}

	public function EjecutarVenta() {
		$this->load->model('in_cat_productos');
		$this->load->model('in_stock');
		$this->load->model('in_kardex_movimientos');
		$productos = $this->input->post('productos');
		$efectivo = $this->input->post('efectivo');
		$total = 0;

		# Comprobamos que haya más existencia de la que se quiere dar de baja
		foreach($productos as $key => $item) {
			$where = array('cve_cat_producto'=>$item['cve_cat_producto']);
			$producto = $this->in_stock->obtener($where, 'sum(existencia) as existencia');
			$existencia = $producto['existencia'];
			if($item['piezas'] > $existencia) {
				exit(json_encode(array('bandera'=>false, 'msj'=>'La cantidad(' . $item['piezas'] . ') de ' . $item['producto'] . ' que quieres vender es mayor a la existencia(' . $existencia . ') en inventario')));
			}
			$total += $item['total'];
		}

		if($total > $efectivo)
			exit(json_encode(array('bandera'=>false, 'msj'=>'El efectivo recibido es menor al total de la venta')));

		$this->db->trans_begin();
		foreach($productos as $key => $item) {
			$lotes = $this->in_stock->lotes($item['cve_cat_producto']);
			foreach($lotes as $lote) {
				$salida = 0;
				while($productos[$key]['piezas'] > 0 && $lote->existencia > 0) {
					if($lote->existencia < $productos[$key]['piezas']){
						$salida = $lote->existencia;
						$productos[$key]['piezas'] = $productos[$key]['piezas'] - $lote->existencia;
						$lote->existencia = 0;
					} else if($lote->existencia == $productos[$key]['piezas']) {
						$salida = $lote->existencia;
						$productos[$key]['piezas'] = 0;
						$lote->existencia = 0;
					} else if($lote->existencia > $productos[$key]['piezas']) {
						$salida = $productos[$key]['piezas'];
						$lote->existencia = $lote->existencia - $productos[$key]['piezas'];
						$productos[$key]['piezas'] = 0;
					}
				}
				$dstock = array(
					'id' => $lote->id,
					'existencia' => $lote->existencia
				);
				$dkardex = array(
					'cve_cat_producto' => $item['cve_cat_producto'],
					'tipo_movimiento' => 'S',
					'cve_movimiento' => 'V',
					'cantidad' => $salida,
					'lote' => $lote->lote,
					'precio_unitario' => $item['precio'],
					'costo_unitario' => $lote->costo_unitario
				);
				$this->in_stock->alta($dstock);
				$this->in_kardex_movimientos->alta($dkardex);
				if($productos[$key]['piezas'] == 0) break;
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al ingresar los productos')));
		} else {
			$this->db->trans_commit();
			exit(json_encode(array('bandera'=>true, 'msj'=>'Los ingresos se realizaron con éxito')));
		}

	}

}
