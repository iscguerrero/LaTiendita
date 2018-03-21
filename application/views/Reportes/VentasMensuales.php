<?php $this->layout('Layout', ['title'=>'mSV::Ventas Mensuales', 'sitepage'=>'Ventas Mensuales'])?>
<?php $this->start('css')?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/morris.css') ?>">
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="card">
	<div class="card-header">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFiltros"><i class="fa fa-filter"></i> Filtros</button>
	</div>
	<div class="card-content">
		<div class="numbers pull-left">
			<font id="ventaperiodo"></font>
		</div>
		<div class="pull-right">
			<span class="label label-success">
				<font id="piezasperiodo"></font> artículos
			</span>
		</div>
		<h6 class="big-title">
			<span class="text-muted">Ventas por Mes</span>
		</h6>
		<div id="ventas"></div>
	</div>
</div>
<!-- Modal para mostrar el formulario de filtros del reporte -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalFiltros">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Filtros</h4>
			</div>
			<form action="#" id="formFiltros">
				<div class="modal-body">
					<div class="form-group">
						<label for="de">De</label>
						<input type="text" class="form-control text-center datepicker" name="de" id="de">
					</div>
					<div class="form-group">
						<label for="a">A</label>
						<input type="text" class="form-control text-center datepicker" name="a" id="a">
					</div>
					<div class="form-group">
						<select multiple title="Departamentos" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7" name="departamentos" id="departamentos"></select>
					</div>
					<div class="form-group">
						<select multiple title="Marcas" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7" name="marcas" id="marcas"></select>
					</div>
					<div class="checkbox">
						<input name="estatus[]" id="ckVigentes" type="checkbox" checked value='A'>
						<label for="ckVigentes">Vigentes</label>
					</div>
					<div class="checkbox">
						<input name="estatus[]" id="ckDiscontinuados" type="checkbox" value='X'>
						<label for="ckDiscontinuados">Descontinuados</label>
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
	<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/morris.min.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Reportes/VentasMensuales.js') ?>"></script>
<?php $this->stop()?>