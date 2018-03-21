<?php $this->layout('Layout', ['title'=>'mSV::Historia de Caja', 'sitepage'=>'Historia de Caja'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div id="toolbar">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCaja"><i class="fa fa-filter"></i> Filtros</button>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="table-responsive">
				<table id="tablaCaja" class="table-condensed"></table>
			</div>
		</div>
	</div>
</div>

<!-- Modal para mostrar el formulario de filtros del reporte -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCaja">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Periodo</h4>
			</div>
			<form action="#" id="formCaja">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="inicio">Inicio</label>
								<input type="text" class="form-control datepicker text-center" name="inicio" id="inicio" required >
							</div>
							<div class="form-group">
								<label for="fin">Fin</label>
								<input type="text" class="form-control datepicker text-center" name="fin" id="fin" required >
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
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
<script src="<?php echo base_url('public/js/Principal/HistoriaCaja.js') ?>"></script>
<?php $this->stop()?>