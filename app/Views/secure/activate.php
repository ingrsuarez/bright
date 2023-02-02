<style>
	
body {

		background-image: url("images/fondo2.jpg");
		background-repeat: no-repeat;
		background-size: cover;

	}

</style>

<body>
	

<form action="<?php echo site_url('home'); ?>" method="POST">
	<div class="login">
		
		<div class="login__logo" >
			<img src="<?php base_url(); ?>./images/logo.png">
		</div>
		<div login__content>
			<h2>Login</h2>
			<p>Por favor ingrese su nombre de usuario y contraseña:</p>
		
			<br>
			<p>Usuario</p>
			<!-- <div class="column">
			<div class="input-container">
				<i class="fa-solid fa-user icon"></i> -->
			<input type="text" name="username" value="" autofocus/>
			<br><br>
			<p>Password </p>
			<input type="password" name="password" value="" />

			<div><input class="submit" type="submit" value="Ingresar" /></div>

		</div>
		
		
	</div>
</form>

<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

?>