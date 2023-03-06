	
<form method="POST" action="<?php echo site_url('ventas/ingresarRemito'); ?>" id="ingresoRemito">
	<div class="grid2x1">
		<div class="container registros">
			<div class="column">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  NUEVA ORDEN DE SERVICIO: </h3>
				</div>
			</div>

			<div class="column">
				<div class="input-container">
					<i class="fa-regular fa-calendar icon"></i>
					<input type="date" class="input-field" placeholder="Fecha:" form="ingresoRemito" id="fecha" name="fecha" maxlength="300" value="<?php echo $today ?>" required>

					
				</div>
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="cliente" id="cliente" autofocus required>
						<option value="">Seleccione el cliente.....</option>
					  	<?php
					  	$arrayLength = count($clientes);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $clientes[$i]->id;?>'><?php echo strtoupper($clientes[$i]->nombre);?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
				<div class="column"></div>
				
			</div>
			<div class="column">
				
				<div class="input-container">
					<i class="fa-solid fa-hashtag icon"></i>
					<input type="number" class="input-field" placeholder="Número:" form="ingresoRemito" id="numero" name="numero" value="<?php echo (1 + intval($ultimoRemito->ultimo));?>" required>	
				</div>
				<div class="input-container">
					<i class="fa-solid fa-location-dot icon"></i>
					<input type="text" class="input-field" placeholder="Domicilio:" form="ingresoRemito" id="domicilio" name="domicilio" maxlength="300">	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Observaciones:" form="ingresoRemito" id="leyenda" name="leyenda"></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-truck-moving icon"></i>
					<input type="text" class="input-field" placeholder="Transportista:" form="ingresoRemito" id="transporte" name="transporte" style="width: 320px;" required>	
				</div>
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="time" class="input-field" placeholder="Hora:" form="ingresoRemito" id="hora" name="hora" value="<?php echo $hora ?>" required>
				</div>
			</div>
			<div class="column">
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
				</div>
				<div class="input-container">
					<!-- <i class="icon"></i> -->
					<input type="submit" class="btn btn-register" form="ingresoRemito" style="margin-left: 40px; width: 120px;" value="Generar Remito">
				</div>
				
			</div>
			
		</div>

		<div class="container registros2">
			<table class='listado' id="tablaEquipos">
			<thead>
				<tr class="listado__encabezado">
					<th class="listado__fecha" style="width: 30px;">#</th>
					<th class="listado__fecha" scope='col'>Número </th>
					<th class="listado__usuario" scope='col'>Capacidad </th>
					<th scope='col'>Horas </th>
					<th scope='col'>Marca</th>
					<th scope='col'>Ubicacion</th>
					<th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($equipos);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">	
					<td><input class='ingresoRemito' type='checkbox' id="<?php echo $equipos[$i]->id ?>" name='equipos_seleccionados[]' value="<?php echo $equipos[$i]->id ?>"><input type="hidden" name="equipos[]" value="<?php echo $equipos[$i]->id ?>"></td>					
					<td> <?php echo $equipos[$i]->numero;?></td>
					<td><input type='hidden' name='capacidad[]'value="<?php echo $equipos[$i]->capacidad;?>"> <?php echo $equipos[$i]->capacidad;?></td>
					<td><input class='price' type='number' value='<?php echo $equipos[$i]->horas;?>' step='any' name='horas[]' style='width: 80px;' readonly></td>
					<td style="width: 150px;"> <?php echo $equipos[$i]->marca;?></td>
					<td style="width: 150px;"> <?php echo strtoupper($equipos[$i]->ubicacion);?></td>
					<td style="width: 150px;"> <?php echo strtoupper($equipos[$i]->estado);?></td>				
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		</div>
	</div>

	<script type="text/javascript">
					$(document).ready(function(){

						var tipo = document.getElementById('tipo');


						tipo.addEventListener('input',function(){

							var tipoRemito = tipo.value;	
							
							$("#tablaEquipos>tbody").empty();

							$.post("nuevo_remito/salida",{tipoRemito: tipoRemito},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								if (tipoRemito == "salida"){
									json.forEach(function(value,label){
										cont++;
										$("#tablaEquipos>tbody").append("<tr class='listado__row'><td><input class='ingresoRemito' type='checkbox' id="
											+json[label].id+" name='equipos_seleccionados[]' value="
											+json[label].id+"><input type='hidden' name='equipos[]' value="
											+json[label].id+"></td>"
											+"<td>"+json[label].numero+"</td>"
											+"<td>"+json[label].capacidad+"<input type='hidden' name='capacidad[]'value="+json[label].capacidad+"></td>"
											+"<td><input class='price' type='number' min='"
											+json[label].horas+"' step='any' name='horas[]' value='"
											+json[label].horas+"' style='width: 80px;' readonly></td>"
											+"<td style='width: 150px;'>"+ json[label].marca+"</td>"
											+"<td style='width: 150px;'>"+ json[label].ubicacion.toUpperCase()+"</td>"
											+"<td style='min-width: 130px;'>"+ json[label].estado.toUpperCase()+"</td>"
											+"</tr>");

										
									});
								}else{
									json.forEach(function(value,label){
										cont++;
										$("#tablaEquipos>tbody").append("<tr class='listado__row'><td><input class='ingresoRemito' type='checkbox' id="
											+json[label].id+" name='equipos_seleccionados[]' value="
											+json[label].id+"><input type='hidden' name='equipos[]' value="
											+json[label].id+"></td>"
											+"<td scope='row'	>"+json[label].numero+"</td>"
											+"<td>"+json[label].capacidad+"<input type='hidden' name='capacidad[]'value="+json[label].capacidad+"></td>"
											+"<td><input class='price' type='number' min='"
											+json[label].horas+"' step='any' name='horas[]' value='"
											+json[label].horas+"' style='width: 80px;'></td>"
											+"<td style='width: 150px;'>"+ json[label].marca+"</td>"
											+"<td>"+ json[label].ubicacion.toUpperCase()+"</td>"
											+"<td style='min-width: 100px;'>"+ json[label].estado.toUpperCase()+"</td>"
											+"</tr>");	
								
									});
								}		
							});

						});
					});
		</script> 

</form>					


