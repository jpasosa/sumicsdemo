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

<div class="col-md-3">
</div>

<div class="col-md-6">
	<div class="title">LISTADO DE PRODUCTOS</div>
</div>

<div class="col-md-3">
</div>



<div class="inner-content list_article">
<div class=".col-md-1"> </div>

<div class=".col-md-10">

	<?php if ($this->session->flashdata('flash_notice')): ?> <!-- TRABAJO CREADO CORRECTAMENTE -->
		<div class="alert alert-success fade in" >
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php echo $this->session->flashdata('flash_notice'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('flash_error')): ?> <!-- TRABAJO CREADO CORRECTAMENTE -->
		<div class="alert alert-error fade in" >
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php echo $this->session->flashdata('flash_error'); ?>
		</div>
	<?php endif; ?>

	<form action="#" method="post" enctype="multipart/form-data">
		<div class="categoria"> <!-- CATEGORIA DEL ARTICULO -->
			<label>Categoría:</label>
			<select name="id_categorias" id="filter">
				<option value="0"> Listar Todas </option>
				<?php foreach ($categorys AS $cat): ?>
					<option value="<?php echo $cat['id_categorias']; ?>"
						<?php if ($cat['id_categorias'] == $filter_category): echo " selected='selected' "; endif; ?> >
						<?php echo $cat['nombre'] . ' (<span style="font-weight: bold;">' . $cat['codigo_abrev'] . '</span>)'; ?>
					</option>
				<?php endforeach ?>
			</select>
			<button id="btn-filter" class="btn-xs" type="button">
				OK
			</button>
			<div class="paginador_productos">
				<?php echo $paginador; ?>
			</div>

			<!--
				<ul class="pagination">
				      <li> <a href="#"> <<< </a> </li>
			  		<li class="active"> <a href="#"> 1 </a> </li>
			  		<li> <a href="#"> 2 </a> </li>
			  		<li> <a href="#"> 3 </a> </li>
			  		<li> <a href="#"> >>> </a> </li>
				</ul>
			</div> -->
		</div>

	</form>



	<table class="table  table-condensed">
		<tr>
			<th><strong>CODIGO</strong></th>
			<th><strong>DESCRIPCION</strong></th>
			<th><strong>DETALLE</strong></th>
			<th><strong>OBSERVACIONES</strong></th>
			<th><strong>CATEGORIA</strong></th>
			<th><strong>ACCIONES</strong></th>
		</tr>
		<?php foreach ($products AS $pr): ?>
			<tr>
				<td>
					<?php echo $pr['codigo']; ?>
				</td>
				<td>
					<?php echo $pr['descripcion']; ?>
				</td>
				<td>
					<?php echo $pr['detalle']; ?>
				</td>
				<td>
					<?php echo $pr['observaciones']; ?>
				</td>
				<td>
					<?php echo $pr['nombre']; ?>
				</td>
				<td  class="actions">
					<a href="<?php echo site_url('productos/ver/' . $pr['id_productos']);?>">
						<img class="view" src="<?php echo ASSETS . 'frontend/images/icons/actions/view.png'; ?>" alt="ver" title="Ver" width="25" height="25" />
					</a>
					<a href="<?php echo site_url('productos/editar/' . $pr['id_productos']);?>">
						<img class="edit" src="<?php echo ASSETS . 'frontend/images/icons/actions/edit.png'; ?>" alt="editar" title="Editar" width="25" height="25" />
					</a>
					<a href="#">
						<img class="del del_product" id="<?php echo $pr['id_productos']; ?>" src="<?php echo ASSETS . 'frontend/images/icons/actions/delete.png'; ?>" alt="eliminar" title="Borrar" width="25" height="25" />
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>



</div>

<div class=".col-md-1">

</div>

</div> <!-- cierro inner-content list_article -->




