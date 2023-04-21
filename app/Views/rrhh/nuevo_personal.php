	

<div class="container_registro medium">
	<form method="POST" action="<?php echo site_url('rrhh/ingresar'); ?>" id="ingresoPersonal">
		<div class="titulo">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVO PERSONAL: </h3>
			</div>
			
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Nombre:" form="ingresoPersonal" id="nombre" name="nombre" maxlength="300" autofocus required>	
			</div>
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Apellido:" form="ingresoPersonal" id="apellido" name="apellido" maxlength="300" required>	

			</div>
		</div>
		
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-envelope icon"></i>
				<input type="email" class="input-field" placeholder="Mail:" form="ingresoPersonal" id="mail" name="mail" required>

				
			</div>
			<div class="input-container">
				<i class="fa-solid fa-phone icon"></i>
				<input type="text" class="input-field" placeholder="Teléfono:" form="ingresoPersonal" id="telefono" name="telefono" required>
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-business-time icon"></i>
				<input type="number" class="input-field" placeholder="Horas Semanales:" form="ingresoPersonal" id="horas" name="horas" maxlength="300" required>
			</div>
			<div class="input-container">
				<i class="fa-solid fa-cake-candles icon"></i>
				<input type="date" class="input-field" placeholder="Fecha de nacimiento:" form="ingresoPersonal" id="fechaNacimiento" name="fechaNacimiento" required>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-hashtag icon"></i>
				<input type="text" class="input-field" placeholder="Cuil:" form="ingresoPersonal" id="cuil" name="cuil" maxlength="300">
			</div>
			<div class="input-container">
				<i class="fa-solid fa-id-card icon"></i>
				<input type="number" class="input-field" placeholder="DNI:" form="ingresoPersonal" id="dni" name="dni" required>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-location-dot icon"></i>
				<input type="text" class="input-field" placeholder="Domicilio:" form="ingresoPersonal" id="domicilio" name="domicilio" maxlength="300" required>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoPersonal" style="margin-left: 40px; width: 100px;" value="Ingresar">
			</div>
			<div class="input-container">
				
			</div>
		</div>
	</form>			
</div>
				


