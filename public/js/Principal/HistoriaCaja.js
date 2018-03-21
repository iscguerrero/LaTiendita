$(document).ready(function () {
	// Configuracion de la tabla de ingresos
	$('#tablaCaja').bootstrapTable({
		data: ObtenerHistoriaCaja(),
		toolbar: '#toolbar',
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [5, 10, 25, 50],
		columns: [[
			{ title: 'Apuertura de caja', align: 'center', halign: 'center', valign: 'middle', colspan: 3 },
			{ title: 'Cierre de caja', align: 'center', halign: 'center', valign: 'middle', colspan: 3 },
			{ title: 'Sistema', align: 'right' }
		], [
			{ field: 'affecha', title: 'Fecha', align: 'center' },
			{ field: 'afhora', title: 'Hora', align: 'center' },
			{
				field: 'amonto', title: 'Monto', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{ field: 'cffecha', title: 'Fecha', align: 'center' },
			{ field: 'cfhora', title: 'Hora', align: 'center' },
			{
				field: 'cmonto', title: 'Monto', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{
				field: 'csistema', title: 'Monto Cierre', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			}
		]]
	});

	// Volver a generar el reporte
	$('#formCaja').submit(function (e) {
		e.preventDefault();
		$('#tablaCaja').bootstrapTable('load', ObtenerHistoriaCaja());
		$('#modalCaja').modal('hide');
	});

});

// Funcion para obtener la lista de ingresos en el sistema
function ObtenerHistoriaCaja() {
	$inicio = $('#inicio').val();
	$fin = $('#fin').val();
	return ajax('ObtenerHistoriaCaja', { inicio: $inicio, fin: $fin });
}