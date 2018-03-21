$(document).ready(function () {
	var data = ajax('ObtenerData');
	$('#ventas').html('$' + formato_numero(data.ventas, 2, '.', ','));
	$('#devoluciones').html('$' + formato_numero(data.devoluciones, 2, '.', ','));
	$('#gastos').html('$' + formato_numero(data.gastos, 2, '.', ','));
	$('#ingresos').html('$' + formato_numero(data.ingresos, 2, '.', ','));

	$('#piezasVentas, #piezasVentaDia').text(formato_numero(data.piezasVentaDia, 0, '.', ','));
	$('#piezasVentaMes').text(formato_numero(data.piezasVentaMes, 0, '.', ','));
	$('#piezasVentaAnio').text(formato_numero(data.piezasVentaAnio, 0, '.', ','));

	$totalVentasDia = 0;
	$.each(data.ventasHora, function (i, item) { 
		$totalVentasDia = $totalVentasDia + parseFloat(item.venta);
	});
	$('#totalVentasDia').text(formato_numero($totalVentasDia, 2, '.', ','));

	Morris.Area({
		element: 'horas',
		behaveLikeLine: true,
		data: data.ventasHora,
		xkey: 'hora',
		ykeys: ['venta'],
		labels: ['Venta'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

	$totalVentasMes = 0;
	$.each(data.ventasDia, function (i, item) {
		$totalVentasMes = $totalVentasMes + parseFloat(item.venta);
	});
	$('#totalVentasMes').text(formato_numero($totalVentasMes, 2, '.', ','));

	Morris.Area({
		element: 'mes',
		behaveLikeLine: true,
		data: data.ventasDia,
		xkey: 'dia',
		ykeys: ['venta'],
		labels: ['Venta'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

	$totalVentasAnio = 0;
	$.each(data.ventasMes, function (i, item) {
		$totalVentasAnio = $totalVentasAnio + parseFloat(item.venta);
	});
	$('#totalVentasAnio').text(formato_numero($totalVentasAnio, 2, '.', ','));

	Morris.Area({
		element: 'anio',
		behaveLikeLine: true,
		data: data.ventasMes,
		xkey: 'mes',
		ykeys: ['venta'],
		labels: ['Venta'],
		parseTime: false,
		lineColors: ['#7AC29A'],
		resize: true
	});

});