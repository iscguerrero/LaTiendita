<?php $this->layout('Layout', ['title'=>'mSV::Ventas Diarias', 'sitepage'=>'Ventas Diarias'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Ventas Diarias</h4>
			</div>
			<form id="formBuscar">
				<div class="card-content">
					<div class="row">
						<div class="col-lg-offset-1 col-xs-10">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label for="">Departamentos</label>
										<select multiple title="Departamentos" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7">
											<option value="ARS">Botána</option>
											<option value="AUD">Vinos y licores</option>
											<option value="BRL">Dulces</option>
											<option value="CAD">Abarrotes</option>
											<option value="CHF">Cerveza</option>
											<option value="CNY">Aguas y Refrescos</option>
											<option value="CZK">Servicios</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Productos</label>
										<select multiple title="Productos" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7">
											<option value="ARS">Coca-Cola 600ml</option>
											<option value="AUD">Rancheritos 50gr</option>
											<option value="BRL">Takis 50gr</option>
											<option value="CAD">Pepsi 2lt</option>
											<option value="CHF">Emperador 125gr</option>
											<option value="CNY">Mantecadas 100gr</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Marcas</label>
										<select multiple title="Marcas" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7">
											<option value="ARS">Coca-Cola</option>
											<option value="AUD">Sabritas</option>
											<option value="BRL">Barcel</option>
											<option value="CAD">Pepsi</option>
											<option value="CHF">Gamesa</option>
											<option value="CNY">Bimbo</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="">Mes</label>
										<select class="form-control" name="" id="">
											<option value="">Enero</option>
											<option value="">Febrero</option>
											<option value="">Marzo</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Año</label>
										<select class="form-control" name="" id="">
											<option value="">2017</option>
											<option value="" selected>2018</option>
											<option value="">2019</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
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
		labels: ['01','02','03', '04', '05', '06', '07'],
		series: [
			[230, 340, 400, 3300, 1254.5, 3500, 800]
		]
	};

	Chartist.Line('#horas', dataPrice, optionsPrice);

</script>
<?php $this->stop()?>