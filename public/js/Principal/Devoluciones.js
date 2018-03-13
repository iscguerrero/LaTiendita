$(document).ready(function () {
	productos = [];
	// Configuracion de la tabla de productos
	$('#tablaProductos').bootstrapTable({
		data: productos,
		clickToSelect: true,
		classes: 'table table-shopping',
		columns: [
			{ field: 'folio', visible: false },
			{ field: 'id', visible: false },
			{ field: 'cve_cat_producto', visible: false },
			{ field: 'costo_unitario', visible: false },
			{ field: 'producto', title: 'Producto', align: 'left', halign: 'left' },
			{
				field: 'precio_unitario', title: 'Precio Venta', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			},
			{
				field: 'piezas', title: 'Piezas Vendidas', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			},
			{
				field: 'total_partida', title: 'Total', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			},
			{
				field: 'devueltas', title: 'Piezas Devueltas', align: 'right', halign: 'right', editable: {
					type: 'text',
					mode: 'popup',
					showbuttons: false,
					success: function (response, newValue) {
						data = $('#tablaProductos').bootstrapTable('getData');
						index = $(this).closest('tr').attr('data-index');
						row = data[index];
						row.devueltas = newValue;
						row.devuelto = row.precio_unitario * newValue;
						$('#tablaProductos').bootstrapTable('updateRow', { index, row });
						actualizarTotales();
					}, validate: function (value) {
						if ($.trim(value) == '') {
							return 'Ingresa una cantidad';
						}
					}
				}
			},
			{
				field: 'devuelto', title: 'Total', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			}
		], onEditableShown(editable, field, row, $el) {
			setTimeout(function () {
				$el.input.$input.select();
			}, 0);
		}
	});
	// Envío del formulario con el codigo de barras para obtener la información del producto
	$('#formCodigo').submit(function (e) {
		e.preventDefault();
		$remision = ajax('ObtenerRemision', { codigo_de_barras: $('#codigo').val() });
		if ($remision.length > 0) {
			$('#tablaProductos').bootstrapTable('load', $remision)
		} else {
			$('#tablaProductos').bootstrapTable('removeAll');
		}
		$('#codigo').val('').focus();
	});

	// Cancelar con boton
	$('#cancelar').click(function () {
		cancelarDevolucion();
	});

	// Funcion para finalizar la venta con boton
	$('#finalizar').click(function () {
		finalizarDevolucion();
	});

});

// Funcion para actualizar el total de la devolucion
function actualizarTotales() {
	$devuelto = 0;
	productos = $('#tablaProductos').bootstrapTable('getData');
	$.each(productos, function (i, item) {
		$devuelto = parseFloat($devuelto) + parseFloat(item.devuelto);
	});
	$('#total').html(formato_numero($devuelto, 2, '.', ','))
	$('#codigo').val('').focus();
}

// Funcion para cancelar la devolucion
function cancelarDevolucion() {
	swal({
		type: 'question',
		title: "Espera!",
		html: '¿Estás seguro de cancelar la devolución?',
		buttonsStyling: true,
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonClass: "btn btn-primary btn-fill",
		cancelButtonClass: "btn btn-default btn-fill"
	}).then(function (isConfirm) {
		limpiarPunto();
	}, function () {
		swal.close();
	});
}

// Funcion para limpiar la vista del panel de devoluciones
function limpiarPunto() {
	$('#tablaProductos').bootstrapTable('removeAll');
	$('#codigo').val('');
	$('#total').html('');
	swal.close();
	$('#codigo').focus();
}

// Funcion para finalizar la devolucion
function finalizarDevolucion() {
	$productos = $('#tablaProductos').bootstrapTable('getData');
	flag = false;
	$.each($productos, function (i, item) {
		if (parseFloat(item.devueltas) > 0) {
			flag = true;
			return true;
		}	
	});
	if (flag == false) {
		swal({
			html: '<h3>No se especifico que productos se devolveran</h3>',
			showConfirmButton: true,
			type: 'info',
		});
		return false;
	}
	$.ajax({
		url: 'EjecutarDevolucion',
		type: 'POST',
		async: true,
		cache: false,
		dataType: 'json',
		data: { productos: $productos, devuelto: $('#total').html() },
		beforeSend: function () {
			swal({
				type: 'info',
				html: '<h3>Espera un momento...</h3>',
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false
			});
		},
		success: function (data) {
			if (data.bandera == false) {
				swal({
					title: "Atiende!",
					html: data.msj,
					buttonsStyling: true,
					confirmButtonClass: "btn btn-warning btn-fill",
					type: 'warning'
				});
				return false
			} else {
				swal({
					type: 'question',
					title: "Éxito!",
					html: 'La devolución se registro con éxito! </br> ' + data.msj + '</br> ¿Deseas regresar al punto de venta?',
					buttonsStyling: true,
					showCancelButton: true,
					confirmButtonText: 'Si',
					cancelButtonText: 'No',
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonClass: "btn btn-primary btn-fill",
					cancelButtonClass: "btn btn-default btn-fill"
				}).then(function (isConfirm) {
					limpiarPunto();
					location.href = '../Punto/Inicio';
				}, function () {
					limpiarPunto();
				});
			}
		}
	});

}