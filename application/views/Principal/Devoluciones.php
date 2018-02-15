<?php $this->layout('Layout', ['title'=>'mSV::Devoluciones', 'sitepage'=>'Devoluciones'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar">
				</div>
				<table id="tDevoluciones" class="table">
					<thead>
						<th data-field="empleado">Ticket</th>
						<th data-field="salary">Producto</th>
						<th data-field="country" data-align="right">Precio Unitario</th>
						<th data-field="city" data-align="right">Cantidad</th>
						<th data-field="salarsy" data-align="right">Subtotal</th>
						<th data-field="devueltos" data-align="right">Devueltos</th>
						<th data-field="accion" data-align="center">Accion</th>
					</thead>
						<tbody>
							<tr>
								<td>M20170104125675</td>
								<td>Pepsi 2lt</td>
								<td>$17.50</td>
								<td>1</td>
								<td>$17.50</td>
								<td>1</td>
								<td>Confirmar</td>
							</tr>
							<tr>
								<td>M20170104125675</td>
								<td>Pepsi 1lt</td>
								<td>$12.50</td>
								<td>1</td>
								<td>$12.50</td>
								<td>1</td>
								<td>Confirmar</td>
							</tr>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('public/js/Principal/Devoluciones.js') ?>"></script>
<?php $this->stop()?>