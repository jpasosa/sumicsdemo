

<div class="col-md-4"> </div>

<div class="col-md-4">
	<form class="form-signin" method="post" action="<?php echo $form_action; ?>">
		<!-- <h2 class="form-signin-heading">Por Favor, Loguearse</h2> -->
		<div class="error_login">
			<?php if (isset($error_login)): ?>
				Email y/o clave incorrectos.
			<?php endif; ?>
		</div>
		<input type="text" class="form-control" name="email" placeholder="Email" autofocus>
		<input type="password" name="pass" class="form-control" placeholder="Clave">
		<label class="checkbox">
			<!-- <input type="checkbox" value="remember-me"> Olvidé mi contraseña -->
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">INGRESAR</button>
	</form>
</div>

<div class="col-md-4"> </div>
