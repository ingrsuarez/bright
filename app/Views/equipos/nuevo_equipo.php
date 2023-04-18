<div class="container_registro small">	
	<form method="POST" action="<?php echo site_url('equipo/ingresar'); ?>" id="ingresoEquipo">	
		<div class="titulo">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVO EQUIPO: </h3>
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-tag icon"></i>
				<input type="text" class="input-field" placeholder="Número:" form="ingresoEquipo" id="numero" name="numero" maxlength="300" autofocus required>	
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<input type="text" class="input-field" placeholder="Marca:" form="ingresoEquipo" id="marca" name="marca" maxlength="300" required>

				
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-clock icon"></i>
				<input type="text" class="input-field" placeholder="Horas:" form="ingresoEquipo" id="horas" name="horas" maxlength="300">

				
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-battery-three-quarters icon"></i>
				<input type="text" class="input-field" placeholder="Capacidad:" form="ingresoEquipo" id="capacidad" name="capacidad" maxlength="300" required>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="ubicacion" name="ubicacion" required>
					<option selected value=''> Ubicación... </option>
					<option value='BASE'> BASE </option>
					<option value='SERVICIO'> EN SERVICIO </option>
				</select>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoEquipo" style="margin-left: 40px; width: 100px;" value="Ingresar">
			</div>
		</div>
	</form>	
</div>
					


