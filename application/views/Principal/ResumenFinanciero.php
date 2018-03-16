<?php $this->layout('Layout', ['title'=>'mSV::Resumen Financiero', 'sitepage'=>'Resumen Financiero'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="card">
	<div class="card-content">
		<div class="row">
			<div class="col-xs-12">
				<form id="formParametros" class="form-inline">
					<input style="width: 180px; display: initial;" type="text" class="form-control datepicker text-center" name="fi" id="fi" placeholder="Fecha Inicial">
					<input style="width: 180px; display: initial;" type="text" class="form-control datepicker text-center" name="ff" id="ff" placeholder="Fecha Final">
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Generar</button>
				</form>
			</div>
		</div>
		<table class="table">
			<thead>
				<tr>
					<td></td>
					<td style="width: 120px"></td>
					<td style="width: 120px"></td>
				</tr>
			</thead>
			<tbody>
					<tr class="success">
						<td>Ingresos(Ventas)</td>
						<td class="text-right"></td>
						<td class="text-right" id="ingresos">$0.00</td>
					</tr>
					<tr class="success">
						<td>&nbsp;&nbsp;&nbsp;- Costo de lo Vendido</td>
						<td class="text-right"></td>
						<td class="text-right" id="costo">$0.00</td>
					</tr>
					<tr class="success">
						<td>&nbsp;&nbsp;&nbsp;+ Fondo de Caja</td>
						<td class="text-right"></td>
						<td class="text-right" id="caja">$0.00</td>
					</tr>
					<tr class="success">
						<td>= Utilidad Bruta</td>
						<td class="text-right"></td>
						<td class="text-right" id="utilidadbruta">$0.00</td>
					</tr>
					<tr class="warning">
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Devoluciones</td>
						<td class="text-right" id="devoluciones">$0.00</td>
						<td class="text-right"></td>
					</tr>
					<tr class="warning">
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gastos</td>
						<td class="text-right" id="gastos">$0.00</td>
						<td class="text-right"></td>
					</tr>
					<tr class="warning">
						<td>&nbsp;&nbsp;&nbsp;- Egresos Totales</td>
						<td class="text-right"></td>
						<td class="text-right" id="egresos">$0.00</td>
					</tr>
					<tr class="success">
						<td>= Utilidad</td>
						<td class="text-right"></td>
						<td class="text-right" id="utilidad">$0.00</td>
					</tr>
			</tbody>
		</table>
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
							<li><a href="#tabGastos" data-toggle="tab"><i class="ti ti-money"></i> Gastos</a></li>
						</ul>
					</div>
				</div>
				<div id="my-tab-content" class="tab-content text-center">
					<div class="tab-pane active" id="tabVentas">
						<table id="rventas">
						</table>
					</div>
					<div class="tab-pane" id="tabGastos">
						<table id="rgastos">
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('public/js/Principal/ResumenFinanciero.js') ?>"></script>
<?php $this->stop()?>