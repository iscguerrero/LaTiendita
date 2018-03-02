<?php $this->layout('Layout', ['title'=>'mSV::Detalle del Inventario', 'sitepage'=>'Detalle del Inventario'])?>
<?php $this->start('css')?>
	<style>
		.card .numbers {
    	font-size: 1.2em;
		}
	</style>
<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-5">
						<div class="icon-big icon-success text-center">
							<i class="ti-money"></i>
						</div>
					</div>
					<div class="col-xs-7">
						<div class="numbers">
							<p>Valor</p>
							<font id="valor"></font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-5">
						<div class="icon-big icon-warning text-center">
							<i class="ti-money"></i>
						</div>
					</div>
					<div class="col-xs-7">
						<div class="numbers">
							<p>Costo</p>
							<font id="costo"></font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-5">
						<div class="icon-big icon-info text-center">
							<i class="ti-wallet"></i>
						</div>
					</div>
					<div class="col-xs-7">
						<div class="numbers">
							<p>Utilidad</p>
							<font id="utilidad"></font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-info text-center">
							<i class="ti-agenda"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Existencia</p>
							<font id="existencia"></font>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Productos</h4>
				<p class="category">Detalle de la existencia del Inventario</p>
			</div>
			<div class="table-responsive">
				<table id="tablaProductos">
					<thead>
						<th>Producto</th>
						<th>Marca</th>
						<th>Existencia</th>
						<th>Costo</th>
						<th>Valor</th>
						<th>Utilidad</th>
					</thead>
				</table>
			</div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Inventarios/DetalleInventario.js') ?>"></script>
<?php $this->stop()?>