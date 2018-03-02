<?php $this->layout('Layout', ['title'=>'mSV::Historial de Egresos', 'sitepage'=>'Historial de Egresos'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-plain">
			<div class="card-header">
			</div>
			<div class="table-responsive">
				<table id="tablaEgresos" class="table-condensed"></table>
			</div>
		</div>
	</div>
</div>

<div id="toolbar">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEgresos"><i class="fa fa-filter"></i> Filtros</button>
</div>
<!-- Modal para mostrar el formulario de filtros del reporte -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEgresos">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Productos</h4>
			</div>
			<form action="#" id="formEgresos">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="inicio">Inicio</label>
								<input type="text" class="form-control datepicker" name="inicio" id="inicio" required >
							</div>
							<div class="form-group">
								<label for="fin">Fin</label>
								<input type="text" class="form-control datepicker" name="fin" id="fin" required >
							</div>
							<div class="form-group">
								<select multiple title="Departamentos" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7" id="departamentos"></select>
							</div>
							<div class="form-group">
								<select multiple title="Marcas" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7" id="marcas"></select>
							</div>
							<div class="checkbox">
								<input name="estatus" id="ckVigentes" type="checkbox" checked>
								<label for="ckVigentes">Vigentes</label>
							</div>
							<div class="checkbox">
								<input name="estatus" id="ckDiscontinuados" type="checkbox">
								<label for="ckDiscontinuados">Descontinuados</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Generar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
	<script src="<?php echo base_url('public/js/Inventarios/HistorialEgresos.js') ?>"></script>
<?php $this->stop()?>