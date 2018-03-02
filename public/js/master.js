$(document).ready(function () {
	// Configuracion del datepicker
	$('.datepicker').datetimepicker({
		locale: 'es',
		format: 'DD-MMMM-YYYY',
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-chevron-up",
			down: "fa fa-chevron-down",
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-remove'
		}
	});
});

// Ajax generico
var ajax = function (url, str) {
	response = [];
	$.ajax({
		url: url,
		data: str,
		type: 'POST',
		async: false,
		cache: false,
		dataType: 'json',
		success: function (json) {
			response = json;
		}
	});
	return response;
}

// Funcion para obtener la lista de marcas registradas en el sistema
function ObtenerMarcas() {
	return ajax('ObtenerMarcas', null);
}

// Funcion para obtener la lista de departamentos registrados en el sistema
function ObtenerDepartamentos() {
	return ajax('ObtenerDepartamentos', null);
}

// Funcion para obtener la lista de metricas registrados en el sistema
function ObtenerMetricas() {
	return ajax('ObtenerMetricas', null);
}

// Funcion para obtener el catálogo de tipos de movimientos
function ObtenerCatMovimientos(str) {
	return ajax('ObtenerCatMovimientos', str);
}

// Funcion para setear la informacion de un producto en en formulario de la vista
function setearProducto(producto) {
	$('#inputCveCatProducto').val(producto.cve_cat_producto);
	$('#ckSi').prop('checked', producto.inventariable == 1 ? true : false);
	$('#ckNo').prop('checked', producto.inventariable == 0 ? true : false);
	$('#inputCodigo').val(producto.codigo_de_barras);
	$('#inputDescripcion').val(producto.descripcion);
	$('#selectMarca').val(producto.cve_marca);
	$('#selectDepartamento').val(producto.cve_departamento);
	$('#inputPrecio').val(producto.precio_unitario);
	$('#inputCosto').val(producto.costo_unitario);
	$('#inputExistencia').val(producto.existencia);
	$('#inputPresentacion').val(producto.presentacion);
	$('#selectMetrica').val(producto.cve_metrica);
	$('#selectVenta').val(producto.es_venta);
	$('#selectStatus').val(producto.estatus);
}

// Funcion para dar formato a un numero
function formato_numero(numero, decimales, separador_decimal, separador_miles) {
	numero = parseFloat(numero);
	if (isNaN(numero)) return '';
	if (decimales !== undefined) numero = numero.toFixed(decimales);
	numero = numero.toString().replace('.', separador_decimal !== undefined ? separador_decimal : ',');
	if (separador_miles) {
		var miles = new RegExp("(-?[0-9]+)([0-9]{3})");
		while (miles.test(numero)) {
			numero = numero.replace(miles, '$1' + separador_miles + '$2');
		}
	}
	return numero;
}