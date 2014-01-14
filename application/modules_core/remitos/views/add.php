
<div class="row">
<div class="col-md-12">
	<?php foreach ($error_message as $em): ?>
		<div class="alert alert-error fade in add_edit_product">
			<a class="close" data-dismiss="alert">×</a>
			<strong><?php echo $em; ?></strong>
		</div>
	<?php endforeach; ?>
	<form role="form" class="header_remito" action="<?php echo $form_action; ?>" method="post"
		enctype="multipart/form-data" style="<?php if ($oculto_header == 1): echo "display: none;"; endif; ?>">
		<div class="col-md-6">
			<div class="form-group">
				<label for="exampleInputEmail1">Nro Remito</label>
				<input id="nro_remito" type="text" readonly="readonly" class="form-control" placeholder="Valor Automático" />
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Fecha</label>
				<input type="text" name="fecha" value="<?php echo $remito_header['fecha']; ?>" class="form-control required" id="fecha" placeholder="Ingrese Fecha" required="required" />
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Destino</label>
				<input type="text" id="destino" name="destino" value="<?php echo $remito_header['destino']; ?>" class="form-control required" placeholder="Area de Destino" required="required">
			</div>
		</div>

		<div class="col-md-6">
			Observaciones
			<textarea id="observaciones" name="observaciones" class="form-control" rows="4"><?php echo $remito_header['observaciones']; ?></textarea>
		</div>
		<button type="submit" id="button_header" name="remito_header" class="btn btn-default" style="float: right; margin: 35px 20px 0 0;width:130px;">OK</button>
	</form>


	<div class="col-md-12 title">

	</div>

	<div class="col-md-6"></div>
		<?php if ($oculto_header == 1): ?>
			<span id="mostrar_header" title="Ocultar Encabezado" class="glyphicon glyphicon-chevron-down"></span>
		<?php else: ?>
			<span id="ocultar_header" title="Ocultar Encabezado" class="glyphicon glyphicon-chevron-up"></span>
		<?php endif; ?>

		<div class="col-md-6"></div>

	<table class="table  table-condensed">
		<tr>
			<th width="10%"><strong>ITEM</strong></th>
			<th width="70%"><strong>PRODUCTOS</strong></th>
			<th width="20%"><strong>CANTIDAD</strong></th>
		</tr>

		<?php if (count($items) > 0): ?>
			<?php foreach ($items AS $k => $it): ?>
				<tr>
					<td><?php echo $k+1; ?></td>
					<td><?php echo $it['codigo'] . ' :: ' . $it['descripcion'] . ' :: ' . $it['detalle']; ?></td>
					<td><?php echo $it['cantidad']; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>


		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<form role="form" action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
		<input type="hidden" id="oculto_header" name="oculto_header" value="<?php echo $oculto_header ?>">
		<div class="items">
			<div class="col-md-12">
				<div class="col-md-4">
				</div>
				<div class="col-md-6">
					<select name="producto" class="chzn-select form-control" id="producto" placeholder="Seleccionar Producto" required="required">
						<option value=""> Seleccione Producto. . .</option>
						<?php foreach ($productos AS $prod): ?>
							<option value="<?php echo $prod['id_productos']; ?>" >
								<?php echo ' ' . $prod['descripcion'] . ' :: ' . $prod['detalle'] . ' :: ' . $prod['codigo']; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<input type="text" name="cantidad" id="cantidad" class="form-control required input-sm" placeholder="Cantidad" required="required">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-10">
				</div>
				<div class="col-md-2">
					<button type="submit" name="agregar" id="agregar" class="btn btn-default" >Agregar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">

</div>


</div>



