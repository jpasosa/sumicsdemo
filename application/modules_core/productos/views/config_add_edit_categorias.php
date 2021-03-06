
<?php $this->load->view('config'); ?>

<div class="col-md-12">
	<div class="col-md-2">
	</div>

	<div class="col-md-6">
		<?php if (!$error_message): ?>

		<?php else: ?>
			<!-- ERRORES DE VALIDACIÓN -->
			<?php foreach ($error_message as $em): ?>
					<div class="alert alert-error fade in add_edit_product" style="width: 420px;">
						<a class="close" data-dismiss="alert">×</a>
						<strong><?php echo $em; ?></strong>
					</div>
			<?php endforeach ?>
		<?php endif ?>
		<!-- CATEGORIA INSERTADA CON EXITO -->
		<?php if (isset($message_notice)): ?>
			<div class="alert alert-success fade in add_edit_product" style="width: 420px;" >
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php echo $message_notice; ?>
			</div>
		<?php endif; ?>
		<?php if ($section == 'productos.editar_categoria'): ?>
			<div class="alert alert-notice fade in add_edit_product" >
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php echo 'No es posible modificar el código por el momento.'; ?>
			</div>
		<?php endif; ?>
		<form class="add_edit_category" action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
			<div class="title"><?php echo $box_title; ?></div>
			<!-- CODIGO DEL ARTICULO-->
			<div class="codigo_abrev">
				<label>Código Abrevación:</label>
				<input type="text" name="codigo_abrev" <?php if (isset($no_edit) && $no_edit): echo 'readonly="readonly" '; endif; ?>
					value="<?php if($categoria['codigo_abrev'] != ''): echo $categoria['codigo_abrev']; endif; ?>">
			</div>
			<!-- DESCRIPCION -->
			<div class="nombre">
				<label>Nombre:</label>
				<input type="text" name="nombre" value="<?php if($categoria['nombre'] != ''): echo $categoria['nombre']; endif; ?>">
			</div>
			<input class="agregar" type="submit" value="AGREGAR" />
		</form>
	</div>

	<div class="col-md-4">
	</div>

</div>