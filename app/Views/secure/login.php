<style>
	
body {

		background-image: url("images/fondo2.jpg");
		background-repeat: no-repeat;
		background-size: cover;

	}

</style>

<body>
	
<div class="container log">
	<form action="<?php echo site_url('home'); ?>" method="POST">
		<div class="container_registro">
			
			<div class="login__logo" >
				<img src="<?php base_url(); ?>./images/logo.png">
			</div>
			<div class="input-container">
				<h2>Login</h2>
				<div class="row">
					<p>Por favor ingrese su nombre de usuario y contraseña:</p>
				</div>
				<div class="row">
					<p>Usuario: .</p>	
					<input type="text" name="username" value="" autofocus/>
				</div>
				<div class="row">
					<p>Password: .</p>

					<input type="password" name="password" value="" />
				</div>	
				<div class="row"><input class="submit" type="submit" value="Ingresar" /></div>

			</div>
			
			
		</div>
	</form>
</div>
<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

?>