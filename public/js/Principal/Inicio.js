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
});