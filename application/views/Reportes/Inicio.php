<?php $this->layout('Layout', ['title'=>'mSV::Reportes', 'sitepage'=>'Reportes'])?>
<?php $this->start('css')?>
<style>
	.card .icon-big {
		font-size: 6em;
	}
</style>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-lg-3">
		<a href = "<?php echo base_url('Reportes/VentasDiarias') ?>">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-primary text-center">
								<i class="ti-stats-up"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Ventas Diarias</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-lg-3">
		<a href = "#">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-success text-center">
								<i class="ti-calendar"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Ventas Mensuales</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-lg-3">
		<a href = "#">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-info text-center">
								<i class="ti-files"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Comparativo de Ventas</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-lg-3">
		<a href = "#">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-warning text-center">
								<i class="ti-money"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Reporte de Gastos</div>
				</div>
			</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-3">
		<a href = "#">
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
					<div class="stats">Reporte de Devoluciones</div>
				</div>
			</div>
		</a>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
<?php $this->stop()?>