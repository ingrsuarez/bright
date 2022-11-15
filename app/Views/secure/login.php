<style>
	
body {

		background-image: url("images/fondo2.jpg");
		background-repeat: no-repeat;
		background-size: cover;

	}

</style>

<body>
	


	<div class="login">
		<!-- <img src="<?php //echo base_url(); ?>/images/fondo1.jpg"> -->
		<div class="login__logo" ></div>
		<h2>Login</h2>
		<p>Por favor ingrese su nombre de usuario y contraseña:</p>
		<form action="<?php echo site_url('pages/index'); ?>" method="POST">
			<br>
			<p>Usuario</p>
			<input type="text" name="username" value="" autofocus/>
			<br><br>
			<p>Password </p>
			<input type="password" name="password" value="" />

			<div><input class="submit" type="submit" value="Ingresar" /></div>
		</form>
	</div>

