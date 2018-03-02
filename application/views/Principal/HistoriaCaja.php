<?php $this->layout('Layout', ['title'=>'mSV::Historia de Caja', 'sitepage'=>'Historia de Caja'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

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
								<input type="text" class="form-control datepicker" name="inicio" id="inicio" required >
							</div>
							<div class="form-group">
								<label for="fin">Fin</label>
								<input type="text" class="form-control datepicker" name="fin" id="fin" required >
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
<script src="<?php echo base_url('public/js/Principal/HistoriaCaja.js') ?>"></script>
<?php $this->stop()?>