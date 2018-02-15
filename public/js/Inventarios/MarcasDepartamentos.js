$(document).ready(function () {
	// Configuracion de la tabla de marcas
	$('#tablaMarcas').bootstrapTable({
		data: ObtenerMarcas(),
		toolbar: '#toolbarMarcas',
		clickToSelect: true,
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50, 100],
		columns: [
			{ field: 'cve_marca', title: 'cve_marca', visible: false },
			{ field: 'descripcion', title: 'Descripción', sortable: true },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<div class='btn-group'><button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button> <button type='button' class='btn btn-danger btn-xs borrar' title='Borrar'><i class='fa fa-times-circle'></i> Borrar</button></div>";
				}
			}
		]
	});

	// Configuracion de la tabla de departamentos
	$('#tablaDepartamentos').bootstrapTable({
		data: ObtenerDepartamentos(),
		clickToSelect: true,
		toolbar: '#toolbarDeptos',
		search: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50, 100],
		columns: [
			{ field: 'cve_familia', title: 'cve_familia', visible: false },
			{ field: 'descripcion', title: 'Descripción', sortable: true },
			{
				title: 'Acciones', align: 'right', formatter: function (value, row, index) {
					return "<div class='btn-group'><button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button> <button type='button' class='btn btn-danger btn-xs borrar' title='Borrar'><i class='fa fa-times-circle'></i>Borrar</button></div>";
				}
			}
		]
	});

	// Abrir el modal para dar de alta una nueva marca
	$('#btnAltaMarca').click(function () {
		$('#modalMarcas').modal('show');
	});
	// Limpiar el modal del crud de marcas al ocultar
	$('#modalMarca').on('hidden.bs.modal', function (e) {
		$("#formMarcas")[0].reset();
	});
	// Alta / Edicion de una marca
	$('#formMarcas').submit(function (e) {
		e.preventDefault();
		crudMarca();
	});

});

// Funcion para obtener la lista de marcas registradas en el sistema
function ObtenerMarcas() {
	return ajax('ObtenerMarcas', null);
}
// Funcion para obtener la lista de departamentos registrados en el sistema
function ObtenerDepartamentos() {
	return ajax('ObtenerDepartamentos', null);
}

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
				showConfirmButton: false
			});
		},
		success: function (data) {
			if (data.bandera == false) {
				swal({
					title: "Atiende!",
					html: data.msj,
					buttonsStyling: true,
					confirmButtonClass: "btn btn-warning btn-fill"
				});
				return false
			} else {
				$.notify({
					message: 'Petición procesada con éxito'
				}, {
					type: 'success'
					});
				$('#tablaMarcas').bootstrapTable(load, ObtenerMarcas());
				swal.close();
				$('#modalMarcas').modal('hide');
			}
		}
	});
}