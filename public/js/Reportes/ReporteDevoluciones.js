$(document).ready(function () {
	chart = Morris.Area({
		element: 'devoluciones',
		behaveLikeLine: true,
		data: [],
		xkey: 'ffecha',
		ykeys: ['total'],
		labels: ['Total'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

	// Controlamos el envío del formulario al controlador
	$('#modalFiltros').submit(function (e) {
		e.preventDefault();
		str = $('#formFiltros').serialize();
		$.ajax({
			url: 'ObtenerDevolucionesPorDia',
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
					$('#ndevoluciones').html(formato_numero(data.ndevoluciones, 2, '.', ','));
					chart.setData(data.devoluciones);
					$('#modalFiltros').modal('hide');
					swal.close();
				}
			}
		});
	});

});