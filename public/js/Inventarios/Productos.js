$(document).ready(function () {
	marcas = ObtenerMarcas();
	deptos = ObtenerDepartamentos();
	selectedItem = 0;
	// Cargamos los combos de la vista
	$.each(deptos, function (key, item) {
		$('#departamentos').append("<option value='" + item.cve_departamento + "'>" + item.descripcion + "</option>");
	});
	$.each(marcas, function (key, item) {
		$('#marcas').append("<option value='" + item.cve_marca + "'>" + item.descripcion + "</option>");
	});
	$('.selectpicker').selectpicker("refresh");

	// Configuracion de la tabla de productos
	$('#tablaProductos').bootstrapTable({
		data: ObtenerProductos(),
		toolbar: '#toolbar',
		clickToSelect: true,
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_cat_producto', title: 'cve_cat_producto', visible: false },
			{ field: 'descripcion', title: 'Descripción', sortable: true },
			{ field: 'descMarca', title: 'Marca', sortable: true },
			{ field: 'descDepto', title: 'Departamento', sortable: true },
			{ field: 'existencia', title: 'Existencia', sortable: true, align: 'right', halign: 'right' },
			{ field: 'costo_unitario', title: 'Costo', sortable: true, align: 'right', halign: 'right' },
			{ field: 'precio_unitario', title: 'Precio', sortable: true, align: 'right', halign: 'right' },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button> <button type='button' class='btn btn-info btn-xs imprimir' title='Imprimir tarjeta'><i class='fa fa-file-pdf-o'></i> Imprimir</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			selectedItem = row.cve_cat_producto;
		}
	});

// Redireccionar a la ventana de crud de producto para editar el producto seleccionado
	$('#tablaProductos tbody').on('click', 'button.editar', function () {
		$.cookie('cve_cat_producto', selectedItem);
		window.location.href = 'Producto';
	});

	// Abrir la ventana con el producto seleccionada para impresion
	$('#tablaProductos tbody').on('click', 'button.imprimir', function () {
		window.open('Tarjeta/' + selectedItem);
	});

// Volver a generar el reporte
	$('#formProductos').submit(function (e) {
		e.preventDefault();
		$('#tablaProductos').bootstrapTable('load', ObtenerProductos());
		$('#modalProductos').modal('hide');
	});

});

// Funcion para obtener la lista de marcas registradas en el sistema
function ObtenerProductos() {
	$deptos = $('#departamentos').val();
	$marcas = $('#marcas').val();
	$estatus = [];
	if ($('#ckVigentes').prop('checked') == true) $estatus.push('A');
	if ($('#ckDiscontinuados').prop('checked') == true) $estatus.push('X');
	return ajax('ObtenerProductos', {marcas: $marcas, departamentos: $deptos, estatus: $estatus});
}