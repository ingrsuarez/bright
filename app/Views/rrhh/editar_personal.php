

<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

?>


<div class="container_registro medium">
	<form method="POST" action="<?php echo site_url('rrhh/modificar/'.$personal[0]->id); ?>" id="editarPersonal">
		<div class="titulo">			
			<h3><i class="fas fa-tasks"></i>  EDITAR PERSONAL: </h3>
			<input type="hidden" form="editarPersonal" id="id" name="id" value="<?php echo $personal[0]->id;?>">
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Nombre:" form="editarPersonal" id="nombre" name="nombre" maxlength="300" value="<?php echo $personal[0]->nombre;?>" autofocus required>	
			</div>
			<div class="input-container">
				<i class="fa-solid fa-signature icon"></i>
				<input type="text" class="input-field" placeholder="Apellido:" form="editarPersonal" id="apellido" name="apellido" value="<?php echo $personal[0]->apellido;?>" maxlength="300" required>	

			</div>
		</div>
		
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-envelope icon"></i>
				<input type="email" class="input-field" placeholder="Mail:" form="editarPersonal" id="mail" name="mail" value="<?php echo $personal[0]->mail;?>" required>	
			</div>
			<div class="input-container">
				<i class="fa-solid fa-phone icon"></i>
				<input type="text" class="input-field" placeholder="Teléfono:" form="editarPersonal" id="telefono" name="telefono" value="<?php echo $personal[0]->telefono;?>" required>
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-business-time icon"></i>
				<input type="number" class="input-field" placeholder="Horas Semanales:" form="editarPersonal" id="horas" name="horas" maxlength="300" value="<?php echo $personal[0]->horas_semanales;?>" required>
			</div>
			<div class="input-container">
				<i class="fa-solid fa-cake-candles icon"></i>
				<input type="date" class="input-field" placeholder="Fecha de nacimiento:" form="editarPersonal" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $personal[0]->fecha_nacimiento;?>" required>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-hashtag icon"></i>
				<input type="text" class="input-field" placeholder="Cuil:" form="editarPersonal" id="cuil" name="cuil" value="<?php echo $personal[0]->cuil;?>" maxlength="300">
			</div>
			<div class="input-container">
				<i class="fa-solid fa-id-card icon"></i>
				<input type="number" class="input-field" placeholder="DNI:" form="editarPersonal" id="dni" name="dni" value="<?php echo $personal[0]->dni;?>" required>
			</div>

		</div>
		<div class="row">
			<div class="input-container">
				<i class="fa-solid fa-location-dot icon"></i>
				<input type="text" class="input-field" placeholder="Domicilio:" form="editarPersonal" id="domicilio" name="domicilio" maxlength="300" value="<?php echo $personal[0]->domicilio;?>" required>
			</div>
		</div>
		<div class="row">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="prevPersonal" style="margin-left: 40px; width: 100px;" value="<">
				<input type="submit" class="btn btn-register" form="editarPersonal" style="margin-left: 40px; width: 100px;" value="Editar">
				<input type="submit" class="btn btn-register" form="nextPersonal" style="margin-left: 40px; width: 100px;" value=">">
			</div>
			
		</div>
	</form>
</div>
	
<?php 
$next = intval($personal[0]->id)+1;
$prev = intval($personal[0]->id)-1;
		?>				
<form method="POST" action="<?php echo site_url('rrhh/editar/'.$next); ?>" id="nextPersonal">
</form>
<form method="POST" action="<?php echo site_url('rrhh/editar/'.$prev); ?>" id="prevPersonal">
</form>

