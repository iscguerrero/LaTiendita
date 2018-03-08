$(window).keyup(function (e) {
	if (e.keyCode == 36) {
		event.preventDefault();
		$('#codigo').focus();
	}
	if (e.keyCode == 35) {
		event.preventDefault();
		$('#efectivo').focus();
	}
	if (e.keyCode == 33) {
		event.preventDefault();
		$('#producto').focus();
	}
	if (e.keyCode == 46) {
		event.preventDefault();
		cancelarVenta();
	}
	if (e.keyCode == 34) {
		event.preventDefault();
		finalizarVenta();
	}
});
$(document).ready(function () {
	window.selectedItem = 0;
	productos = [];
	// Configuracion de la tabla de productos
	$('#tablaProductos').bootstrapTable({
		data: productos,
		clickToSelect: true,
		classes: 'table table-shopping',
		columns: [
			{ field: 'cve_cat_producto', visible: false },
			{ field: 'producto', title: '' },
			{
				field: 'precio', title: 'Precio', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			},
			{
				field: 'piezas', title: 'Piezas', align: 'right', halign: 'right', editable: {
					type: 'text',
					mode: 'popup',
					showbuttons: false,
					success: function (response, newValue) {
						data = $('#tablaProductos').bootstrapTable('getData');
						index = $(this).closest('tr').attr('data-index');
						row = data[index];
						row.piezas = newValue;
						row.total = row.precio * newValue;
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
				field: 'total', title: 'Total', align: 'right', halign: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',')
				}
			},
			{
				align: 'center', halign: 'center', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-default quitar' title='Remover item de la lista'><i class='fa fa-minus'></i></button>"
				}
			}
		],
		onClickRow: function (row, $element, field) {
			window.selectedItem = row.cve_cat_producto;
		}, onEditableShown(editable, field, row, $el) {
			setTimeout(function () {
				$el.input.$input.select();
			}, 0);
		}
	});
	// Remover item de la lista
	$('#tablaProductos tbody').on('click', 'button.quitar', function () {
		$('#tablaProductos').bootstrapTable('remove', { field: 'cve_cat_producto', values: [window.selectedItem] });
		actualizarTotales();
		$('#codigo').focus();
	});
	// Envío del formulario con el codigo de barras para obtener la información del producto
	$('#formCodigo').submit(function (e) {
		e.preventDefault();
		$producto = ajax('../Inventarios/ObtenerProducto', { codigo_de_barras: $('#codigo').val() });
		if (typeof $producto.cve_cat_producto !== 'undefined') {
			agregarFila({ cve_cat_producto: $producto.cve_cat_producto, producto: $producto.descripcion, precio: $producto.precio_unitario, piezas: 1 });
		} else {
			$('#codigo').val('').focus();
		}
	});
	// Autocomplete del campo de nombre de producto
	$('#producto').autocomplete({
		source: "../Inventarios/buscarProducto",
		minLength: 3,
		select: function (evt, ui) {
			agregarFila({ cve_cat_producto: ui.item.cve_cat_producto, producto: ui.item.value, precio: ui.item.precio_unitario, piezas: 1 });
			$(this).val('');
			$('#codigo').val('').focus();
			return false;
		}
	});

	// Cancelar con boton
	$('#cancelar').click(function () {
		cancelarVenta();
	});

	// Funcion para finalizar la venta con boton
	$('#finalizar').click(function () {
		finalizarVenta();
	});
	$('#efectivo').keyup(function (e) {
		if (e.keyCode == 13) {
			event.preventDefault();
			finalizarVenta();
		}
	});

});

// Funcion para agregar una partida a la tabla de ventas
function agregarFila(row) {
	flag = false;
	productos = $('#tablaProductos').bootstrapTable('getData');
	$.each(productos, function (i, item) {
		if (parseInt(item.cve_cat_producto) == parseInt(row.cve_cat_producto)) {
			item.piezas = parseFloat(item.piezas) + parseFloat(row.piezas);
			item.total = item.piezas * item.precio;
			flag = true;
			return false;
		}
	});
	if (flag == false) {
		row.total = row.precio;
		productos.push(row);
	}
	$('#tablaProductos').bootstrapTable('load', productos);
	actualizarTotales();
	$('#codigo').val('').focus();
}

// Funcion para actualizar el total de la compra
function actualizarTotales() {
	$total = 0;
	productos = $('#tablaProductos').bootstrapTable('getData');
	$.each(productos, function (i, item) {
		$total = parseFloat($total) + parseFloat(item.total);
	});
	$('#total').html(formato_numero($total, 2, '.', ','))
	$('#codigo').val('').focus();
}

// Funcion para cancelar la venta
function cancelarVenta() {
	swal({
		type: 'question',
		title: "Espera!",
		html: '¿Estás seguro de cancelar la venta?',
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

// Funcion para limpiar la vista del punto de venta
function limpiarPunto() {
	$('#tablaProductos').bootstrapTable('removeAll');
	$('#codigo, #producto, #efectivo').val('');
	$('#total').html('');
	swal.close();
	$('#codigo').focus();
}

// Funcion para finalizar la venta
function finalizarVenta() {
	$productos = $('#tablaProductos').bootstrapTable('getData');
	if ($productos.length == 0) {
		swal({
			html: '<h3>Ningún producto por vender</h3>',
			showConfirmButton: true,
			type: 'info',
		});
		return false;
	}
	$.ajax({
		url: 'EjecutarVenta',
		type: 'POST',
		async: true,
		cache: false,
		dataType: 'json',
		data: { productos: $productos, efectivo: $('#efectivo').val() },
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
					html: 'La venta se registro con éxito! </br> ' + data.msj +  '</br> ¿Deseas imprimir el ticket de venta?',
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
					window.open('Ticket/' + data.folio);
				}, function () {
					limpiarPunto();
				});
			}
		}
	});

}