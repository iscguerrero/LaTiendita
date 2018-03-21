<?php $this->layout('Layout', ['title'=>'mSV::Ventas Diarias', 'sitepage'=>'Ventas Diarias'])?>
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
			<font id="ventames"></font>
		</div>
		<div class="pull-right">
			<span class="label label-success">
				<font id="piezasmes"></font> artículos
			</span>
		</div>
		<h6 class="big-title">
			<span class="text-muted">Ventas por Día</span>
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
						<label for="anio">Año</label>
						<select class="form-control" name="anio" id="anio">
							<?php
								$i = 2018;
								$f = date('Y');
								for ($x=$i; $x <= $f; $x++) { 
									echo "<option value='" . $x . "'>" . $x . "</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="mes">Mes</label>
						<select name="mes" id="mes" class="form-control">
							<option value="01">Enero</option>
							<option value="02">Febrero</option>
							<option value="03">Marzo</option>
							<option value="04">Abril</option>
							<option value="05">Mayo</option>
							<option value="06">Junio</option>
							<option value="07">Julio</option>
							<option value="08">Agosto</option>
							<option value="09">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
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
	<script src="<?php echo base_url('public/js/Reportes/VentasDiarias.js') ?>"></script>
<?php $this->stop()?>