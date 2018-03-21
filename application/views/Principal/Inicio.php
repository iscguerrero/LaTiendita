<?php $this->layout($_SESSION['cve_perfil'] == '001' ? '_Layout' : 'Layout', ['title'=>'mSV::Principal', 'sitepage'=>'Principal'])?>
<?php $this->start('css')?>
<style>
	.card .icon-big {
		font-size: 6em;
	}
</style>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "#" id="aAbrirCaja">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-success text-center">
								<i class="ti-unlock"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Abrir Caja</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "#" id="aCerrarCaja">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-default text-center">
								<i class="ti-lock"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Cerrar Caja</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "<?php echo base_url('Principal/HistoriaCaja') ?>">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-info text-center">
								<i class="ti-agenda"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Historia de Caja</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "#" id="aNuevoGasto">
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
					<div class="stats">Gastos</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "<?php echo base_url('Principal/Devoluciones') ?>">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-danger text-center">
								<i class="ti-import"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Devoluciones</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "<?php echo base_url('Principal/ResumenFinanciero') ?>">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-primary text-center">
								<i class="ti-list"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Resumen Financiero</div>
				</div>
			</div>
		</a>
	</div>
	<!--div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
		<a href = "<?php echo base_url('Principal/Proveedores') ?>">
			<div class="card">
				<div class="card-content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div class="icon-big icon-warning text-center">
								<i class="ti-truck"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-center">
					<hr />
					<div class="stats">Proveedores</div>
				</div>
			</div>
		</a>
	</div-->
</div>

<!-- Modal para abrir la caja -->
<div id="modalAbrirCaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="ti ti-unlock"></i> Abrir Caja</h4>
			</div>
			<form id="formAbrirCaja">
				<div class="modal-body">
					<div class="form-group">
						<label>Importe</label>
						<input type="text" class="form-control text-right" name="apertura" id="apertura" placeholder="Ingrese importe de apertura de caja" required >
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-12 pull-right">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti ti-close"></i> Cancelar</button>
							<button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Confirmar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para cerrar la caja -->
<div id="modalCerrarCaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="ti ti-lock"></i> Cerrar Caja</h4>
			</div>
			<form id="formCerrarCaja">
				<div class="modal-body">
					<div class="form-group">
						<label>Importe</label>
						<input type="text" class="form-control text-right" name="cierre" id="cierre" placeholder="Ingrese importe de cierre de caja" required>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-12 pull-right">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti ti-close"></i> Cancelar</button>
							<button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Confirmar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para cerrar la caja -->
<div id="modalGasto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="ti ti-money"></i> Nuevo Gasto</h4>
			</div>
			<form id="formGasto">
				<div class="modal-body">
					<div class="form-group">
						<label>Importe</label>
						<input type="text" class="form-control text-right" name="importe" id="importe" placeholder="Ingrese importe del gasto" required>
					</div>
					<div class="form-group">
						<label>Tipo de gasto</label>
						<select class="form-control" name="tipos" id="tipos" required ></select>
					</div>
					<div class="form-group">
						<label>Descripción</label>
						<textarea class="form-control" name="comentarios" id="comentarios" rows="3" placeholder="Ingrese a detalle el motivo del gasto" required oninvalid="this.setCustomValidity('Ingresa una pequeña descripción del gasto')" oninput="setCustomValidity('')"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-12 pull-right">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti ti-close"></i> Cancelar</button>
							<button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Confirmar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('public/js/Principal/Inicio.js') ?>"></script>
<?php $this->stop()?>