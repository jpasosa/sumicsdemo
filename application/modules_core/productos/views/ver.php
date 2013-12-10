<div class="col-md-2">
</div>

<div class="col-md-6">
	<div class="inner-content new_article">
		<div class="box_new_article">
			<div class="title">  PRODUCTO: <?php echo $product['codigo']; ?></div>
			<form action="" method="">
				<div class="image_top">
					<img src="<?php echo ASSETS . 'frontend/images/alta_productos.png'; ?>" width="198" height="114" alt="alta" />
					<div class="code"> <!-- CODIGO DEL ARTICULO-->
						<label>Código</label>
						<input type="text" name="codigo" readonly="readonly" value="<?php echo $product['codigo']; ?>">
					</div>
					<!-- DESCRIPCION -->
					<div class="descripcion">
						<label>Descripción:</label>
						<input type="text" readonly="readonly" name="descripcion" value="<?php echo $product['descripcion']; ?>">
					</div>
				</div>
				<div class="bottom">
					<div class="detalle"> <!-- DESCRIPCION DEL ARTICULO -->
						<label>Detalle:</label>
						<input type="text" name="detalle" readonly="readonly" value="<?php echo $product['detalle']; ?>">
					</div>

					<div class="observaciones"> <!-- REFERENCIA DEL ARTICULO -->
						<label>Observaciones:</label>
						<textarea name="observaciones" readonly="readonly"><?php echo $product['observaciones']; ?></textarea>
					</div>

					<div class="categoria"> <!-- CATEGORIA DEL ARTICULO -->
						<label>Categoría:</label>
						<select name="id_categorias" disabled="disabled">
								<option>
									<?php echo $product['nombre'] . ' (<span style="font-weight: bold;">' . $product['codigo_abrev'] . '</span>)'; ?>
								</option>
						</select>
					</div>
				</div>
			</form>
		</div> <!-- cierro box_new_article -->
	</div> <!-- cierro inner-content new_article -->
</div>

<div class="col-md-4">
</div>




