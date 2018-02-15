<?php $this->layout('Layout', ['title'=>'mSV::Ingresar Producto', 'sitepage'=>'Ingresar Producto'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-md-12">
		<div class="card card-plain">
			<div class="card-header">
				<h4 class="card-title">Añadir a Productos Existentes</h4>
			</div>
			<div class="card-content">
				<div class="row">
					<div class="col-lg-8">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="">Producto</label>
									<input type="text" placeholder="Buscar por código o nombre de producto" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Existencia</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Motivo</label>
									<select class="form-control" name="" id="">
										<option value="">Compra</option>
										<option value="">Resago</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="">Marca</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Cantidad a Ingresar</label>
									<input type="text" class="form-control">
								</div>
								<div class="text-right">
									<button type="button" class="btn btn-cancel"><i class="ti ti-close"></i> Cancelar</button>
									<button type="button" class="btn btn-primary"><i class="ti ti-check"></i> Agregar a Lista</button>
								</div>
							</div>
						</div>
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
				<table class="table table-shopping table-condensed">
					<thead>
						<tr>
							<th class="text-center">Código</th>
							<th class="text-left">Nombre del Producto</th>
							<th class="text-left">Marca</th>
							<th class="text-right">Ingresados</th>
							<th class="text-center">Motivo</th>
							<th class="text-center">Opciones</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								1700025568557
							</td>
							<td>
								<strong>Coca-Cola 600ml</strong>
							</td>
							<td>Coca-Cola</td>
							<td>
								52 <small>pz</small>
							</td>
							<td>
								Compra
							</td>
							<td>
								Cancelar
							</td>
						</tr>
						<tr>
							<td>
								1700024826557
							</td>
							<td>
								<strong>Coca-Cola 2lt</strong>
							</td>
							<td>Coca-Cola</td>
							<td>
								36 <small>pz</small>
							</td>
							<td>
								Compra
							</td>
							<td>
								Cancelar
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>

<?php $this->stop()?>