
<?php $this->load->view('config'); ?>

<div class="col-md-12">
	<div class="col-md-2">
	</div>

	<div class="col-md-6">
		<!-- CATEGORIA CREADO CORRECTAMENTE -->
		<?php if ($this->session->flashdata('flash_notice')): ?>
			<div class="alert alert-success fade in" >
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php echo $this->session->flashdata('flash_notice'); ?>
			</div>
		<?php endif ?>
		<!-- CATEGORIA NO PUDO SER EDITADA -->
		<?php if ($this->session->flashdata('flash_error')): ?>
			<div class="alert alert-error fade in" >
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php echo $this->session->flashdata('flash_error'); ?>
			</div>
		<?php endif ?>

		<table class="table  table-condensed lista_categorias">
			<tr>
				<th><strong>CODIGO</strong></th>
				<th><strong>NOMBRE</strong></th>
				<th><strong>ACCIONES</strong></th>
			</tr>
			<?php foreach ($categorias AS $cat): ?>
				<tr>
					<td>
						<?php echo $cat['codigo_abrev']; ?>
					</td>
					<td>
						<?php echo $cat['nombre']; ?>
					</td>
					<td  class="actions">
						<a href="<?php echo site_url('productos/editar_categoria/' . $cat['id_categorias']);?>">
							<img class="edit" src="<?php echo ASSETS . 'frontend/images/icons/actions/edit.png'; ?>" alt="editar" title="Editar" width="25" height="25" />
						</a>
						<a href="#">
							<img class="del del_category" id="<?php echo $cat['id_categorias']; ?>" src="<?php echo ASSETS . 'frontend/images/icons/actions/delete.png'; ?>" alt="eliminar" title="Borrar" width="25" height="25" />
						</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>

	<div class="col-md-4">
	</div>

</div>

