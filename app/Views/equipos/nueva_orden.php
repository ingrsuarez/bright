	<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

	?>
	<div class="container_registro medium">	
		<form method="POST" action="<?php echo site_url('equipo/nueva_orden/guardar'); ?>" id="nuevaOrden">
		
			<div class="titulo">
				<h3><i class="fas fa-tasks"></i>  NUEVA ORDEN DE MANTENIMIENTO: </h3>
			</div>

			<div class="row">
				<div class="input-container">
					<i class="fa-regular fa-calendar icon"></i>
					<input type="date" class="input-field" placeholder="Fecha:" form="nuevaOrden" id="fecha" name="fecha" maxlength="300" value="<?php echo $today ?>" required>
				</div>
				<div class="input-container">
					<i class="fa-solid fa-charging-station icon"></i>
					<select name="equipo" id="equipo" autofocus>
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
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<textarea type="text" class="input-field"  placeholder="Observaciones:" form="nuevaOrden" id="descripcion" name="descripcion"></textarea>	
					<span class="tooltiptext">Observaciones</span>
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-gears icon"></i>
					<textarea type="text" class="input-field"  placeholder="Repuestos:" form="nuevaOrden" id="repuestos" name="repuestos"></textarea>	
					<span class="tooltiptext">Repuestos</span>
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-file-invoice-dollar icon"></i>
					<textarea type="text" class="input-field"  placeholder="Cargos al Cliente:" form="nuevaOrden" id="cargos" name="cargos"></textarea>
					<span class="tooltiptext">Cargos al cliente</span>	
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="number" name="horas" id="horas" step="1" min="" value="">
					<span class="tooltiptext">Horas de trabajos</span>	
				</div>
			
				<div class="input-container">
					<i class="fa-regular fa-clipboard icon"></i>
					<select name="remitos" id="remitos">
						<option value="">Seleccione remito.....</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="input-container">
					<i class="icon"></i>
					<input type="submit" class="btn btn-register" form="nuevaOrden" name = "button" value="Guardar">
					<input type="submit" class="btn btn-register" form="nuevaOrden" name = "button" value="Guardar y cerrar">
				</div>
				<div class="input-container">
					
				</div>
			</div>
		</form>	
	</div>
	
	<div class="container_tabla medium">
		<div class="titulo">
			<h3><i class="fas fa-tasks"></i>  MOVIMIENTOS: </h3>
		</div>
		<table class='listado' id="tablaEquipos">
			<thead>
				<tr class="listado__encabezado">
					<th>Fecha</th>
					<th scope='col'>Remito </th>
					<th class='extra' scope='col'>Horas </th>
					<th scope='col'>Cliente</th>
					<th class='extra' scope='col'>Transporte</th>
					<th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
	


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
					// console.log(remitosList);
					remitosList.forEach(function(value,label){
						$("#remitos").append("<option>"+value.numero+"</option>");

					});
					equipos = json.equipo;
					equipos.forEach(function(value,label){
						// alert(equipos[label].fecha)
						$("#tablaEquipos>tbody").append("<tr class='listado__row'>"
							+"<td>"+equipos[label].fecha+"</td>"
							+"<td class='center'><a href='"+json.remitos_url+equipos[label].remito+"'>"+
							equipos[label].remito+"</td>"
							+"<td class='center extra'>"+equipos[label].horas+"</td>"
							+"<td>"+ equipos[label].ubicacion+"</td>"
							+"<td class='extra'>"+ equipos[label].transporte+"</td>"
							+"<td>"+ equipos[label].tipo+"</td>"
							+"</tr>");

						
					});
				})
			});

		});
	</script>					
	

