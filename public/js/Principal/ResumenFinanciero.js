$(document).ready(function () {
	selectedItem = 0;
	// Generamos el estado de resultados
	$('#formParametros').submit(function (e) {
		e.preventDefault();
		str = $('#formParametros').serialize();
		$.ajax({
			url: 'EstadoResultados',
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			data: str,
			beforeSend: function () {
				swal({
					html: '<h3>Generando reporte, espera...</h3>',
					type: 'info',
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false
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
					$('#ingresos').html('$' + formato_numero(data.ingresos, 2, '.', ','));
					$('#costo').html('$' + formato_numero(data.costo, 2, '.', ','));
					$('#caja').html('$' + formato_numero(data.caja, 2, '.', ','));
					$('#utilidadbruta').html('$' + formato_numero(data.utilidadbruta, 2, '.', ','));
					$('#devoluciones').html('$' + formato_numero(data.devoluciones, 2, '.', ','));
					$('#gastos').html('$' + formato_numero(data.gastos, 2, '.', ','));
					$('#egresos').html('$' + formato_numero(data.egresos, 2, '.', ','));
					$('#utilidad').html('$' + formato_numero(data.utilidad, 2, '.', ','));
					$('#rventas').bootstrapTable('load', data.rventas);
					$('#rgastos').bootstrapTable('load', data.rgastos);
					swal.close();
				}
			}
		});
	});

	$('#rventas').bootstrapTable({
		data: [],
		search: true,
		columns: [
			{field: 'folio'},
			{ field: 'codigo_de_barras', title: 'Folio', align: 'center' },
			{ field: 'fecha', title: 'Fecha', align: 'center' },
			{
				field: 'ventas', title: 'Ventas', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{
				field: 'costo', title: 'Costo', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{
				field: 'devoluciones', title: 'Devoluciones', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-info btn-xs imprimir' title='Imprimir ticket'><i class='fa fa-file-pdf-o'></i> Imprimir</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			selectedItem = row.folio;
		}
	});

	// Imprimir la venta seleccionada
	$('#rventas tbody').on('click', 'button.imprimir', function () {
		window.open('../Punto/Ticket/' + selectedItem);
	});

	$('#rgastos').bootstrapTable({
		data: [],
		search: true,
		columns: [
			{ field: 'fecha', title: 'Fecha', align: 'center' },
			{ field: 'gasto', title: 'Gasto', align: 'left' },
			{ field: 'comentarios', title: 'Comentarios', align: 'left' },
			{
				field: 'cantidad', title: 'Importe', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			}
		]
	});


});