<?php $this->layout('Layout', ['title'=>'mSV::Proveedores', 'sitepage'=>'Proveedores'])?>
<?php $this->start('css')?>
<?php $this->stop()?>
<?php $this->start('vista')?>

<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-content">
				<div class="toolbar">
					<button type="button" id="btnAltaProveedor" class="btn btn-primary" title="Crear nuevo proveedor"><i class="fa fa-plus"></i> Nuevo</button>
					<button type="button" class="btn btn-warning" title="Editar el proveedor seleccionado"><i class="fa fa-edit"></i> Editar</button>
				</div>
				<table id="tProveedores" class="table">
					<thead>
						<th data-field="empleado">Nombre de la Empresa</th>
						<th data-field="salary">Contactos</th>
						<th data-field="country" data-align="center">Teléfono</th>
						<th data-field="city" data-align="center">Celular</th>
						<th data-field="salarsy">Correo</th>
						<th data-field="devueltos">Dirección</th>
						<th data-field="accion">Observaciones</th>
					</thead>
						<tbody>
							<tr>
								<td>G&O Consultora</td>
								<td>Diego Guerrero Gudiño</td>
								<td>(442) 112 1478</td>
								<td>(442) 113 2036</td>
								<td>isc.guerrero@cando.com.mx</td>
								<td>Corregidora Nte 39 Qro Qro</td>
								<td>Proveedores de Servicios</td>
							</tr>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="modalProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="ti ti-truck"></i> Proveedor</h4>
			</div>
			<form id="formProveedor">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nombre de la Empresa</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Contacto</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Teléfono</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Celular</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Correo</label>
								<input type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Dirección</label>
								<textarea class="form-control" name="" id="" rows="2"></textarea>
							</div>
							<div class="form-group">
								<label>Observaciones</label>
								<textarea class="form-control" name="" id="" rows="2"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-xs-12 pull-right">
						<button type="submit" class="btn btn-default"><i class="ti ti-close"></i> Cancelar</button>
							<button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Guardar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->stop()?>
<?php $this->start('js')?>
<script src="<?php echo base_url('assets/js/bootstrap-table.js') ?>"></script>
<script src="<?php echo base_url('public/js/Principal/Proveedores.js') ?>"></script>
<?php $this->stop()?>