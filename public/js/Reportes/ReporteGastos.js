$(document).ready(function () {
	chart = Morris.Area({
		element: 'gastos',
		behaveLikeLine: true,
		data: [],
		xkey: 'fecha',
		ykeys: ['cantidad'],
		labels: ['Gasto'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

	// Controlamos el envío del formulario al controlador
	$('#modalFiltros').submit(function (e) {
		e.preventDefault();
		str = $('#formFiltros').serialize();
		$.ajax({
			url: 'ObtenerGastosPorDia',
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
					$('#ngastos').html(formato_numero(data.ngastos, 2, '.', ','));
					chart.setData(data.gastos);
					$('#modalFiltros').modal('hide');
					swal.close();
				}
			}
		});
	});

});