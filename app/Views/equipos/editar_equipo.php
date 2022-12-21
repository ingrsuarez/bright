
<form method="POST" action="<?php echo site_url('equipo/modificar/'.$equipos[0]->id); ?>" id="editarEquipo">
	<div class="container registros">
		
		<div class="column">
			
			<div class="register_title">
				
				<h3> <i class="fa-solid fa-pen-to-square"></i> EDITAR EQUIPO: </h3>
				<input type="hidden" form="editarEquipo" id="id" name="id" value="<?php echo $equipos[0]->id;?>">
			</div>
			
		</div>
		<div class="column">
			
			<div class="input-container">
				<i class="fa-solid fa-tag icon"></i>
				<input type="text" class="input-field" placeholder="Número:" form="editarEquipo" id="numero" name="numero" value="<?php echo $equipos[0]->numero;?>" maxlength="300" autofocus required>	
			</div>
			
		</div>
		<div class="column">
			
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<input type="text" class="input-field" placeholder="Marca:" form="editarEquipo" id="marca" name="marca" value="<?php echo ucfirst($equipos[0]->marca);?>" maxlength="300" required>

				
			</div>
			
		</div>
		<div class="column">
			
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<input type="text" class="input-field" placeholder="Horas:" form="editarEquipo" id="horas" name="horas" value="<?php echo ($equipos[0]->horas);?>" >

				
			</div>
			
		</div>
		<div class="column">
			
			<div class="input-container">
				<i class="fa-solid fa-battery-three-quarters icon"></i>
				<input type="text" class="input-field" placeholder="Capacidad:" form="editarEquipo" id="capacidad" name="capacidad" value="<?php echo $equipos[0]->capacidad;?>" maxlength="300" required>
			</div>
			

		</div>
		<div class="column">
			
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="ubicacion" name="ubicacion" required>
					<option selected value="<?php echo $equipos[0]->ubicacion;?>"> <?php echo $equipos[0]->ubicacion;?> </option>
					<option value='BASE'> BASE </option>
					<option value='SERVICIO'> EN SERVICIO </option>
				</select>
			</div>
			

		</div>
		<div class="column">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="prevEquipo" style="margin-left: 40px; width: 100px;" value="<">
				<input type="submit" class="btn btn-register" form="editarEquipo" style="margin-left: 40px; width: 100px;" value="Editar">
				<input type="submit" class="btn btn-register" form="nextEquipo" style="margin-left: 40px; width: 100px;" value=">">
			</div>
			
		</div>
		
	</div>
</form>	
<?php 
$next = intval($equipos[0]->id)+1;
$prev = intval($equipos[0]->id)-1;
		?>				
<form method="POST" action="<?php echo site_url('equipos/editar/'.$next); ?>" id="nextEquipo">
	<input type="hidden" form="nextEquipo" id="next" name="next" value="up">
</form>
<form method="POST" action="<?php echo site_url('equipos/editar/'.$prev); ?>" id="prevEquipo">
	<input type="hidden" form="prevEquipo" id="next" name="next" value="down">
</form>

