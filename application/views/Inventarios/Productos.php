<?php $this->layout('Layout', ['title'=>'mSV::Productos', 'sitepage'=>'Productos'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-lg-12 form-inline">
		<div class="form-group">
			<select multiple title="Secciones" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7">
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
			<select multiple title="Marcas" class="selectpicker" data-style="btn-success btn-fill btn-block" data-size="7">
				<option value="ARS">Coca-Cola</option>
				<option value="AUD">Sabritas</option>
				<option value="BRL">Barcel</option>
				<option value="CAD">Pepsi</option>
				<option value="CHF">Gamesa</option>
				<option value="CNY">Bimbo</option>
			</select>
		</div>
		<div class="checkbox">
			<input id="checkbox1" type="checkbox" checked>
			<label for="checkbox1">Vigentes</label>
		</div>
		<div class="checkbox">
			<input id="checkbox1" type="checkbox">
			<label for="checkbox1">Descontinuados</label>
		</div>
		<div class="form-group">
			<input type="text" placeholder="Buscar por código o nombre de producto" class="form-control">
		</div>
		<button type="button" class="btn btn-primary"><i class="ti ti-check"></i> Buscar</button>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
				<div class="col-md-12">
					<div class="card card-plain">
						<div class="card-header">
							
						</div>
						<div class="table-responsive">
							<table class="table table-shopping">
								<thead>
									<tr>
										<th class="text-center"></th>
										<th></th>
										<th>Marca</th>
										<th class="text-right">Existencia</th>
										<th class="text-right">Costo Promedio</th>
										<th class="text-right">Precio Actual</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="img-container">
												<img src="<?php echo base_url('assets/img/tables/agenda.png') ?>" alt="Agenda">
											</div>
										</td>
										<td>
											<strong>Coca-Cola 600ml</strong>
										</td>
										<td>Coca-Cola</td>
										<td class="text-right">
											52 <small>pz</small>
										</td>
										<td class="text-right">
											<small>&dollar;</small> 10.50
										</td>
										<td class="text-right">
											<small>&dollar;</small> 13.00
										</td>
									</tr>
									<tr>
										<td>
											<div class="img-container">
												<img src="<?php echo base_url('assets/img/tables/agenda.png') ?>" alt="Agenda">
											</div>
										</td>
										<td>
											<strong>Coca-Cola 2lt</strong>
										</td>
										<td>Coca-Cola</td>
										<td class="text-right">
											24 <small>pz</small>
										</td>
										<td class="text-right">
											<small>&dollar;</small> 22.00
										</td>
										<td class="text-right">
											<small>&dollar;</small> 25.00
										</td>
									</tr>
									<tr>
										<td>
											<div class="img-container">
												<img src="<?php echo base_url('assets/img/tables/agenda.png') ?>" alt="Agenda">
											</div>
										</td>
										<td>
											<strong>Coca-Cola 3lt</strong>
										</td>
										<td>Coca-Cola</td>
										<td class="text-right">
											17 <small>pz</small>
										</td>
										<td class="text-right">
											<small>&dollar;</small> 28.00
										</td>
										<td class="text-right">
											<small>&dollar;</small> 32.00
										</td>
									</tr>
									<tr>
										<td>
											<div class="img-container">
												<img src="<?php echo base_url('assets/img/tables/agenda.png') ?>" alt="Agenda">
											</div>
										</td>
										<td>
											<strong>Coca-Cola 450ml</strong>
										</td>
										<td>Coca-Cola</td>
										<td class="text-right">
											36 <small>pz</small>
										</td>
										<td class="text-right">
											<small>&dollar;</small> 5.50
										</td>
										<td class="text-right">
											<small>&dollar;</small> 8.00
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>

<?php $this->stop()?>