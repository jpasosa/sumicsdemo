<?php if (isset($message_error)): ?>
<?php endif; ?>

<div class="col-md-2">
</div>

<div class="col-md-6">

	<?php if (!$error_message): ?>

	<?php else: ?>
		<?php foreach ($error_message as $em): ?>
				<div class="alert alert-error fade in add_edit_product">
					<a class="close" data-dismiss="alert">×</a>
					<strong><?php echo $em; ?></strong>
				</div>
		<?php endforeach ?>
	<?php endif ?>

	<?php if (isset($message_notice)): ?>
		<div class="alert alert-success fade in add_edit_product" >
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php echo $message_notice; ?>
		</div>
	<?php endif; ?>



	<?php if ($section == 'productos.editar'): ?>
		<div class="alert alert-notice fade in add_edit_product" >
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php echo 'No es posible editar el código.'; ?>
		</div>
	<?php endif ?>



	<div class="inner-content new_article">
		<div class="box_new_article">
			<div class="title">
				<?php if ($section == 'productos.editar'): ?>
					EDICIÓN DEL PRODUCTO
				<?php else: ?>
					ALTA DEL PRODUCTO
				<?php endif; ?>
			</div>
			<form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
				<div class="image_top">
					<img src="<?php echo ASSETS . 'frontend/images/alta_productos.png'; ?>" width="198" height="114" alt="alta" />
					<!-- CODIGO DEL ARTICULO-->
					<div class="code">
						<label>Código (*)</label>
						<input type="text" name="codigo"
							value="<?php if($product['codigo'] != ''): echo $product['codigo']; else: echo 'Valor automático'; endif; ?>" readonly="readonly">
					</div>
					<!-- DESCRIPCION -->
					<div class="descripcion">
						<label>Descripción (*)</label>
						<input type="text" name="descripcion" value="<?php if($product['descripcion'] != ''): echo $product['descripcion']; endif; ?>">
					</div>
				</div>
				<div class="bottom">
					<div class="detalle"> <!-- DESCRIPCION DEL ARTICULO -->
						<label>Detalle (*)</label>
						<input type="text" name="detalle" value="<?php if($product['detalle'] != ''): echo $product['detalle']; endif; ?>">
					</div>

					<div class="observaciones"> <!-- REFERENCIA DEL ARTICULO -->
						<label>Observaciones</label>
						<textarea name="observaciones"><?php if($product['observaciones'] != ''): echo $product['observaciones']; endif; ?></textarea>
					</div>

					<div class="categoria"> <!-- CATEGORIA DEL ARTICULO -->
						<label>Categoría:</label>
						<select name="id_categorias">
							<?php foreach ($categorys AS $cat): ?>
								<option value="<?php echo $cat['id_categorias']; ?>"
									<?php if ($cat['id_categorias'] == $product['id_categorias']): echo " selected='selected' "; endif; ?> >
									<?php echo $cat['nombre'] . ' (<span style="font-weight: bold;">' . $cat['codigo_abrev'] . '</span>)'; ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<input class="agregar" type="submit" value="AGREGAR" />
			</form>
		</div> <!-- cierro box_new_article -->
	</div> <!-- cierro inner-content new_article -->
</div>

<div class="col-md-4">
</div>






