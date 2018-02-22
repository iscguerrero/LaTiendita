$(document).ready(function () {
	marcas = ObtenerMarcas();
	deptos = ObtenerDepartamentos();
	metricas = ObtenerMetricas();
	// Bloqueamos el envio automatico del codigo de barras
	$(window).keydown(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
	// Cargamos los combos de la vista
	$('#selectMarca').html("<option value=''>Selecciona...</option>");
	$.each(marcas, function (key, item) {
		$('#selectMarca').append("<option value='" + item.cve_marca + "'>" + item.descripcion + "</option>");
	});
	$('#selectDepartamento').html("<option value=''>Selecciona...</option>");
	$.each(deptos, function (key, item) {
		$('#selectDepartamento').append("<option value='" + item.cve_departamento + "'>" + item.descripcion + "</option>");
	});
	$('#selectMetrica').html("<option value=''>Selecciona...</option>");
	$.each(metricas, function (key, item) {
		$('#selectMetrica').append("<option value='" + item.cve_metrica + "'>" + item.descripcion + "</option>");
	});

	// En caso de que la cookie de la clave del producto este definida se setea la informacion del producto
	if (typeof $.cookie('cve_cat_producto') != 'undefined') {
		$producto = ajax('ObtenerProducto', { cve_cat_producto: $.cookie('cve_cat_producto') });
		setearProducto($producto);
		$.removeCookie("cve_cat_producto", { path: '/LaTiendita/Inventarios' });
		$('#inputExistencia').prop('readonly', true).val('').prop('placeholder', 'Solo altas');
		$('#inputCodigo').prop('readonly', true);
	}

	// Mandamos llamar la funcion para guardar la informacion del producto
	$('#formProducto').submit(function (e) {
		e.preventDefault();
		crudProducto();
	});
});

// Funcion para dar de alta / editar un producto
function crudProducto() {
	str = $('#formProducto').serialize();
	$.ajax({
		url: 'CrudProducto',
		type: 'POST',
		async: true,
		cache: false,
		dataType: 'json',
		data: str,
		beforeSend: function () {
			swal({
				html: '<h3>Guardando datos, espera...</h3>',
				showConfirmButton: false,
				type: 'info'
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
				swal.close();
				swal({
					type: 'success',
					title: "Atiende!",
					html: data.msj,
					buttonsStyling: true,
					showCancelButton: true,
					confirmButtonText: 'Nuevo producto',
					cancelButtonText: 'Ir a catálogo',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonClass: "btn btn-primary btn-fill",
					cancelButtonClass: "btn btn-default btn-fill"
				}).then(function (isConfirm) {
					$("#formProducto")[0].reset();
					$('#inputCveCatProducto').val('');
					$.removeCookie("cve_cat_producto", { path: '/LaTiendita/Inventarios' });
					swal.close();
					$('#inputCodigo').focus();
				}, function () {
					window.location.href = 'Productos';
				});
			}
		}
	});
}