	<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

	?>	
	<form method="POST" action="<?php echo site_url('equipo/nueva_orden/guardar'); ?>" id="nuevaOrden">
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
					<input type="date" class="input-field" placeholder="Fecha:" form="nuevaOrden" id="fecha" name="fecha" maxlength="300" value="<?php echo $today ?>" required>

					
				</div>
				<div class="input-container">
					<i class="fa-solid fa-charging-station icon"></i>
					<select name="equipo" id="equipo">
						<option value="">Seleccione el equipo.....</option>
					  	<?php
					  	$arrayLength = count($equipos);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $equipos[$i]->id;?>'><?php echo "N°:".$equipos[$i]->numero." / ".$equipos[$i]->capacidad;?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
				

			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Observaciones:" form="nuevaOrden" id="descripcion" name="descripcion"></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-gears icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Repuestos:" form="nuevaOrden" id="repuestos" name="repuestos"></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-file-invoice-dollar icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Cargos al Cliente:" form="nuevaOrden" id="cargos" name="cargos"></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="number" name="horas" id="horas" step="1" min="" value="">	
				</div>
			
				<div class="input-container">
					<i class="fa-regular fa-clipboard icon"></i>
					<select name="remitos" id="remitos" required>
						<option value="">Seleccione remito.....</option>
					</select>
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="icon"></i>
					<input type="submit" class="btn btn-register" form="nuevaOrden" style="margin-left: 40px; width: 120px;" name = "button" value="Guardar">
					<input type="submit" class="btn btn-register" form="nuevaOrden" style="margin-left: 40px; width: 120px;" name = "button" value="Guardar y cerrar">
				</div>
				<div class="input-container">
					
				</div>
			</div>
			
		</div>

		<div class="container registros2">
			<table class='listado' id="tablaEquipos">
			<thead>
				<tr class="listado__encabezado">
					<th scope='col' style="width: 80px;">Fecha</th>
					<th class="listado__fecha" scope='col'>Remito </th>
					<th class="listado__usuario" scope='col'>Horas </th>
					<th scope='col'>Cliente</th>
					<th scope='col' style="width: 130px;">Transporte</th>
					<th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
		</div>
	</div>
	</form>


	<script type="text/javascript">
		$(document).ready(function(){
			var equipo = document.getElementById("equipo");
			var remitos = document.getElementById("remitos");
			equipo.addEventListener('input',function(){
				
				var idEquipo = equipo.value;				
				$("#tablaEquipos>tbody").empty();
				$("#remitos").empty();
				$.post("nueva_orden/equipo",{idEquipo: idEquipo},function(result){	
								
					var cont = 0;
					var json = JSON.parse(result);

					remitosList = json.remitos;
					console.log(remitosList);
					remitosList.forEach(function(value,label){
						$("#remitos").append("<option>"+value.id+"</option>");

					});
					equipos = json.equipo;
					equipos.forEach(function(value,label){
						// alert(equipos[label].fecha)
						$("#tablaEquipos>tbody").append("<tr class='listado__row'>"
							+"<td style='width: 120px;'>"+equipos[label].fecha+"</td>"
							+"<td><a href='"+json.remitos_url+equipos[label].remito+"'>"+
							equipos[label].remito+"</td>"
							+"<td>"+equipos[label].horas+"</td>"
							+"<td>"+ equipos[label].ubicacion+"</td>"
							+"<td>"+ equipos[label].transporte+"</td>"
							+"<td>"+ equipos[label].tipo+"</td>"
							+"</tr>");

						
					});
				})
			});

		});
	</script>					
	

