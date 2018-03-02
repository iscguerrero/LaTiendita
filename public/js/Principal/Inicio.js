$(document).ready(function () {
	// Abrir el modal para la apertura de caja
	$('#aAbrirCaja').click(function (e) {
		e.preventDefault();
		$('#modalAbrirCaja').modal('show');
	});
	// Abrir el modal para cerrar la caja
	$('#aCerrarCaja').click(function (e) {
		e.preventDefault();
		$('#modalCerrarCaja').modal('show');
	});
	// Abrir el modal para registrar un nuevo gasto
	$('#aNuevoGasto').click(function (e) {
		e.preventDefault();
		$('#modalNuevoGasto').modal('show');
	});

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

});