

<a href="javascript:history.back()">
	<img class="back" src="<?php echo ASSETS . 'frontend/images/icons/go_back.png'; ?>"alt="volver atras" title="Volver atrás" width="85" height="85" />
</a>

<?php if ( isset($show_add) && $show_add): ?>
	<a href="<?php echo site_url('entrada_stock/nueva_entrada/add');?>">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/add.png'; ?>" alt="listar" title="Agregar Entradas al Stock" width="85" height="85" />
	</a>
<?php endif; ?>

<?php if ( isset($show_list) && $show_list ): ?>
	<a href="<?php echo site_url('entrada_stock/nueva_entrada');?>">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/list.png'; ?>" alt="listar" title="Listar las Entradas al Stock" width="85" height="85" />
	</a>
<?php endif; ?>

<?php if (isset($configure_link) && $configure_link): ?>
	<a href="<?php echo site_url('entrada_stock/config');?>">
		<img class="back" src="<?php echo ASSETS . 'frontend/images/icons/configure.png'; ?>" alt="configurar"
			title="Configuraciones de Entradas de Stock" width="85" height="85" />
	</a>
<?php endif; ?>

