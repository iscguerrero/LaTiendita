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

	// Configuracion de la tabla de ingresos
	$('#tablaIngresos').bootstrapTable({
		data: ObtenerIngresos(),
		toolbar: '#toolbar',
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [5, 10, 25, 50],
		columns: [
			{ field: 'motivo', title: 'Motivo', align: 'left', sortable: true },
			{ field: 'cve_cat_producto', title: 'cve_cat_producto', visible: false },
			{ field: 'ffecha', title: 'Fecha', align: 'center' },
			{ field: 'producto', title: 'Producto', align: 'left', sortable: true },
			{ field: 'marca', title: 'Marca', align: 'left', sortable: true },
			{ field: 'departamento', title: 'Departamento', align: 'left', sortable: true },
			{ field: 'cantidad', title: 'Cantidad', align: 'right', halign: 'right' },
			{ field: 'costo_unitario', title: 'Costo', align: 'right', halign: 'right' },
			{ field: 'precio_unitario', title: 'Precio', align: 'right', halign: 'right' }
		]
	});

// Volver a generar el reporte
	$('#formProductos').submit(function (e) {
		e.preventDefault();
		$('#tablaIngresos').bootstrapTable('load', ObtenerIngresos());
		$('#modalIngresos').modal('hide');
	});

});

// Funcion para obtener la lista de ingresos en el sistema
function ObtenerIngresos() {
	$deptos = $('#departamentos').val();
	$marcas = $('#marcas').val();
	$inicio = $('#inicio').val();
	$fin = $('#fin').val();
	$estatus = [];
	if ($('#ckVigentes').prop('checked') == true) $estatus.push('A');
	if ($('#ckDiscontinuados').prop('checked') == true) $estatus.push('X');
	return ajax('ObtenerMovimientos/E', {marcas: $marcas, departamentos: $deptos, estatus: $estatus, inicio: $inicio, fin: $fin});
}