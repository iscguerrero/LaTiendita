$(document).ready(function () {
	selectedItem = 0;
	// Cargamos la informacion del producto acorde al código de barras proporcionado
	$('#codigo').change(function (e) {
		if (e.keyCode == 13) {
			e.preventDefault();
			$producto = ajax('ObtenerProducto', { codigo_de_barras: $.cookie('codigo') });
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
		data: [],
		clickToSelect: true,
		columns: [
			{ field: 'cve_cat_producto', title: 'cve_cat_producto', visible: false },
			{ field: '_motivo', title: '_motivo', visible: false },
			{ field: 'codigo_de_barras', title: 'Código', sortable: true },
			{ field: 'descripcion', title: 'Descripción', sortable: true },
			{ field: 'marca', title: 'Marca', sortable: true },
			{ field: 'departamento', title: 'Departamento', sortable: true },
			{ field: 'Ingreso', title: 'Ingreso', sortable: true, align: 'right', halign: 'right' },
			{ field: 'Motivo', title: 'Motivo', sortable: true },
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
		
	});

	// Agregar el producto registrado a la tabla de ingresos
	$('#btnAgregar').submit(function () {
		
	});

});

// Funcion para setear la informacion del producto seleccionado en el formulario de alta
function setProducto(ui) {
	$('#codigo').val(ui.codigo_de_barras);
	$('#producto').val(ui.value);
	$('#departamento').val(ui.departamento);
	$('#marca').val(ui.marca);
}