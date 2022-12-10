	
<form method="POST" action="<?php echo site_url('ventas/ingresar_cliente'); ?>" id="ingresoCliente">
	<div class="container registros">
		<div class="column">
			<div class="register_title">
				<h3><i class="fas fa-tasks"></i>  NUEVO CLIENTE: </h3>
			</div>
			
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Razon social:" form="ingresoCliente" id="nombre" name="nombre" maxlength="300" autofocus required>	
			</div>
			<div class="input-container">
				<i class="fa-solid fa-hashtag icon"></i>
				<input type="text" class="input-field" placeholder="Cuit:" form="ingresoCliente" id="cuit" name="cuit" maxlength="300" required>	

			</div>
		</div>
		
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-file-invoice icon"></i>
				<select class="select-field" id="iva" name="iva" required>
					<option selected value=''> IVA... </option>
					<option value='inscripto'> INSCRIPTO </option>
					<option value='monotributo'> MONOTRIBUTO </option>
					<option value='exento'> EXENTO </option>
				</select>

				
			</div>
			<div class="input-container">
				<i class="fa-solid fa-phone icon"></i>
				<input type="text" class="input-field" placeholder="Teléfono:" form="ingresoCliente" id="telefono" name="telefono" required>
			</div>
		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-location-dot icon"></i>
				<input type="text" class="input-field" placeholder="Domicilio:" form="ingresoCliente" id="domicilio" name="domicilio" maxlength="300" required>
			</div>
			<div class="input-container">
				<i class="fa-solid fa-envelope icon"></i>
				<input type="email" class="input-field" placeholder="Email:" form="ingresoCliente" id="email" name="email">
			</div>

		</div>
		<div class="column">
			<div class="input-container">
				<i class="fa-solid fa-building icon"></i>
				<input type="text" class="input-field" placeholder="Codigo postal:" form="ingresoCliente" id="postal" name="postal" maxlength="300">
			</div>
			<div class="input-container">
				<i class="fa-solid fa-percent icon"></i>
				<input type="number" class="input-field" placeholder="Descuento:" form="ingresoCliente" id="descuento" name="descuento" maxlength="300">
			</div>

		</div>
		
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="ingresoCliente" style="margin-left: 40px; width: 100px;" value="Ingresar">
			</div>
			<div class="input-container">
				
			</div>
		</div>
		
	</div>
</form>					


