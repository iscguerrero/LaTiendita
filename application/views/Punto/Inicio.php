<?php $this->layout($_SESSION['cve_perfil'] == '001' ? '_Layout' : 'Layout', ['title'=>'mSV::Punto de Venta', 'sitepage'=>'Punto de Venta'])?>
<?php $this->start('css')?>

<?php $this->stop()?>
<?php $this->start('vista')?>
<div class="row">
	<div class="col-lg-6">
		<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-xs-6">
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
								<div class="col-xs-6">
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
							<div class="row">
								<div class="col-xs-12">
									<input type="text" placeholder="Buscar por código o nombre de producto" class="form-control">
								</div>
							</div>
						</div>
						<div class="table-responsive" style="height: 400px; overflow-y: scroll">
							<table class="table table-shopping">
								<thead>
									<tr>
										<th class="text-center"></th>
										<th></th>
										<th class="text-right">Existencia</th>
										<th class="text-right">Precio</th>
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
										<td class="text-right">
											52 <small>pz</small>
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
										<td class="text-right">
											24 <small>pz</small>
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
										<td class="text-right">
											17 <small>pz</small>
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
										<td class="text-right">
											36 <small>pz</small>
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
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Detalles de la venta</h4>
			</div>
			<div class="card-content table-responsive">
				<table class="table table-shopping">
					<thead>
							<tr>
								<th></th>
								<th class="text-right">Precio</th>
								<th class="text-center">Cantidad</th>
								<th class="text-right">Total</th>
								<th></th>
							</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Ciel 500 ml
							</td>
							<td class="text-right">
								<small>&dollar;</small> 10.00
							</td>
							<td class="text-center">
								<div class="btn-group">
									<button class="btn btn-sm"><i class="ti-minus"></i></button>
									<button class="btn btn-sm">2</button>
									<button class="btn btn-sm"><i class="ti-plus"></i></button>
								</div>
							</td>
							<td class="text-right">
								<small>&dollar;</small>20.00
							</td>
							<td><button class="btn btn-sm btn-warning" title="Remover item de la venta"><i class="fa fa-times"></i></button></td>
						</tr>
						<tr>
							<td>
								Ciel mineral 650 ml
							</td>
							<td class="text-right">
								<small>&dollar;</small> 12.00
							</td>
							<td class="text-center">
								<div class="btn-group">
									<button class="btn btn-sm"><i class="ti-minus"></i></button>
									<button class="btn btn-sm">1</button>
									<button class="btn btn-sm"><i class="ti-plus"></i></button>
								</div>
							</td>
							<td class="text-right">
								<small>&dollar;</small>12.00
							</td>
							<td><button class="btn btn-sm btn-warning" title="Remover item de la venta"><i class="fa fa-times"></i></button></td>
						</tr>
						<tr>
							<td>
								Sabritones
							</td>
							<td class="text-right">
								<small>&dollar;</small> 24.00
							</td>
							<td class="text-center">
								<div class="btn-group">
									<button class="btn btn-sm"><i class="ti-minus"></i></button>
									<button class="btn btn-sm">3</button>
									<button class="btn btn-sm"><i class="ti-plus"></i></button>
								</div>
							</td>
							<td class="text-right">
								<small>&dollar;</small>72.00
							</td>
							<td><button class="btn btn-sm btn-warning" title="Remover item de la venta"><i class="fa fa-times"></i></button></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3">Total</th>
							<th class="text-right"><small>&dollar;</small>104.00</th>
							<th></th>
						</tr>
						<tr>
							<td colspan="5">
								<div class="input-group pull-right">
									<input type="text" placeholder="Paga con..." class="form-control text-center">
									<span class="input-group-btn">
										<button class="btn btn-success">Completar</button>
									</span>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->stop()?>
<?php $this->start('js')?>

<?php $this->stop()?>