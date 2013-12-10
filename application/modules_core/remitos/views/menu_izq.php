

<a href="javascript:history.back()">
	<img class="back" alt="volver atras" title="Volver atrás" width="85" height="85"
		src="<?php echo ASSETS . 'frontend/images/icons/go_back.png'; ?>"  />
</a>

<?php if ( isset($show_add) && $show_add): ?>
	<a href="<?php echo site_url('productos/add');?>">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/add.png'; ?>" alt="listar" title="Agregar Productos" width="85" height="85" />
	</a>
<?php endif; ?>

<?php if ( isset($show_list) && $show_list ): ?>
	<a href="<?php echo site_url('productos/listar');?>">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/list.png'; ?>" alt="listar" title="Listar Productos" width="85" height="85" />
	</a>
<?php endif;?>

<?php if (isset($configure_link)): ?>
	<a href="<?php echo site_url($configure_link);?>">
		<img class="back" src="<?php echo ASSETS . 'frontend/images/icons/configure.png'; ?>" alt="configurar" title="<?php echo $configure_link_title ?>" width="85" height="85" />
	</a>
<?php endif ?>

