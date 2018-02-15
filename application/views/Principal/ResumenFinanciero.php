<?php $this->layout('Layout', ['title'=>'mSV::Resumen Financiero', 'sitepage'=>'Resumen Financiero'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12 form-inline">
		<input type="text" class="form-control" placeholder="Fecha Inicial">
		<input type="text" class="form-control" placeholder="Fecha Final">
		<button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Generar</button>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Resumen Financiero del día 01-Diciembre-2017 al 31-Diciembre-2017</h4>
			</div>
			<div class="card-content table-responsive table-full-width">
				<table class="table">
					<tbody>
							<tr class="success">
								<td>Ingresos</td>
								<td class="text-right">$9,523.00</td>
							</tr>
							<tr class="success">
								<td>- Costo de lo Vendido</td>
								<td class="text-right">$4,512.00</td>
							</tr>
							<tr class="warning">
								<td>Devoluciones</td>
								<td class="text-right">$125.00</td>
							</tr>
							<tr class="warning">
								<td>Gastos</td>
								<td class="text-right">$1,115.00</td>
							</tr>
							<tr class="warning">
								<td>Egresos Totales</td>
								<td class="text-right">$1,240.00</td>
							</tr>
							<tr class="success">
								<td>Ingresos - Egresos</td>
								<td class="text-right">$8,283.00</td>
							</tr>
							<tr class="success">
								<td>Utilidad</td>
								<td class="text-right">$4,999.00</td>
							</tr>
					</tbody>
				</table>
			</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Movimientos</h4>
				<p class="category">Descripción de movimientos en caja</p>
			</div>
			<div class="card-content">
				<div class="nav-tabs-navigation">
					<div class="nav-tabs-wrapper">
						<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
							<li class="active"><a href="#tabVentas" data-toggle="tab"><i class="ti ti-export"></i> Ventas</a></li>
							<li><a href="#tabProductos" data-toggle="tab"><i class="ti ti-clipboard"></i> Productos</a></li>
							<li><a href="#tabDevoluciones" data-toggle="tab"><i class="ti ti-import"></i> Devoluciones</a></li>
							<li><a href="#tabGastos" data-toggle="tab"><i class="ti ti-money"></i> Gastos</a></li>
						</ul>
					</div>
				</div>
				<div id="my-tab-content" class="tab-content text-center">
					<div class="tab-pane active" id="tabVentas">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">Ticket</th>
									<th class="text-center">Tipo de Pago</th>
									<th class="text-center">Total</th>
									<th class="text-center">Fecha</th>
									<th class="text-center">Hora</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>M030120181011123</td>
									<td>Efectivo</td>
									<td>$74.00</td>
									<td>30-Enero-2018</td>
									<td>10:12</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="tabProductos">
						<p>Here is your profile.</p>
					</div>
					<div class="tab-pane" id="tabDevoluciones">
						<p>Here is your profile.</p>
					</div>
					<div class="tab-pane" id="tabGastos">
						<p>Here are your messages.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('public/js/Principal/ResumenCaja.js') ?>"></script>
<?php $this->stop()?>