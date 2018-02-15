<?php $this->layout('Layout', ['title'=>'mSV::Detalle del Inventario', 'sitepage'=>'Detalle del Inventario'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-success text-center">
							<i class="ti-money"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Valor del Inventario</p>
							$49,824.50
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-warning text-center">
							<i class="ti-money"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Costo del Inventario</p>
							$36,124.00
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-info text-center">
							<i class="ti-wallet"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Utilidad(No gastos)</p>
							$19,589.00
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
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
							<p>Productos | Existencia</p>
							123|1,254
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
			<div class="card-content table-responsive table-full-width">
				<table class="table table-striped">
					<thead>
						<th>Producto</th>
						<th>Marca</th>
						<th>Existencia</th>
						<th>Costo</th>
						<th>Valor</th>
						<th>Utilidad</th>
					</thead>
					<tbody>
						<tr>
							<td>M&Ms</td>
							<td>Mars</td>
							<td>12 piezas</td>
							<td>$72.00</td>
							<td>$86.00</td>
							<td>$14.00</td>
						</tr>
						<tr>
							<td>M&Ms</td>
							<td>Mars</td>
							<td>12 piezas</td>
							<td>$72.00</td>
							<td>$86.00</td>
							<td>$14.00</td>
						</tr>
						<tr>
							<td>M&Ms</td>
							<td>Mars</td>
							<td>12 piezas</td>
							<td>$72.00</td>
							<td>$86.00</td>
							<td>$14.00</td>
						</tr>
					</tbody>
				</table>
			</div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
<?php $this->stop()?>