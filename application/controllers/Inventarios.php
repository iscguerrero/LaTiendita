<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventarios extends Base_Controller {
	function __construct(){
		parent::__construct();
	}
	# Vistas
		public function Inicio() {
			echo $this->templates->render('Inventarios/Inicio');
		}
		public function Producto() {
			echo $this->templates->render('Inventarios/Producto');
		}
		public function Productos() {
			echo $this->templates->render('Inventarios/Productos');
		}
		public function IngresarProducto() {
			echo $this->templates->render('Inventarios/IngresarProducto');
		}
		public function EgresarProducto() {
			echo $this->templates->render('Inventarios/EgresarProducto');
		}
		public function HistorialIngresos() {
			echo $this->templates->render('Inventarios/HistorialIngresos');
		}
		public function HistorialEgresos() {
			echo $this->templates->render('Inventarios/HistorialEgresos');
		}
		public function DetalleInventario() {
			echo $this->templates->render('Inventarios/DetalleInventario');
		}
		public function MarcasDepartamentos() {
			echo $this->templates->render('Inventarios/MarcasDepartamentos');
		}

	# Listado de catálogos
		public function ObtenerMarcas() {
			$this->load->model('in_cat_marcas');
			$campos = 'cve_marca, descripcion, estatus';
			$wheres = array('estatus' => 'A');
			exit(json_encode($this->in_cat_marcas->listar($wheres, $campos)));
		}
		public function ObtenerDepartamentos() {
			$this->load->model('in_cat_departamentos');
			$campos = 'cve_departamento, descripcion, estatus';
			$wheres = array('estatus' => 'A');
			exit(json_encode($this->in_cat_departamentos->listar($wheres, $campos)));
		}
		public function ObtenerMetricas() {
			$this->load->model('in_cat_metricas');
			$campos = 'cve_metrica, metrica, descripcion, estatus';
			$wheres = array('estatus' => 'A');
			exit(json_encode($this->in_cat_metricas->listar($wheres, $campos)));
		}
		public function ObtenerProducto() {
			$this->load->model('in_cat_productos');
			$campos = 'cve_cat_producto, cve_producto, inventariable, cve_marca, cve_departamento, cve_metrica, codigo_de_barras, descripcion, costo_unitario, precio_unitario, es_venta, estatus, presentacion, existencia';
			$where = $this->input->post('cve_cat_producto') !== null ? 
			array('cve_cat_producto' => $this->input->post('cve_cat_producto')) :
			array('codigo_de_barras' => $this->input->post('codigo_de_barras'));
			die(json_encode($this->in_cat_productos->obtener($where, $campos)));
		}
		public function ObtenerProductos() {
			$this->load->model('in_cat_productos');
			$departamentos = $this->input->post('departamentos') !== null ? $this->input->post('departamentos') : array();
			$marcas = $this->input->post('marcas') !== null ? $this->input->post('marcas') : array();
			$estatus = $this->input->post('estatus');
			die(json_encode($this->in_cat_productos->customListar($marcas, $departamentos, $estatus)));
		}
		public function ObtenerCatMovimientos() {
			$this->load->model('in_cat_movimientos');
			$campos = 'cve_movimiento, descripcion';
			$wheres = array('tipo_movimiento' => $this->input->post('tipo'));
			exit(json_encode($this->in_cat_movimientos->listar($wheres, $campos)));
		}

	# Alta / Edicion de nuevas elementos
		public function CrudMarca() {
			$this->form_validation->set_rules('inputMarca', 'Descripción', 'required', array('required'=>'La descripción de la marca es necesaria'));
			if ($this->form_validation->run() === false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

			$data = array(
				'descripcion' => $this->input->post('inputMarca'),
				'estatus' => $this->input->post('inputStatusMarca'),
			);
			if($this->input->post('inputCveMarca') != '') {
				$data['cve_marca'] = $this->input->post('inputCveMarca');
			}
			$this->load->model('in_cat_marcas');
			$this->in_cat_marcas->alta($data) == false ? exit(json_encode(array('bandera'=>false, 'msj'=>'No se registraron cambios'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito')));

		}
		public function CrudDepartamento() {
			$this->form_validation->set_rules('inputDepartamento', 'Descripción', 'required', array('required'=>'La descripción del departamento es necesaria'));
			if ($this->form_validation->run() === false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

			$data = array(
				'descripcion' => $this->input->post('inputDepartamento'),
				'estatus' => $this->input->post('inputStatusDepartamento'),
			);
			if($this->input->post('inputCveDepartamento') != '') {
				$data['cve_departamento'] = $this->input->post('inputCveDepartamento');
			}
			$this->load->model('in_cat_departamentos');
			$this->in_cat_departamentos->alta($data) == false ? exit(json_encode(array('bandera'=>false, 'msj'=>'No se registraron cambios'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito')));

		}
		public function CrudMetrica() {
			$this->form_validation->set_rules('inputMetrica', 'Métrica', 'required', array('required'=>'Es necesario un código de la métrica'));
			$this->form_validation->set_rules('inputDescripcion', 'Descripción', 'required', array('required'=>'Es necesaria una descripción de la métrica'));
			if ($this->form_validation->run() === false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

			$data = array(
				'metrica' => $this->input->post('inputMetrica'),
				'descripcion' => $this->input->post('inputDescripcion'),
				'estatus' => $this->input->post('inputStatusMetrica'),
			);
			if($this->input->post('inputCveMetrica') != '') {
				$data['cve_metrica'] = $this->input->post('inputCveMetrica');
			}
			$this->load->model('in_cat_metricas');
			$this->in_cat_metricas->alta($data) == false ? exit(json_encode(array('bandera'=>false, 'msj'=>'No se registraron cambios'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito')));

		}
		public function CrudProducto() {
			if( $this->input->post('inputCveCatProducto') == '' ) {
				$this->form_validation->set_rules('inputCodigo', 'Código', 'required|is_unique[in_cat_productos.codigo_de_barras]|integer', array('required'=>'Ingresa el código de barras del producto', 'is_unique'=>'El código ingresado ya se encuentra registrado', 'integer'=>'El código de barras debe ser una cadena de solo dígitos'));
				$this->form_validation->set_rules('inputExistencia', 'Existencia', 'required|numeric', array('required'=>'Ingresa la existencia inicial del producto', 'numeric'=>'Ingrese la existencia como un valor numerico'));
			}
			$this->form_validation->set_rules('ckInventariable', 'Inventariable', 'required', array('required'=>'Define si el producto será inventariable o no'));
			$this->form_validation->set_rules('inputDescripcion', 'Descripción', 'required', array('required'=>'Ingresa la descripción del producto'));
			$this->form_validation->set_rules('selectMarca', 'Marca', 'required', array('required'=>'Selecciona la marca del producto'));
			$this->form_validation->set_rules('selectDepartamento', 'Departamento', 'required', array('required'=>'Selecciona a que departamento pertenecerá el producto'));
			$this->form_validation->set_rules('inputPrecio', 'Precio', 'required|numeric', array('required'=>'Ingresa el precio de venta del producto', 'numeric'=>'Ingrese el precio como un valor numerico'));
			$this->form_validation->set_rules('inputCosto', 'Costo', 'required|numeric', array('required'=>'Ingresa el costo de compra del producto', 'numeric'=>'Ingrese el costo como un valor numerico'));
			$this->form_validation->set_rules('selectMetrica', 'Métrica', 'required', array('required'=>'Selecciona la unidad de medida del producto'));

			if ($this->form_validation->run() === false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));

			$this->load->model('in_cat_productos');
			$this->load->model('in_stock');
			$this->load->model('in_kardex_movimientos');
			$data = array(
				'inventariable' => $this->input->post('ckInventariable'),
				'cve_marca' => $this->input->post('selectMarca') * 1,
				'cve_departamento' => $this->input->post('selectDepartamento') * 1,
				'cve_metrica' => $this->input->post('selectMetrica') * 1,
				'codigo_de_barras' => $this->input->post('inputCodigo'),
				'descripcion' => $this->input->post('inputDescripcion'),
				'costo_unitario' => $this->input->post('inputCosto'),
				'precio_unitario' => $this->input->post('inputPrecio'),
				'es_venta' => $this->input->post('selectVenta'),
				'estatus' => $this->input->post('selectStatus'),
				'presentacion' => $this->input->post('inputPresentacion'),
				'existencia' => $this->input->post('inputExistencia')
			);
			if($this->input->post('inputCveCatProducto') != '') {
				$data['cve_cat_producto'] = $this->input->post('inputCveCatProducto');
			} else {
				$cve_cat_producto = $this->in_cat_productos->id() + 1;
				$cve_producto = str_pad($cve_cat_producto, 6, "0", STR_PAD_LEFT);
				$data['cve_producto'] = $cve_producto;
			}

			$this->db->trans_start();
				$cve_cat_producto = $this->in_cat_productos->alta($data);
				if($this->input->post('inputCveCatProducto') == '') {
					$dstock = array(
						'cve_cat_producto' => $cve_cat_producto,
						'existencia' => $this->input->post('inputExistencia'),
						'precio_unitario' => $this->input->post('inputPrecio'),
						'costo_unitario' => $this->input->post('inputCosto'),
						'lote' => date('MdDy') . str_pad($cve_cat_producto*1, 6, "0", STR_PAD_LEFT)
					);
					$dkardex = array(
						'cve_cat_producto' => $cve_cat_producto,
						'tipo_movimiento' => 'E',
						'cve_movimiento' => 'II',
						'cantidad' => $this->input->post('inputExistencia'),
						'lote' => date('MdDy') . str_pad($cve_cat_producto*1, 6, "0", STR_PAD_LEFT)
					);
					$this->in_stock->alta($dstock);
					$this->in_kardex_movimientos->alta($dkardex);
				}
			$this->db->trans_complete();

			$this->db->trans_status() == false ? exit(json_encode(array('bandera'=>false, 'msj'=>'No se registraron cambios'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Registro agregado con éxito, ¿Deseas agregar un nuevo producto o ir al catálogo?')));

		}
		public function GuardarIngreso() {
			$this->load->model('in_cat_productos');
			$this->load->model('in_stock');
			$this->load->model('in_kardex_movimientos');
			$productos = $this->input->post('productos');

			$this->db->trans_begin();
			foreach($productos as $key => $item) {
				$where = array('cve_cat_producto'=>$item['cve_cat_producto']);
				$producto = $this->in_cat_productos->obtener($where, 'precio_unitario, costo_unitario');
				$dstock = array(
					'cve_cat_producto' => $item['cve_cat_producto'],
					'existencia' => $item['cantidad'],
					'precio_unitario' => $producto['precio_unitario'],
					'costo_unitario' => $producto['costo_unitario'],
					'lote' => date('MdDy') . str_pad($item['cve_cat_producto']*1, 6, "0", STR_PAD_LEFT)
				);
				$dkardex = array(
					'cve_cat_producto' => $item['cve_cat_producto'],
					'tipo_movimiento' => 'E',
					'cve_movimiento' => $item['_motivo'],
					'cantidad' => $item['cantidad'],
					'lote' => date('MdDy') . str_pad($item['cve_cat_producto']*1, 6, "0", STR_PAD_LEFT),
					'precio_unitario' => $producto['precio_unitario'],
					'costo_unitario' => $producto['costo_unitario']
				);
				$this->in_stock->alta($dstock);
				$this->in_kardex_movimientos->alta($dkardex);
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al ingresar los productos')));
			} else {
				$this->db->trans_commit();
				exit(json_encode(array('bandera'=>true, 'msj'=>'Los ingresos se realizaron con éxito')));
			}

		}
		public function GuardarEgreso() {
			$this->load->model('in_cat_productos');
			$this->load->model('in_stock');
			$this->load->model('in_kardex_movimientos');
			$productos = $this->input->post('productos');

			# Comprobamos que haya más existencia de la que se quiere dar de baja
			foreach($productos as $key => $item) {
				$where = array('cve_cat_producto'=>$item['cve_cat_producto']);
				$producto = $this->in_stock->obtener($where, 'sum(existencia) as existencia');
				$existencia = $producto['existencia'];
				if($item['cantidad'] > $existencia) {
					exit(json_encode(array('bandera'=>false, 'msj'=>'La cantidad(' . $item['cantidad'] . ') de ' . $item['descripcion'] . ' que quieres egresar es mayor a la existencia(' . $existencia . ') en inventario')));
				}
			}

			$this->db->trans_begin();
			foreach($productos as $key => $item) {
				$lotes = $this->in_stock->lotes($item['cve_cat_producto']);
				foreach($lotes as $lote) {
					$salida = 0;
					while($productos[$key]['cantidad'] > 0 && $lote->existencia > 0) {
						if($lote->existencia < $productos[$key]['cantidad']){
							$salida = $lote->existencia;
							$productos[$key]['cantidad'] = $productos[$key]['cantidad'] - $lote->existencia;
							$lote->existencia = 0;
						} else if($lote->existencia == $productos[$key]['cantidad']) {
							$salida = $lote->existencia;
							$productos[$key]['cantidad'] = 0;
							$lote->existencia = 0;
						} else if($lote->existencia > $productos[$key]['cantidad']) {
							$salida = $productos[$key]['cantidad'];
							$lote->existencia = $lote->existencia - $productos[$key]['cantidad'];
							$productos[$key]['cantidad'] = 0;
						}
					}
					$dstock = array(
						'id' => $lote->id,
						'existencia' => $lote->existencia
					);
					$dkardex = array(
						'cve_cat_producto' => $item['cve_cat_producto'],
						'tipo_movimiento' => 'S',
						'cve_movimiento' => $item['_motivo'],
						'cantidad' => $salida,
						'lote' => $lote->lote,
						'precio_unitario' => $lote->precio_unitario,
						'costo_unitario' => $lote->costo_unitario
					);
					$this->in_stock->alta($dstock);
					$this->in_kardex_movimientos->alta($dkardex);
					if($productos[$key]['cantidad'] == 0) break;
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

	# Autocompletes
		public function buscarProducto() {
			$this->load->model('in_cat_productos');
			exit(json_encode($this->in_cat_productos->buscarProducto($this->input->get('term'))));
		}
		public function BuscarCodigo() {
			$this->load->model('in_cat_productos');
			exit(json_encode($this->in_cat_productos->buscarCodigo($this->input->post('codigo_de_barras'))));
		}
}
