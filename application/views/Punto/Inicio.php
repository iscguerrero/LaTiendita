<?php $this->layout($_SESSION['cve_perfil'] == '001' ? '_Layout' : 'Layout', ['title'=>'mSV::Punto de Venta', 'sitepage'=>'Punto de Venta'])?>
<?php $this->start('css')?>
	<link rel="stylesheet" href="<?php echo base_url('assets/js/extensions/editable/bootstrap-editable.css')?>">
<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-offet-1 col-md-10 col-lg-offset-2 col-lg-8">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Detalles de la venta</h4>
			</div>
			<div class="card-content table-responsive">
				<div class="row">
					<div class="col-xs-6">
						<form action="#" id="formCodigo">
							<input type="number" class="form-control" name="codigo" id="codigo" autofocus>
						</form>
					</div>
					<div class="col-xs-6">
						<input type="text" class="form-control" name="producto" id="producto" >
					</div>
				</div>
				<table class="table table-shopping" id="tablaProductos">
					<tfoot>
						<tr>
							<th colspan="3">Total</th>
							<th class="text-right"><small>&dollar;</small><strong id="total"></strong></th>
							<th></th>
						</tr>
						<tr>
							<td colspan="5">
								<div class="input-group pull-right">
									<span class="input-group-btn">
										<button type="button" class="btn btn-default" id="cancelar">Cancelar</button>
									</span>
									<input type="number" class="form-control text-right" name="efectivo" id="efectivo" placeholder="Paga con...">
									<span class="input-group-btn">
										<button type="button" class="btn btn-default" id="finalizar" >Finalizar</button>
									</span>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>
	<script src="<?php echo base_url('assets/js/bootstrap-table.js')?>"></script>
	<script src="<?php echo base_url('assets/js/locale/bootstrap-table-es-MX.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/extensions/editable/bootstrap-table-editable.min.js')?>"></script>
		<script src="<?php echo base_url('assets/js/extensions/editable/bootstrap-editable.js')?>"></script>
	<script src="<?php echo base_url('public/js/Punto/Inicio.js') ?>"></script>
<?php $this->stop()?>