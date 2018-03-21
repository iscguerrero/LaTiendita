$(document).ready(function () {
	tipos = ObtenerTiposGasto();
	// Cargamos el combo de tipo de gastos
	$('#tipos').append("<option value=''>Selecciona...</option>");
	$.each(tipos, function (key, item) {
		$('#tipos').append("<option value='" + item.cve_gasto + "'>" + item.descripcion + "</option>");
	});
	// Abrir el modal para la apertura de caja
	$('#aAbrirCaja').click(function (e) {
		e.preventDefault();
		$('#modalAbrirCaja').modal('show');
	});
	$('#modalAbrirCaja').on('shown.bs.modal', function () {
		$('#apertura').focus();
	}).on('hidden.bs.modal', function () {
		$('#apertura').val('');
	})
	// Abrir el modal para cerrar la caja
	$('#aCerrarCaja').click(function (e) {
		e.preventDefault();
		$('#modalCerrarCaja').modal('show');
	});
	$('#modalCerrarCaja').on('shown.bs.modal', function () {
		$('#cierre').focus();
	}).on('hidden.bs.modal', function () {
		$('#cierre').val('');
	})
	// Abrir el modal para registrar un nuevo gasto
	$('#aNuevoGasto').click(function (e) {
		e.preventDefault();
		$('#modalGasto').modal('show');
	});
	$('#modalGasto').on('shown.bs.modal', function () {
		$('#importe').focus();
	}).on('hidden.bs.modal', function () {
		$('#importe').val('');
	})

	// Enviar el formulario para abrir caja
	$('#formAbrirCaja').submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: 'AbrirCaja',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: {apertura: $('#apertura').val()},
			beforeSend: function () {
				swal({
					html: '<h3>Abriendo caja, espera...</h3>',
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
					$('#modalAbrirCaja').modal('hide');
					swal({
						type: 'success',
						title: "Atiende!",
						html: data.msj,
						buttonsStyling: true,
						showCancelButton: true,
						confirmButtonText: 'Si',
						cancelButtonText: 'No',
						/*confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',*/
						confirmButtonClass: "btn btn-primary btn-fill",
						cancelButtonClass: "btn btn-default btn-fill"
					}).then(function (isConfirm) {
						$('#apertura').val('');
						swal.close();
						window.location.href = '../Punto/Inicio';
					}, function () {
						swal.close();
					});
				}
			}
		});
	});

	// Enviar el formulario para cerrar la caja
	$('#formCerrarCaja').submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: 'CerrarCaja',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: { cierre: $('#cierre').val() },
			beforeSend: function () {
				swal({
					html: '<h3>Cerrando caja, espera...</h3>',
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
					$('#modalCerrarCaja').modal('hide');
					swal({
						type: 'success',
						title: "Atiende!",
						html: data.msj,
						buttonsStyling: true,
						showCancelButton: true,
						confirmButtonText: 'Si',
						cancelButtonText: 'No',
						/*confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',*/
						confirmButtonClass: "btn btn-primary btn-fill",
						cancelButtonClass: "btn btn-default btn-fill"
					}).then(function (isConfirm) {
						$('#cierre').val('');
						swal.close();
						window.location.href = '../Login/Salir';
					}, function () {
						swal.close();
					});
				}
			}
		});
	});

	// Enviar el formulario para registrar un nuevo gasto
	$('#formGasto').submit(function (e) {
		e.preventDefault();
		str = $('#formGasto').serialize();
		$.ajax({
			url: 'NuevoGasto',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: str,
			beforeSend: function () {
				swal({
					html: '<h3>Registrando gasto, espera...</h3>',
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
					$('#modalGasto').modal('hide');
					swal({
						type: 'success',
						title: "Atiende!",
						html: data.msj,
						buttonsStyling: true,
						showCancelButton: true,
						confirmButtonText: 'Si',
						cancelButtonText: 'No',
						confirmButtonClass: "btn btn-primary btn-fill",
						cancelButtonClass: "btn btn-default btn-fill"
					}).then(function (isConfirm) {
						swal.close();
						window.location.href = '../Punto/Inicio';
					}, function () {
						swal.close();
					});
				}
			}
		});
	});

});

function ObtenerTiposGasto() {
	return ajax('ObtenerTiposGasto');
}