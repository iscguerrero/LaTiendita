<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Punto extends Base_Controller
{
	function __construct() {
		parent::__construct();
	}

	public function Inicio() {
		echo $this->templates->render('Punto/Inicio');
	}

	public function EjecutarVenta() {
		$this->load->model('in_cat_productos');
		$this->load->model('in_stock');
		$this->load->model('in_kardex_movimientos');
		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$productos = $this->input->post('productos');
		$efectivo = $this->input->post('efectivo');
		$total = 0;

		# Comprobamos que haya más existencia de la que se quiere dar de baja
		foreach ($productos as $key => $item) {
			$where = array('cve_cat_producto' => $item['cve_cat_producto']);
			$producto = $this->in_stock->obtener($where, 'sum(existencia) as existencia');
			$existencia = $producto['existencia'];
			if ($item['piezas'] > $existencia) {
				exit(json_encode(array('bandera' => false, 'msj' => 'La cantidad(' . $item['piezas'] . ') de ' . $item['producto'] . ' que quieres vender es mayor a la existencia(' . $existencia . ') en inventario')));
			}
			$total += $item['total'];
		}

		if ($total > $efectivo)
			exit(json_encode(array('bandera' => false, 'msj' => 'El efectivo recibido es menor al total de la venta')));

		$this->db->trans_begin();

		$codigo = $this->vn_remision_encabezado->folio() == 0 ? 1 : $this->vn_remision_encabezado->folio() + 1;
		$dencabezado = array(
			'codigo_de_barras' => str_pad($codigo, 12, "0", STR_PAD_LEFT),
			'total' => $total,
			'efectivo' => $efectivo,
			'estatus' => 'V'
		);
		$folio = $this->vn_remision_encabezado->alta($dencabezado);

		foreach ($productos as $key => $item) {
			$costo = 0;
			$lotes = $this->in_stock->lotes($item['cve_cat_producto']);
			foreach ($lotes as $lote) {
				$salida = 0;
				while ($productos[$key]['piezas'] > 0 && $lote->existencia > 0) {
					if ($lote->existencia < $productos[$key]['piezas']) {
						$salida = $lote->existencia;
						$productos[$key]['piezas'] = $productos[$key]['piezas'] - $lote->existencia;
						$lote->existencia = 0;
					} else if ($lote->existencia == $productos[$key]['piezas']) {
						$salida = $lote->existencia;
						$productos[$key]['piezas'] = 0;
						$lote->existencia = 0;
					} else if ($lote->existencia > $productos[$key]['piezas']) {
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
				$costo = $lote->costo_unitario;
				if ($productos[$key]['piezas'] == 0) break;
			}

			$dpartida = array(
				'partida' => $key + 1,
				'folio' => $folio,
				'cve_cat_producto' => $item['cve_cat_producto'],
				'piezas' => $item['piezas'],
				'precio_unitario' => $item['precio'],
				'costo_unitario' => $costo,
				'total' => $item['total'],
				'estatus' => 'V'
			);
			$this->vn_remision_partidas->alta($dpartida);
		}


		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al ingresar los productos')));
		} else {
			$this->db->trans_commit();
			exit(json_encode(array('bandera' => true, 'msj' => 'El cambio para el cliente es de ' . number_format($efectivo - $total, 2), 'folio' => $folio)));
		}

	}

	public function Ticket($folio) {
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', array(54, 215.9));

		$pdf->SetMargins(1, 1, 5);
		$pdf->SetAutoPageBreak(true, 15);
		$pdf->AliasNbPages();

		$pdf->AddPage();

		$this->load->model('vn_remision_encabezado');
		$this->load->model('vn_remision_partidas');
		$remision = $this->vn_remision_encabezado->obtener(array('folio' => $folio), "*, date_format(fecha, '%d-%m-%Y') as ffecha");
		$partidas = $this->vn_remision_partidas->partidas($folio);

		$pdf->SetFont('Courier', '', 8);
		$codigo = str_pad($folio, 12, "0", STR_PAD_LEFT);
		$pdf->EAN13(10, 12, $codigo);

		$pdf->setXY(1, 33);

		# Leyendas del formato / partidas
			$pdf->SetFont('Times', 'B', 8);
			$pdf->Cell(8, 3, 'Cant.', 0, 0, 'R', false);
			$pdf->Cell(23, 3, 'Art.', 0, 0, 'L', false);
			$pdf->Cell(9, 3, 'Pre. Uni.', 0, 0, 'R', false);
			$pdf->Cell(12, 3, 'Total', 0, 1, 'R', false);

		# Se descarga la informacion de las partidas de la cotizacion
		$pdf->SetFont('Times', '', 7);
			$pdf->SetWidths(array(8, 23, 9, 12));
			$pdf->SetAligns(array('R', 'L', 'R', 'R'));
			foreach ($partidas as $key => $partida) {
				$pdf->Row(array(number_format($partida->piezas, 2), $partida->descripcion, number_format($partida->precio_unitario, 1), number_format($partida->total, 1)));
			}

		# Impresion de los totales
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Times', 'B', 8);
		$pdf->Cell(30, 4, 'Total', 0, 0, 'R', false);
		$pdf->Cell(22, 4, number_format($remision['total'], 2), 0, 1, 'R', false);
		$pdf->Cell(30, 4, 'Efectivo', 0, 0, 'R', false);
		$pdf->Cell(22, 4, number_format($remision['efectivo'], 2), 0, 1, 'R', false);
		$pdf->Cell(30, 3, 'Cambio', 0, 0, 'R', false);
		$pdf->Cell(22, 3, number_format($remision['efectivo'] - $remision['total'], 2), 0, 1, 'R', false);

		$pdf->Ln(5);
		$pdf->SetFont('Times', '', 8);
		$pdf->Cell(0, 3, 'Fecha de Venta ' . $remision['ffecha'], 0, 1, 'L', false);
		$pdf->MultiCell(0, 3, utf8_decode("Para cualquier aclaración o devolución respecto de esta compra favor de presentar este ticket en caja"), 0, 'J', false);

		$pdf->Ln(2);
		$pdf->MultiCell(0, 3, utf8_decode("¡Que siga teniendo un excelente día!"), 0, 'J', false);

		$pdf->Output();
	}

}