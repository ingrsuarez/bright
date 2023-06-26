	

	
	<div class="container_registro">
		<form method="POST" action="<?php echo site_url('ventas/ingresarRemito'); ?>" id="ingresoRemito">	
			<div class="titulo">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  NUEVA ORDEN DE SERVICIO: </h3>
				</div>
			</div>

			<div class="row">
				<div class="input-container">
					<i class="fa-regular fa-calendar icon"></i>
					<input type="date" class="input-field" placeholder="Fecha:" form="ingresoRemito" id="fecha" name="fecha" value="<?php echo $today ?>" required>

					
				</div>
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="cliente" id="cliente" autofocus required>
						<option value="">Seleccione el cliente.....</option>
					  	<?php
					  	$arrayLength = count($clientes);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $clientes[$i]->id;?>'><?php echo strtoupper(substr($clientes[$i]->nombre,0,22));?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
				
			</div>
			<div class="row">
				
				<div class="input-container">
					<i class="fa-solid fa-hashtag icon"></i>
					<input type="number" class="input-field" placeholder="Número:" form="ingresoRemito" id="numero" name="numero" value="<?php echo (1 + intval($ultimoRemito->ultimo));?>" required>
					<span class="tooltiptext">Número de orden</span>	
				</div>
				<div class="input-container">
					<i class="fa-solid fa-location-dot icon"></i>
					<input type="text" class="input-field" placeholder="Domicilio:" form="ingresoRemito" id="domicilio" name="domicilio" maxlength="300">
					<span class="tooltiptext">Ubicación del equipo</span>	
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<textarea type="text" class="input-field" placeholder="Observaciones:" form="ingresoRemito" id="leyenda" name="leyenda"></textarea>
					<span class="tooltiptext">Observaciones</span>	
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-truck-moving icon"></i>
					<input type="text" class="input-field" placeholder="Transportista:" form="ingresoRemito" id="transporte" name="transporte" required>	
				</div>
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="time" class="input-field" placeholder="Hora:" form="ingresoRemito" id="hora" name="hora" value="<?php echo $hora ?>" required>
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="tipo" id="tipo" required>
						<option value="salida">Salida</option>
						<option value="retorno">Retorno</option>
					</select>	
				</div>
				<div class="input-container">
					<i class="fa-solid fa-truck-arrow-right icon"></i>
					<input type="number" class="input-field" placeholder="Kilometros:" form="ingresoRemito" id="kilometros" name="kilometros">
					<span class="tooltiptext">Kilometros a facturar</span>
				</div>
				<div class="input-container">
					<!-- <i class="icon"></i> -->
					<input type="submit" class="btn btn-register" form="ingresoRemito" value="Generar Remito">
				</div>	
			</div>
		</form>	
	</div>

		<div class="container_tabla">
			<div class="titulo">
				<h3><i class="fas fa-tasks"></i>  EQUIPOS: </h3>
			</div>
			<table class='listado' id="tablaEquipos">
				<thead>
					<tr>
						<th class="center">#</th>
						<th class="center">Número </th>
						<th>Capacidad </th>
						<th class="center">Horas </th>
						<th class="extra">Marca</th>
						<th class="extra">Ubicacion</th>
						<th scope='col'>Estado</th>
					</tr>
				</thead>
				<tbody>
				<?php	
				$arrayLength = count($equipos);
				$i = 0;
				while ($i < $arrayLength) {?>
					<tr class="listado__row">	
						<td><input class='ingresoRemito' type='checkbox' form="ingresoRemito" id="<?php echo $equipos[$i]->id ?>" name='equipos_seleccionados[]' value="<?php echo $equipos[$i]->id ?>"><input type="hidden" form="ingresoRemito" name="equipos[]" value="<?php echo $equipos[$i]->id ?>"></td>					
						<td> <?php echo $equipos[$i]->numero;?></td>
						<td><input type='hidden' form="ingresoRemito" name='capacidad[]'value="<?php echo $equipos[$i]->capacidad;?>"> <?php echo $equipos[$i]->capacidad;?></td>
						<td><input type='number'class="right" form="ingresoRemito" value='<?php echo $equipos[$i]->horas;?>' step="1" name='horas[]' readonly></td>
						<td class="extra"> <?php echo $equipos[$i]->marca;?></td>
						<td class="extra"> <?php echo strtoupper($equipos[$i]->ubicacion);?></td>
						<td> <?php echo strtoupper($equipos[$i]->estado);?></td>				
					</tr><?php
					$i++;
					}
					 ?>	  
				</tbody>
			</table>
		</div>
	

	<script type="text/javascript">
		$(document).ready(function(){

			var tipo = document.getElementById('tipo');

			tipo.addEventListener('input',function(){

				var tipoRemito = tipo.value;	
				
				$("#tablaEquipos>tbody").empty();

				$.post("nuevo_remito/salida",{tipoRemito: tipoRemito},function(result)
				{	
					var cont = 0;
					var json = JSON.parse(result);
					
					if (tipoRemito == "salida"){
						json.forEach(function(value,label){
						cont++;
						$("#tablaEquipos>tbody").append(
							"<tr class='listado__row'>"
							+"<td><input class='ingresoRemito' form='ingresoRemito' type='checkbox' id="+json[label].id+" name='equipos_seleccionados[]' value="
							+json[label].id+"><input type='hidden' name='equipos[]' form='ingresoRemito' value="+json[label].id+"></td>"
							+"<td>"+json[label].numero+"</td>"
							+"<td>"+json[label].capacidad+"<input type='hidden' "+
							+" form='ingresoRemito' name='capacidad[]'value="+json[label].capacidad+"></td>"
							+"<td><input class='right' form='ingresoRemito' type='number' min='"
							+json[label].horas+"' step='any' name='horas[]' value='"
							+json[label].horas+"' readonly></td>"
							+"<td class='extra'>"+ json[label].marca+"</td>"
							+"<td class='extra'>"+ json[label].ubicacion.toUpperCase()+"</td>"
							+"<td>"+ json[label].estado.toUpperCase()+"</td>"
							+"</tr>");

							
						});
					}else{
						json.forEach(function(value,label){
						cont++;
						$("#tablaEquipos>tbody").append("<tr class='listado__row'>"
							+"<td><input class='ingresoRemito' type='checkbox' id="+json[label].id+" form='ingresoRemito' name='equipos_seleccionados[]' value="+json[label].id+"><input type='hidden' form='ingresoRemito' name='equipos[]' value="+json[label].id+"></td>"
							+"<td>"+json[label].numero+"</td>"
							+"<td>"+json[label].capacidad+"<input type='hidden' form='ingresoRemito' name='capacidad[]' value="+json[label].capacidad+"></td>"
							+"<td><input class='right' form='ingresoRemito' type='number' min='"+json[label].horas+"' step='any' name='horas[]' value='"+json[label].horas+"'></td>"
							+"<td class='extra'>"+ json[label].marca+"</td>"
							+"<td class='extra'>"+ json[label].ubicacion.toUpperCase()+"</td>"
							+"<td>"+ json[label].estado.toUpperCase()+"</td>"
							+"</tr>");	
							
						});
					}		
				});
			});
		});
	</script> 

				


