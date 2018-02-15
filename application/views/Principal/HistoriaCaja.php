<?php $this->layout('Layout', ['title'=>'mSV::Historia de Caja', 'sitepage'=>'Historia de Caja'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar">
				</div>
				<table id="tHistoriaCaja" class="table">
					<thead>
						<th data-field="empleado">Empleado</th>
						<th data-field="salary" data-align="center">Fecha de Apertura</th>
						<th data-field="country" data-align="center">Hora de Apertura</th>
						<th data-field="city" data-align="right">Monto de Apertura</th>
						<th data-field="salary" data-align="center">Fecha de Cierre</th>
						<th data-field="country" data-align="center">Hora de Cierre</th>
						<th data-field="city" data-align="right">Monto de Cierre</th>
					</thead>
						<tbody>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
							</tr>
							<tr>
								<td>Cajero</td>
								<td>04-Enero-2018</td>
								<td>08:02 am</td>
								<td>$513.50</td>
								<td>04-Enero-2018</td>
								<td>07:59 pm</td>
								<td>$8456.50</td>
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
<script src="<?php echo base_url('public/js/Principal/HistoriaCaja.js') ?>"></script>
<?php $this->stop()?>