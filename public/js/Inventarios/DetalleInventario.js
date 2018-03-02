$(document).ready(function () {
	marcas = ObtenerMarcas();
	deptos = ObtenerDepartamentos();
	selectedItem = 0;
	resumen = ObtenerResumen();
	$('#valor').text('$' + formato_numero(resumen.valor, 2, '.', ','));
	$('#costo').text('$' + formato_numero(resumen.costo, 2, '.', ','));
	$('#utilidad').text('$' + formato_numero(resumen.utilidad, 2, '.', ','));
	$('#existencia').text('$' + formato_numero(resumen.existencia, 2, '.', ',') + '|' + resumen.items);
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
		data: ObtenerStock(),
		clickToSelect: true,
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [5, 10, 25, 50],
		columns: [
			{ field: 'cve_cat_producto', title: 'cve_cat_producto', visible: false },
			{ field: 'producto', title: 'Producto', sortable: true, align: 'left' },
			{ field: 'marca', title: 'Marca', sortable: true, align: 'left' },
			{ field: 'departamento', title: 'Departamento', sortable: true, align: 'left' },
			{ field: 'existencia', title: 'Existencia', sortable: true, align: 'right', halign: 'right' },
			{ field: 'precio', title: 'Precio', sortable: true, align: 'right', halign: 'right' },
			{ field: 'costo', title: 'Costo', sortable: true, align: 'right', halign: 'right' },
			{ field: 'utilidad', title: 'Utilidad', sortable: true, align: 'right', halign: 'right' }
		]
	});

});

// Funcion para obtener la lista de marcas registradas en el sistema
function ObtenerStock() {
	return ajax('ObtenerStock');
}
function ObtenerResumen() {
	return ajax('ObtenerResumen');
}