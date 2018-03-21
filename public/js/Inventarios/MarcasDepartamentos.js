$(document).ready(function () {
	// Configuracion de la tabla de marcas
	$('#tablaMarcas').bootstrapTable({
		data: ObtenerMarcas(),
		toolbar: '#toolbarMarcas',
		clickToSelect: true,
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_marca', title: 'cve_marca', visible: false },
			{ field: 'descripcion', title: 'Descripción', align: 'left', sortable: true },
			{ field: 'estatus', title: 'estatus', visible: false },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#inputCveMarca').val(row.cve_marca);
			$('#inputMarca').val(row.descripcion);
			$('#inputStatusMarca').val(row.estatus);
		}
	});

	// Configuracion de la tabla de departamentos
	$('#tablaDepartamentos').bootstrapTable({
		data: ObtenerDepartamentos(),
		clickToSelect: true,
		toolbar: '#toolbarDeptos',
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_departamento', title: 'cve_departamento', visible: false },
			{ field: 'descripcion', title: 'Descripción', align: 'left', sortable: true },
			{ field: 'estatus', title: 'estatus', visible: false },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#inputCveDepartamento').val(row.cve_departamento);
			$('#inputDepartamento').val(row.descripcion);
			$('#inputStatusDepartamento').val(row.estatus);
		}
	});

	// Configuracion de la tabla de metricas
	$('#tablaMetricas').bootstrapTable({
		data: ObtenerMetricas(),
		clickToSelect: true,
		toolbar: '#toolbarMetricas',
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_metrica', title: 'cve_metrica', visible: false },
			{ field: 'metrica', title: 'Métrica', align: 'left', sortable: true },
			{ field: 'descripcion', title: 'Descripción', align: 'left', sortable: true },
			{ field: 'estatus', title: 'estatus', visible: false },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#inputCveMetrica').val(row.cve_metrica);
			$('#inputMetrica').val(row.metrica);
			$('#inputDescripcion').val(row.descripcion);
			$('#inputStatusMetrica').val(row.estatus);
		}
	});

	// Clic en el boton editar de la tabla de marcas
	$('#tablaMarcas tbody').on('click', 'button.editar', function () {
		$('#modalMarcas').modal('show');
	});

	// Clic en el boton editar de la tabla de departamentos
	$('#tablaDepartamentos tbody').on('click', 'button.editar', function () {
		$('#modalDepartamentos').modal('show');
	});

	// Clic en el boton editar de la tabla de metricas
	$('#tablaMetricas tbody').on('click', 'button.editar', function () {
		$('#modalMetricas').modal('show');
	});

	// Abrir el modal para dar de alta una nueva marca
	$('#btnAltaMarca').click(function () {
		$('#modalMarcas').modal('show');
	});

	// Abrir el modal para dar de alta un nuevo departamento
	$('#btnAltaDepartamento').click(function () {
		$('#modalDepartamentos').modal('show');
	});

	// Abrir el modal para dar de alta una nueva metrica
	$('#btnAltaMetrica').click(function () {
		$('#modalMetricas').modal('show');
	});

	// Limpiar el modal del crud de marcas al ocultar
	$('#modalMarcas').on('hidden.bs.modal', function (e) {
		$("#formMarcas")[0].reset();
		$('#inputCveMarca').val('');
	});

	// Limpiar el modal del crud de departamentos al ocultar
	$('#modalDepartamentos').on('hidden.bs.modal', function (e) {
		$("#formDepartamentos")[0].reset();
		$('#inputCveDepartamento').val('');
	});

	// Limpiar el modal del crud de metricas al ocultar
	$('#modalMetricas').on('hidden.bs.modal', function (e) {
		$("#formMetricas")[0].reset();
		$('#inputCveMetrica').val('');
	});

	// Alta / Edicion de una marca
	$('#formMarcas').submit(function (e) {
		e.preventDefault();
		crudMarca();
	});

	// Alta / Edicion de un departamentos
	$('#formDepartamentos').submit(function (e) {
		e.preventDefault();
		crudDepartamento();
	});

	// Alta / Edicion de una metrica
	$('#formMetricas').submit(function (e) {
		e.preventDefault();
		crudMetrica();
	});

});

// Funcion para dar de alta / editar una nueva marca
function crudMarca() {
	str = $('#formMarcas').serialize();
	$.ajax({
		url: 'CrudMarca',
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
				$.notify({
					message: 'Petición procesada con éxito'
				}, {
					type: 'success'
					});
				$('#tablaMarcas').bootstrapTable('load', ObtenerMarcas());
				swal.close();
				$('#modalMarcas').modal('hide');
			}
		}
	});
}

// Funcion para dar de alta / editar un departamento
function crudDepartamento() {
	str = $('#formDepartamentos').serialize();
	$.ajax({
		url: 'CrudDepartamento',
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
				$.notify({
					message: 'Petición procesada con éxito'
				}, {
						type: 'success'
					});
				$('#tablaDepartamentos').bootstrapTable('load', ObtenerDepartamentos());
				swal.close();
				$('#modalDepartamentos').modal('hide');
			}
		}
	});
}

// Funcion para dar de alta / editar una metrica
function crudMetrica() {
	str = $('#formMetricas').serialize();
	$.ajax({
		url: 'CrudMetrica',
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
				$.notify({
					message: 'Petición procesada con éxito'
				}, {
						type: 'success'
					});
				$('#tablaMetricas').bootstrapTable('load', ObtenerMetricas());
				swal.close();
				$('#modalMetricas').modal('hide');
			}
		}
	});
}