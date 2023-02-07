<style>
	
body {

		background-image: <?php echo ("url(".base_url()."/images/fondo2.jpg)");?>;
		background-repeat: no-repeat;
		background-size: cover;

	}

</style>

<body>
	

<form action="<?php echo site_url('activate/'.$id_usuario.'/'.$link); ?>" method="POST">
	<div class="login">
		
		<div class="login__logo" >
			<img src="<?php echo base_url(); ?>./images/Logo.png">
		</div>
		<div login__content>
			<h2>Usuario: <?php echo $nombre ?></h2>
			<p>Por favor ingrese una contraseña segura:</p>
		
			<br>
			<p>Contraseña</p>
			<!-- <div class="column">
			<div class="input-container">
				<i class="fa-solid fa-user icon"></i> -->
			<input type="password" name="password" value="" autofocus/>
			<br><br>
			<p>Repita la contraseña: </p>
			<input type="password" name="repeat_password" value="" />

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