
<div class="row">
<div class="col-md-12">
	<form role="form" class="header_remito" action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
		<div class="col-md-6">
			<div class="form-group">
				<label for="exampleInputEmail1">Nro Remito</label>
				<input id="nro_remito" type="text" readonly="readonly" class="form-control" placeholder="Valor Automático" />
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Fecha</label>
				<input type="text" name="fecha" class="form-control required" id="fecha" placeholder="Ingrese Fecha" required="required" />
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Destino</label>
				<input type="text" id="destino" name="destino" class="form-control required" placeholder="Area de Destino" required="required">
			</div>
		</div>

		<div class="col-md-6">
			Observaciones
			<textarea id="observaciones" name="observaciones" class="form-control" rows="4"></textarea>
		</div>
		<button type="submit" name="remito_header" class="btn btn-default" style="float: right; margin: 35px 20px 0 0;width:130px;">OK</button>
	</form>


	<div class="col-md-12 title">

	</div>

	<table class="table  table-condensed">
		<tr>
			<th width="10%"><strong>ITEM</strong></th>
			<th width="70%"><strong>PRODUCTOS</strong></th>
			<th width="20%"><strong>CANTIDAD</strong></th>
		</tr>
		<tr>
			<td>1</td>
			<td>descripcion</td>
			<td>150</td>
		</tr>
		<tr>
			<td>2</td>
			<td>descripcion</td>
			<td>350</td>
		</tr>
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



