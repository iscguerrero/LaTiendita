<?php $this->layout('Layout', ['title'=>'mSV::Historial de Egresos', 'sitepage'=>'Historial de Egresos'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-lg-12 form-inline">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Fecha Inicial">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Fecha Final">
		</div>
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
										<th>Fecha</th>
										<th>Código</th>
										<th>Descripción del Producto</th>
										<th>Marca</th>
										<th>Costo Registrado</th>
										<th>Precio Registrado</th>
										<th>Cantidad</th>
										<th>Motivo</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>02-Enero-2017</td>
										<td>1705687465744</td>
										<td><strong>Coca-Cola 600ml</strong></td>
										<td>Coca-Cola</td>
										<td>
											<small>&dollar;</small> 8.50
										</td>
										<td>
											<small>&dollar;</small> 13.00
										</td>
										<td>
											52 <small>pz</small>
										</td>
										<td>Venta</td>
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