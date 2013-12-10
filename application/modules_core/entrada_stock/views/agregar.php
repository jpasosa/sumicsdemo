<?php if (!$error_message): ?>

<?php else: ?>
	<?php foreach ($error_message as $em): ?>
			<?php echo $em; ?>
	<?php endforeach ?>
<?php endif ?>

<?php if (isset($message_error)): ?>
		<?php echo $message_error; ?>
<?php endif ?>

<?php if (isset($message_notice)): ?>
		<?php echo $message_notice; ?>
<?php endif ?>

<div class="inner-content new_article">
	<div class="box_new_article">
		<div class="title">
				INGRESO AL STOCK
		</div>
		<form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
			<div class="bottom">
				<div class="fecha"> <!-- CODIGO DEL ARTICULO-->
					<label>Fecha</label>
					<input type="text" name="fecha" value="">
				</div>
				<div class="categoria"> <!-- CATEGORIA DEL ARTICULO -->
					<label>Seleccionar Producto:</label>
					<select name="id_productos">
						<?php foreach ($products AS $prod): ?>
							<option value="<?php echo $prod['id_productos']; ?>">
								<?php echo $prod['descripcion'] . ' (<span style="font-weight: bold;">' . $prod['codigo'] . '</span>)'; ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="tipodocumento"> <!-- CATEGORIA DEL ARTICULO -->
					<label>Tipo de Documento:</label>
					<select name="tipo_documentos">
						<?php foreach ($tipo_documentos AS $doc): ?>
							<option value="<?php echo $doc['id_tipodocumentos']; ?>">
								<?php echo $doc['nombre']; ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="nro_tipo_documento"> <!-- CODIGO DEL ARTICULO-->
					<label>Número del Tipo de Documento</label>
					<input type="text" name="nro_tipo_documento" value="">
				</div>
				<!-- DESCRIPCION -->
				<div class="precio">
					<label>Precio:</label>
					<input type="text" name="precio" >
				</div>

				<div class="cantidad"> <!-- DESCRIPCION DEL ARTICULO -->
					<label>Cantidad:</label>
					<input type="text" name="cantidad" value="">
				</div>

				<div class="observaciones"> <!-- REFERENCIA DEL ARTICULO -->
					<label>Observaciones:</label>
					<textarea name="observaciones"></textarea>
				</div>


			</div>
			<input class="agregar" type="submit" value="INGRESAR al STOCK" />
		</form>
	</div> <!-- cierro box_new_article -->
</div> <!-- cierro inner-content new_article -->




