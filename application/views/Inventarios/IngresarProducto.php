<?php $this->layout($_SESSION['cve_perfil'] == '001' ? '_Layout' : 'Layout', ['title'=>'mSV::Ingresar Producto', 'sitepage'=>'Ingresar Producto'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card card-plain">
			<div class="card-content">
				<div class="row">
					<input type="hidden" name="cve_cat_producto" id="cve_cat_producto">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-5">
						<div class="form-group">
							<label for="codigo">Código de Barras</label>
							<input type="text" placeholder="Leer código de barras" class="form-control" name="codigo" id="codigo" autofocus>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-7">
						<div class="form-group">
							<label for="producto">Producto</label>
							<input type="text" placeholder="o buscar por nombre" class="form-control" name="producto" id="producto">
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group">
							<label for="departamento">Departamento</label>
							<input type="text" class="form-control" name="departamento" id="departamento" readonly>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group">
							<label for="marca">Marca</label>
							<input type="text" class="form-control" name="marca" id="marca" readonly >
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group">
							<label for="motivo">Motivo</label>
							<select name="motivo" id="motivo" class="form-control"></select>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<div class="form-group">
							<label for="cantidad">Cantidad a Ingresar</label>
							<input type="number" class="form-control text-right" name="cantidad" id="cantidad" >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-6">
						<button class="btn btn-primary" id="cargar"><i class="fa fa-floppy-o"></i> Cargar ingresos al inventario</button>
					</div>
					<div class="col-xs-6 text-right">
						<button type="button" class="btn bttn-default" id="cancelar"><i class="fa fa-times-circle"></i> Cancelar</button>
						<button type="button" class="btn btn-primary" id="agregar"><i class="fa fa-thumbs-up"></i> Añadir</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
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