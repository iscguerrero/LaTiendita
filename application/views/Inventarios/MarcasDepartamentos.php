<?php $this->layout('Layout', ['title'=>'mSV::Marcas y Departamentos', 'sitepage'=>'Marcas y Departamentos'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<link href="<?php echo base_url('resources/bootstrap-table/bootstrap-table.min.css')?>" rel="stylesheet">
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-1 col-lg-5">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Marcas</h4>
			</div>
			<div class="card-content table-responsive table-full-width">
				<table class="table table-striped" id="tablaMarcas"></table>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-0 col-lg-5">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Departamentos</h4>
			</div>
			<div class="card-content table-responsive table-full-width">
				<table class="table table-striped" id="tablaDepartamentos"></table>
			</div>
		</div>
	</div>
</div>
<div id="toolbarMarcas">
	<button type='button' class='btn btn-primary' title='Alta nueva marca' id="btnAltaMarca"><i class='fa fa-plus-square'></i> Alta</button>
</div>
<div id="toolbarDeptos">
	<button type='button' class='btn btn-primary' title='Alta nuevo departamento' id="btnAltaDepartamento"><i class='fa fa-plus-square'></i> Alta</button>
</div>
<!-- Modal para crud de marcas -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalMarcas">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Marcas</h4>
			</div>
			<form action="#" id="formMarcas">
				<input type="hidden" name="inputCveMarca" id="inputCveMarca">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label for="inputMarca">Marca</label>
								<input type="text" class="form-control" name="inputMarca" id="inputMarca">
							</div>
							<div class="form-group">
								<label for="inputStatusMarca">Estatus</label>
								<select class="form-control" name="inputStatusMarca" id="inputStatusMarca">
									<option value="A">Activo</option>
									<option value="X">Suspendido</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
	<script src="<?php echo base_url('public/js/Inventarios/MarcasDepartamentos.js') ?>"></script>
<?php $this->stop()?>