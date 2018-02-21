<?php $this->layout('Layout', ['title'=>'mSV::Ingresar Producto', 'sitepage'=>'Ingresar Producto'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card card-plain">
			<div class="card-header">
				<h4 class="card-title">Añadir a Existencia</h4>
			</div>
			<div class="card-content">
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group">
							<label for="codigo">Código de Barras</label>
							<input type="text" placeholder="Leer código de barras" class="form-control" name="codigo" id="codigo">
						</div>
					</div>
					<div class="col-lg-7">
						<div class="form-group">
							<label for="producto">Producto</label>
							<input type="text" placeholder="o buscar por nombre" class="form-control" name="producto" id="producto">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="departamento">Departamento</label>
							<input type="text" class="form-control" name="departamento" id="departamento" readonly>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="marca">Marca</label>
							<input type="text" class="form-control" name="marca" id="marca" readonly >
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="motivo">Motivo</label>
							<select name="motivo" id="motivo" class="form-control"></select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="cantidad">Cantidad a Ingresar</label>
							<input type="text" class="form-control text-right" name="cantidad" id="cantidad" >
						</div>
					</div>
					<div class="col-xs-12 text-right">
						<button type="button" class="btn bttn-default"><i class="fa fa-times-circle"></i> Cancelar</button>
						<button type="button" class="btn btn-primary" id="btnAgregar"><i class="fa fa-thumbs-up"></i> Añadir</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card card-plain">
			<div class="card-header">
				<h4 class="card-title">Lista de Ingresos a Productos</h4>
			</div>
			<div class="table-responsive">
				<table id="tablaIngresos"></table>
			</div>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
	<script src="<?php echo base_url('public/js/Inventarios/IngresarProducto.js') ?>"></script>
<?php $this->stop()?>