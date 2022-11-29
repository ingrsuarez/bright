	
<form method="POST" action="<?php echo site_url('rrhh/ingresar'); ?>" id="ingresoPersonal">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVO PERSONAL: </h3>
			</div>
			<div class="input-container">
				
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Nombre:" form="ingresoPersonal" id="nombre" name="nombre" maxlength="300" autofocus required>	
			</div>
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Apellido:" form="ingresoPersonal" id="apellido" name="apellido" maxlength="300" required>	

			</div>
		</div>
		
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-envelope icon"></i>
				<input type="text" class="input-field" placeholder="Mail:" form="ingresoPersonal" id="serial" name="serial" required>

				
			</div>
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<input type="text" class="input-field" placeholder="Teléfono:" form="ingresoPersonal" id="telefono" name="telefono" required>
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-battery-three-quarters icon"></i>
				<input type="text" class="input-field" placeholder="Capacidad:" form="ingresoPersonal" id="capacidad" name="capacidad" maxlength="300" required>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="ubicacion" name="ubicacion" required>
					<option selected value=''> Ubicación... </option>
					<option value='BASE'> BASE </option>
					<option value='SERVICIO'> EN SERVICIO </option>
				</select>
			</div>
			<div class="input-container">
				
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoPersonal" style="margin-left: 40px; width: 100px;" value="Ingresar">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					


