
<div class="boxes">
	<div class="box">
		<a href="<?php echo site_url('productos/add');?>">
			<img src="<?php echo ASSETS . 'frontend/images/alta_productos.png'; ?>" width="64" height="37" alt="alta" />
			<span class="h3">Alta de Productos</span>
			<span class="p">Dar de alta productos, para luego ingresarlos al stock.</span>
		</a>
	</div>
	<div class="box">
		<a href="<?php echo site_url('stock_actual/listar');?>">
			<img src="<?php echo ASSETS . 'frontend/images/stock_actual.png'; ?>" width="64" height="64" alt="stock" />
			<span class="h3">Stock Actual</span>
			<span class="p">Visualizar el stock actual.</span>
		</a>
	</div>
	<div class="box">
		<a href="<?php echo site_url('entrada_stock/nueva_entrada');?>">
			<img src="<?php echo ASSETS . 'frontend/images/ingreso_stock.png'; ?>" width="64" height="52" alt="ingreso" />
			<span class="h3">Entrada de Stock</span>
			<span class="p">Ingresar productos al Stock.</span>
		</a>
	</div>
	<div class="box">
		<a href="<?php echo site_url('remitos/agregar');?>">
			<img src="<?php echo ASSETS . 'frontend/images/salida_stock.png'; ?>" width="64" height="55" alt="egreso" />
			<span class="h3">Remitos</span>
			<span class="p">Realizar un Remito.</span>
		</a>
	</div>
</div>
