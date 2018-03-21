<?php $this->layout($_SESSION['cve_perfil'] == '001' ? '_Layout' : 'Layout', ['title'=>'mSV::Producto', 'sitepage'=>'Producto'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
		<div class="card">
			<div class="card-header">
				<p class="category">Altas y modificación de productos</p>
			</div>
			<form action="#" id="formProducto">
				<input type="hidden" name="inputCveCatProducto" id="inputCveCatProducto">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="radio radio-inline">
								<input type="radio" name="ckInventariable" id="ckSi" value="1" checked="checked" >
								<label for="ckSi"><strong>Inventariable</strong></label>
							</div>
							<div class="radio radio-inline">
								<input type="radio" name="ckInventariable" id="ckNo" value="0" >
								<label for="ckNo"><strong>No Inventariable</strong></label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<label for="inputCodigo">Código de barras</label>
							<div class="input-group">
								<input type="text" class="form-control" name="inputCodigo" id="inputCodigo" autofocus required>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" id="generarCodigo" >Generar</button>
								</span>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="inputDescripcion">Descripción</label>
								<input type="text" class="form-control" name="inputDescripcion" id="inputDescripcion" required>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="selectMarca">Marca</label>
								<select class="form-control" name="selectMarca" id="selectMarca"required></select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="selectDepartamento">Departamento</label>
								<select class="form-control" name="selectDepartamento" id="selectDepartamento"  required></select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="inputPrecio">Precio</label>
								<input type="number" class="form-control text-right" name="inputPrecio" id="inputPrecio"  required>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="inputCosto">Costo</label>
								<input type="number" class="form-control text-right" name="inputCosto" id="inputCosto"  required>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="inputExistencia">Existencia</label>
								<input type="number" class="form-control text-right" name="inputExistencia" id="inputExistencia"  required>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="inputPresentacion">Presentación</label>
								<input type="number" class="form-control text-right" name="inputPresentacion" id="inputPresentacion"  required>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="selectMetrica">Métrica</label>
								<select name="selectMetrica" id="selectMetrica" class="form-control"  required></select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="selectVenta">En Venta</label>
								<select name="selectVenta" id="selectVenta" class="form-control"  required>
									<option value="1">Si</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="selectStatus">Estatus</label>
								<select name="selectStatus" id="selectStatus" class="form-control"  required>
									<option value="A">Activo</option>
									<option value="X">Inactivo</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-xs-12 text-right">
							<a role="button" class="btn btn-default" href="<?php echo base_url('Inventarios/Productos') ?>"><i class="fa fa-times-circle"></i> Cancelar</a>
							<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('public/js/Inventarios/Producto.js') ?>"></script>
<?php $this->stop()?>