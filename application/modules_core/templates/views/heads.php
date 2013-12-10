<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title>Constrol Stock</title>

	<!-- FUENTE -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<!-- BOOTSTRAP -->
	<link href="<?php echo ASSETS . 'bootstrap/dist/css/bootstrap.css'; ?>" rel="stylesheet" media="screen">
	<!-- ICONOS DE BOOTSTRAP -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

	<!-- JQUERY -->
	<script src="<?php echo GROCERY_ASSETS . 'js/jquery-1.10.2.min.js'; ?>"></script>
	<!-- BOOTSTRAP -->
	<script src="<?php echo ASSETS . 'bootstrap/dist/js/bootstrap.min.js'; ?>"></script>

	<!-- ESTILO PRINCIPAL -->
	<link href="<?php echo ASSETS . 'frontend/css/main.css'; ?>" type="text/css" rel="stylesheet" />

	<!-- ESTILOS DE LOS CONTROLADORES -->
	<?php if (isset($css_includes)): ?>
		<?php foreach ($css_includes AS $css): ?>
			<link href="<?php echo ASSETS . $css; ?>" type="text/css" rel="stylesheet" />
		<?php endforeach; ?>
	<?php endif; ?>



	<!-- ESTILO STOCK -->
	<?php if ( $section == 'entrada_stock.nueva_entrada'): ?>
		<link href="<?php echo ASSETS . 'frontend/css/productos.css'; ?>" type="text/css" rel="stylesheet" />
		<link href="<?php echo ASSETS . 'frontend/css/entrada_stock.css'; ?>" type="text/css" rel="stylesheet" />
		<!-- TODO: hay que hacer el estilo propio del stock, por ahora uso de los productos -->
	<?php endif ?>


	<!-- ASSETS DE GROCERY -->
	<?php if (isset($css_grocery) && isset($js_grocery)): ?>
		<?php foreach($css_grocery as $file): ?>
		        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
		<?php foreach($js_grocery as $file): ?>
		        <script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
	<![endif]-->



	<script type="text/javascript">
		// ahora se puede usar RUTA desde los .js, cambia si es LOCAL o DEMO
		var RUTA = "<?php echo RAIZ; ?>";
	</script>

	<!-- JS DE LOS CONTROLADORES -->
	<?php if (isset($js_includes)): ?>
		<?php foreach ($js_includes AS $js): ?>
			<script src="<?php echo ASSETS . $js; ?>"></script>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- GENERAL -->
	<script src="<?php echo ASSETS . 'frontend/js/general.js'; ?>"></script>


	<!-- ICO -->
	<link rel="icon" href="<?php echo ASSETS . 'frontend/images/favicon.ico'; ?>  " type="image/vnd.microsoft.icon" />



</head>
