	<?php
		if (!empty($message)){
            echo ("<script>
                alert('".$message."')</script>");
		}

	?>	
	<form method="POST" action="<?php echo site_url('equipo/ordenes_abiertas/guardar'); ?>" id="nuevaOrden">
		<div class="grid2x1">
		<div class="container registros">
			<div class="column">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  CERRAR ORDEN: </h3>
				</div>
			</div>

			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-hashtag icon"></i>
					<input type="number" form="nuevaOrden" name="numero_orden" id="numero_orden" value="" readonly>
				</div>
				<div class="input-container">
					<i class="fa-regular fa-calendar icon"></i>
					<input type="date" class="input-field" placeholder="Fecha:" form="nuevaOrden" id="fecha" name="fecha" maxlength="300" value="<?php echo $today ?>" required>
					<input type="hidden" class="input-field" id="equipo" name="equipo" value="">
					
				</div>
				<div class="input-container">
					<i class="fa-solid fa-charging-station icon"></i>
					<select name="id_orden" id="orden" autofocus>
						<option value="">Seleccione el equipo.....</option>
					  	<?php
					  	$arrayLength = count($ordenes);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $ordenes[$i]->id;?>'><?php echo "N°:".$ordenes[$i]->equipo." / ".$ordenes[$i]->marca;?></option>
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
					<select name="remitos" id="remitos">
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
			var orden_element = document.getElementById("orden");
			var numero_element = document.getElementById("numero_orden");
			var descripcion_element = document.getElementById("descripcion");
			var repuestos_element = document.getElementById("repuestos");
			var remitos = document.getElementById("remitos");
			var equipo_element = document.getElementById("equipo");
			var horas_element = document.getElementById("horas");

			orden_element.addEventListener('input',function(){
				
				var idOrden = orden_element.value;				
				$("#tablaEquipos>tbody").empty();
				$("#remitos").empty();
				$.post("ordenes_abiertas/equipo",{idOrden: idOrden},function(result){	
								
					var cont = 0;
					var json = JSON.parse(result);
					var orden = json.orden;
					numero_element.value = orden[0].id;
					descripcion_element.value = orden[0].descripcion;
					repuestos_element.value = orden[0].repuestos;
					equipo_element.value = orden[0].id_equipo;
					horas_element.value = orden[0].horas;
					horas_element.setAttribute("min",orden[0].horas);
					console.log(json);
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
	

