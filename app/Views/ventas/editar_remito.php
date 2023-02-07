	
<form method="POST" action="<?php echo site_url('ventas/editar_remito/'.$remito->id); ?>" id="editarRemito">
	<div class="grid2x1">
		<div class="container registros">
			<div class="column">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  EDITAR REMITO: <?php echo $remito->numero;?></h3>
				</div>
			</div>

			<div class="column">
				<div class="input-container">
					<i class="fa-regular fa-calendar icon"></i>
					<input type="date" class="input-field" placeholder="Fecha:" form="editarRemito" id="fecha" name="fecha" maxlength="300" value="<?php echo $remito->fecha?>" required>

					
				</div>
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="cliente" id="cliente" autofocus required>
						<option value="<?php echo $remito->id_cliente?>"><?php echo $remito->cliente;?></option>
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
				
				<div class="input-container">
					
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Observaciones:" form="editarRemito" id="leyenda" name="leyenda"><?php echo $remito->leyenda;?></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-truck-arrow-right icon"></i>
					<input type="number" class="input-field" placeholder="Kilometros:" form="editarRemito" id="kilometros" name="kilometros" value="<?php echo $remito->kilometros;?>">
				</div>
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="time" class="input-field" placeholder="Hora:" form="editarRemito" id="hora" name="hora" value="<?php echo $remito->hora;?>">
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-file-invoice-dollar icon"></i>
					<textarea type="text" class="input-field" rows="4" cols="80" placeholder="Cargos al Cliente:" form="editarRemito" id="cargos" name="cargos"><?php echo $remito->cargos;?></textarea>	
				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="tipo" id="tipo" required>
						<option value="<?php echo $remito->estado;?>"><?php echo $remito->estado;?></option>
						<option value="salida">Salida</option>
						<option value="retorno">Retorno</option>
						<option value="facturar">Facturar</option>
						<option value="facturado">Facturado</option>
						<option value="pagado">Cancelado</option>
					</select>	
				</div>
				
				<div class="input-container">
					<!-- <i class="icon"></i> -->
					<input type="submit" class="btn btn-register" form="editarRemito" style="margin-left: 40px; width: 120px;" value="Editar Remito">
				</div>
				
			</div>
			
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
										$("#tablaEquipos>tbody").append("<tr class='listado__row'><td><input class='editarRemito' type='checkbox' id="
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
										$("#tablaEquipos>tbody").append("<tr class='listado__row'><td><input class='editareditareditarRemito' type='checkbox' id="
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


