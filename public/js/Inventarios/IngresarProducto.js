$(document).ready(function () {
	selectedItem = 0;
	$productos = [];

	// Bloqueamos el envio automatico del codigo de barras
	$(window).keydown(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	// Cargamos la informacion del producto acorde al código de barras proporcionado
	$('#codigo').focusout(function (e) {
		if ($('#codigo').val() != '') {
			$producto = ajax('BuscarCodigo', { codigo_de_barras: $('#codigo').val() });
			setProducto($producto);
		}
	});

	// Cargar el combo con los tipos de movientos de entrada
	var tipos = ObtenerCatMovimientos({ tipo: 'E' });
	$.each(tipos, function (index, item) {
		$('#motivo').append("<option value='" + item.cve_movimiento + "'>" + item.descripcion + "</option>");
	});
	$('#motivo').val('C');

	// Autocomplete del campo de nombre de producto
	$('#producto').autocomplete({
		source: "buscarProducto",
		minLength: 3,
		select: function (evt, ui) {
			setProducto(ui.item);
		}
	});

	// Configuracion de la tabla de ingresos
	$('#tablaIngresos').bootstrapTable({
		data: $productos,
		clickToSelect: true,
		columns: [
			{ field: 'cve_cat_producto', title: 'cve_cat_producto', visible: false },
			{ field: '_motivo', title: '_motivo', visible: false },
			{ field: 'codigo_de_barras', title: 'Código', sortable: true },
			{ field: 'descripcion', title: 'Descripción', sortable: true },
			{ field: 'marca', title: 'Marca', sortable: true },
			{ field: 'departamento', title: 'Departamento', sortable: true },
			{ field: 'cantidad', title: 'Cantidad', sortable: true, align: 'right', halign: 'right' },
			{ field: 'motivo', title: 'Motivo', sortable: true },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs borrar' title='Cancelar ingreso'><i class='fa fa-times'></i> Cancelar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			selectedItem = row.cve_cat_producto;
		}
	});

	// Quitar la partida seleccionada
	$('#tablaIngresos tbody').on('click', 'button.borrar', function () {
		$('#tablaIngresos').bootstrapTable('remove', { field: 'cve_cat_producto', values: [selectedItem] });
	});

	// Agregar el producto registrado a la tabla de ingresos
	$('#agregar').click(function () {
		if ($('#cve_cat_producto').val() == '') {
			swal({
				html: '<h3>Debes capturar la información del producto a ingresar</h3>',
				showConfirmButton: true,
				type: 'info'
			});
			return false;
		}
		if ($('#cantidad').val() == '' || $('#cantidad').val() == 0) {
			swal({
				html: '<h3>Debes capturar la cantidad de producto a ingresar</h3>',
				showConfirmButton: true,
				type: 'info'
			});
			return false;
		}
		$flag = false;
		$productos = $('#tablaIngresos').bootstrapTable('getData');
		$.each($productos, function (i, item) {
			if (item.cve_cat_producto == $('#cve_cat_producto').val()) {
				item.cantidad = parseFloat(item.cantidad) + parseFloat($('#cantidad').val());
				$('#tablaIngresos').bootstrapTable('load', $productos);
				$flag = true;
				return false;
			}
		});
		if ($flag == false) {
			row = {
				cve_cat_producto: $('#cve_cat_producto').val(),
				_motivo: $('#motivo').val(),
				codigo_de_barras: $('#codigo').val(),
				descripcion: $('#producto').val(),
				marca: $('#marca').val(),
				departamento: $('#departamento').val(),
				cantidad: $('#cantidad').val(),
				motivo: $('#motivo option:selected').text()
			};
			$('#tablaIngresos').bootstrapTable('append', row);
		}
		setProducto({ cve_cat_producto: '', codigo_de_barras: '', value: '', departamento: '', marca: '' });
		$('#codigo').focus();
	});

	// LImpiar el formulario
	$('#cancelar').click(function () {
		setProducto({cve_cat_producto: '', codigo_de_barras: '', value: '', departamento: '', marca: '' });
		$('#codigo').focus();
	});

	// Enviar el data de la captura para ingresar a inventarios
	$('#cargar').click(function () {
		$productos = $('#tablaIngresos').bootstrapTable('getData');
		if ($productos.length == 0) {
			swal({
				html: '<h3>Sin datos por guardar</h3>',
				showConfirmButton: true,
				type: 'info',
			});
			return false;
		}
		$.ajax({
			url: 'GuardarIngreso',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: {productos: $productos},
			beforeSend: function () {
				swal({
					html: '<h3>Guardando datos, espera...</h3>',
					showConfirmButton: false,
					type: 'info',
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
					$.notify({
						message: 'El ingreso de los productos se realizó con éxito'
					}, {
							type: 'success'
						});
					setProducto({ cve_cat_producto: '', codigo_de_barras: '', value: '', departamento: '', marca: '' });
					$('#tablaIngresos').bootstrapTable('load', []);
					swal.close();
				}
			}
		});
	});

});

// Funcion para setear la informacion del producto seleccionado en el formulario de alta
function setProducto(ui) {
	$('#cve_cat_producto').val(ui.cve_cat_producto);
	$('#codigo').val(ui.codigo_de_barras);
	$('#producto').val(ui.value);
	$('#departamento').val(ui.departamento);
	$('#marca').val(ui.marca);
	$('#cantidad').val(0);
	$('#motivo').val('C');
}