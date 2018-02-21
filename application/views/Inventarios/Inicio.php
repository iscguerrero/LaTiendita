<?php $this->layout('Layout', ['title'=>'mSV::Inventarios', 'sitepage'=>'Inventarios'])?>
<?php $this->start('css')?>
<style>
	.card .icon-big {
		font-size: 6em;
	}
</style>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8 col-md-offset-0 col-md-12 col-lg-offset-0 col-lg-12">
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/Producto') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-primary text-center">
									<i class="fa fa-plus-square"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Nuevo Producto</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/Productos') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-primary text-center">
									<i class="ti-clipboard"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Productos</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/IngresarProducto') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-success text-center">
									<i class="ti-import"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Ingresar Producto</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/EgresarProducto') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-danger text-center">
									<i class="ti-export"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Egresar Producto</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/HistorialIngresos') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-info text-center">
									<i class="ti-notepad"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Historial de Ingresos</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/HistorialEgresos') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-warning text-center">
									<i class="ti-notepad"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Historial de Egresos</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/DetalleInventario') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-primary text-center">
									<i class="ti-archive"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Detalle del Inventario</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<a href = "<?php echo base_url('Inventarios/MarcasDepartamentos') ?>">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div class="icon-big icon-success text-center">
									<i class="ti-list"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<hr />
						<div class="stats">Marcas y Departamentos</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
<?php $this->stop()?>