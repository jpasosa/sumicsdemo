
<?php $this->load->view('config'); ?>

<div class="col-md-12">
	<div class="col-md-2">
	</div>

	<div class="col-md-6">
		<form class="config_page" action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" >
			<div class="title"><?php echo $box_title; ?></div>
			<div class="cant_items">
				<label>items por página:</label>
				<input type="text" name="cant_items" value="<?php echo $cant_items; ?>">
			</div>
			<input class="agregar" type="submit" value="OK" />
		</form>
	</div>

	<div class="col-md-4">
	</div>

</div>