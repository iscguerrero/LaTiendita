$(document).ready(function () {
	$('#tProveedores').bootstrapTable({
		toolbar: ".toolbar",
		clickToSelect: true,
		showRefresh: true,
		search: true,
		showToggle: true,
		showColumns: true,
		pagination: true,
		searchAlign: 'left',
		pageSize: 8,
		clickToSelect: false,
		pageList: [8, 10, 25, 50, 100],

		formatShowingRows: function (pageFrom, pageTo, totalRows) {
			//do nothing here, we don't want to show the text "showing x of y from..."
		},
		formatRecordsPerPage: function (pageNumber) {
			return pageNumber + " rows visible";
		},
		icons: {
			refresh: 'fa fa-refresh',
			toggle: 'fa fa-th-list',
			columns: 'fa fa-columns',
			detailOpen: 'fa fa-plus-circle',
			detailClose: 'ti-close'
		}
	});

	// Abrir el modal para dar de alta un nuevo proveedor
	$('#btnAltaProveedor').click(function () {
		$('#modalProveedor').modal('show');
	});

	//activate the tooltips after the data table is initialized
	$('[rel="tooltip"]').tooltip();

	$(window).resize(function () {
		$table.bootstrapTable('resetView');
	});

});