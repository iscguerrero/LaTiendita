<?php $this->layout('Layout', ['title'=>'mSV::Escritorio', 'sitepage'=>'Escritorio'])?>
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
							<i class="ti-export"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Ventas</p>
							$9,824.50
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i> 502 artículos
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
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
							$74.50
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i> 3 artículos
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
							<i class="ti-wallet"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Gastos</p>
							$512.00
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i> 2 gastos
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
							<i class="ti-shopping-cart-full"></i>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="numbers">
							<p>Ingresos</p>
							$6,542.00
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<hr />
				<div class="stats">
					<i class="ti-package"></i> 203 artículos
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col-xs-7">
						<div class="numbers pull-left">
							$9,750.00
						</div>
					</div>
					<div class="col-xs-5">
						<div class="pull-right">
							<span class="label label-success">
								499 artículos
							</span>
						</div>
					</div>
				</div>
				<h6 class="big-title"><span class="text-muted">Ventas por Hora en el Día</span></div>
				<div id="horas"></div>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-7">
							<div class="numbers pull-left">
								$68,250.00
							</div>
						</div>
						<div class="col-xs-5">
							<div class="pull-right">
								<span class="label label-success">
									3493 artículos
								</span>
							</div>
						</div>
					</div>
					<h6 class="big-title"><span class="text-muted">Ventas diarías del mes de Enero</span></div>
					<div id="mes"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-7">
							<div class="numbers pull-left">
								$68,250.00
							</div>
						</div>
						<div class="col-xs-5">
							<div class="pull-right">
								<span class="label label-success">
									3493 artículos
								</span>
							</div>
						</div>
					</div>
					<h6 class="big-title"><span class="text-muted">Ventas mensuales del año 2018</span></div>
					<div id="anio"></div>
				</div>
			</div>
		</div>
	</div>
<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('assets/js/chartist.min.js') ?>"></script>
<script>
	var optionsPrice = {
		showPoint: true,
		lineSmooth: true,
		height: "210px",
		axisX: {
			showGrid: true,
			showLabel: true
		},
		axisY: {
			offset: 40,
			showGrid: true
		},
		low: 0,
		high: 'auto',
				classNames: {
					line: 'ct-line ct-green'
			}
	};

	var dataPrice = {
		labels: ['09:00','10:00','11:00', '12:00', '13:00', '14:00', '15:00'],
		series: [
			[230, 340, 400, 3300, 1254.5, 3500, 800]
		]
	};
	var datames = {
		labels: ['01', '02', '03', '04', '05', '06'],
		series: [
			[13123, 10110, 8745, 13852, 14698, 7722]
		]
	};
	var dataanio = {
		labels: ['Enero'],
		series: [
			[68250]
		]
	};

	Chartist.Line('#horas', dataPrice, optionsPrice);
	Chartist.Line('#mes', datames, optionsPrice);
	Chartist.Line('#anio', dataanio, optionsPrice);

</script>
<?php $this->stop()?>