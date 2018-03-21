<?php $this->layout('Layout', ['title'=>'mSV::Escritorio', 'sitepage'=>'Escritorio'])?>
<?php $this->start('css')?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/morris.css') ?>">
<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-4 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-success text-center">
							<i class="ti-export"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Ventas</p>
							<font id="ventas"></font>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i>
					<font id="piezasVentas"></font> artículos
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-4 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-danger text-center">
							<i class="ti-import"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Devoluciones</p>
							<font id="devoluciones"></font>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i>
					<font id="piezasDevoluciones"></font> artículos
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-4 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-warning text-center">
							<i class="ti-wallet"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Gastos</p>
							<font id="gastos"></font>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i>
					<font id="piezasGastos"></font> gastos
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-0 col-xs-6 col-sm-4 col-md-4 col-lg-3">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-4">
						<div class="icon-big icon-info text-center">
							<i class="ti-shopping-cart-full"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Ingresos</p>
							<font id="ingresos"></font>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i>
					<font id="piezasIngresos"></font> artículos
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-content">
		<div class="numbers pull-left">
			<font id="totalVentasDia"></font>
		</div>
		<div class="pull-right">
			<span class="label label-success">
				<font id="piezasVentaDia"></font> artículos
			</span>
		</div>
		<h6 class="big-title">
			<span class="text-muted">Ventas por Hora en el Día</span>
		</h6>
		<div id="horas"></div>
	</div>
</div>
<div class="card">
	<div class="card-content">
		<div class="numbers pull-left">
			<font id="totalVentasMes"></font>
		</div>
		<div class="pull-right">
			<span class="label label-success">
				<font id="piezasVentaMes"></font> artículos
			</span>
		</div>
		<h6 class="big-title">
			<span class="text-muted">Ventas diarías del mes de Enero</span>
		</h6>
		<div id="mes"></div>
	</div>
</div>
<div class="card">
	<div class="card-content">
		<div class="numbers pull-left">
			<font id="totalVentasAnio"></font>
		</div>
		<div class="pull-right">
			<span class="label label-success">
				<font id="piezasVentaAnio"></font> artículos
			</span>
		</div>
		<h6 class="big-title">
			<span class="text-muted">Ventas mensuales del año
				<script>document.write(new Date().getFullYear())</script>
			</span>
		</h6>
		<div id="anio"></div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/morris.min.js') ?>"></script>
	<script src="<?php echo base_url('public/js/Escritorio/Inicio.js') ?>"></script>
<?php $this->stop()?>