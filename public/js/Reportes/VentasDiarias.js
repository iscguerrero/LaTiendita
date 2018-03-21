$(document).ready(function () {
	marcas = ObtenerMarcas();
	deptos = ObtenerDepartamentos();
	// Cargamos los combos de la vista
	$.each(deptos, function (key, item) {
		$('#departamentos').append("<option value='" + item.cve_departamento + "'>" + item.descripcion + "</option>");
	});
	$.each(marcas, function (key, item) {
		$('#marcas').append("<option value='" + item.cve_marca + "'>" + item.descripcion + "</option>");
	});
	$('.selectpicker').selectpicker("refresh");

	chart = Morris.Area({
		element: 'ventas',
		behaveLikeLine: true,
		data: [],
		xkey: 'dia',
		ykeys: ['venta'],
		labels: ['Venta'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

	// Controlamos el envío del formulario al controlador
	$('#modalFiltros').submit(function (e) {
		e.preventDefault();
		str = $('#formFiltros').serialize();
		$.ajax({
			url: 'ObtenerVentasDiarias',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: str,
			beforeSend: function () {
				swal({
					html: '<h3>Generando informe, espera un momento por favor</h3>',
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
					$('#ventames').html('$' + formato_numero(data.ventames, 2, '.', ','));
					$('#piezasmes').html(formato_numero(data.piezasmes, 2, '.', ','));
					chart.setData(data.ventas);
					$('#modalFiltros').modal('hide');
					swal.close();
				}
			}
		});
	});

});