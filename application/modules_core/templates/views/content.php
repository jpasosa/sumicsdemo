
<div class="content" id="<?php echo $id_content; ?>">
	<div class="col-md-1">
		<div class="left" id="<?php echo $id_menu_left; ?>">
			<?php $this->load->view($view_menu_izq); ?>
		</div>
	</div>
	<div class="col-md-11">
		<div id="right">
			<?php $this->load->view($view_template); ?>
		</div>
	</div>
</div>