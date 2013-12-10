

<a href="javascript:history.back()">
	<img class="back" src="<?php echo ASSETS . 'frontend/images/icons/go_back.png'; ?>"alt="volver atras" title="Volver atrás" width="85" height="85" />
</a>

<?php if ( isset($show_in) && $show_in): ?>
	<a href="<?php echo site_url('entrada_stock/nueva_entrada/add');?>">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/add.png'; ?>" alt="listar" title="Ingresar al  Stock" width="85" height="85" />
	</a>
<?php endif; ?>

<?php if ( isset($show_out) && $show_out ): ?>
	<a href="#">
		<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/exit_download.png'; ?>" alt="listar" title="Dar una Salida del Stock" width="85" height="85" />
	</a>
<?php endif; ?>

<a href="#">
	<img class="list" src="<?php echo ASSETS . 'frontend/images/icons/configure.png'; ?>" alt="listar" title="Dar una Salida del Stock" width="85" height="85" />
</a>

