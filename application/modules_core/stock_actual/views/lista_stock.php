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
	<div class="title">LISTADO DEL STOCK ACTUAL</div>
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

	<table class="table  table-condensed">
		<tr>
			<th><strong>CODIGO</strong></th>
			<th><strong>DESCRIPCION</strong></th>
			<th><strong>DETALLE</strong></th>
			<th><strong>CANTIDAD</strong></th>
			<th><strong>MEMO</strong></th>
		</tr>
		<?php foreach ($stock_actual AS $sa): ?>
			<tr>
				<td><?php echo $sa['codigo']; ?></td>
				<td><?php echo $sa['descripcion']; ?></td>
				<td><?php echo $sa['detalle']; ?></td>
				<td><?php echo $sa['cantidad']; ?></td>
				<td>
					<a href="#"><?php echo $sa['memo']; ?></a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>

</div>

<div class=".col-md-1">

</div>

</div> <!-- cierro inner-content list_article -->




