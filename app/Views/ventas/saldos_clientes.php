	
<form method="POST" action="<?php echo site_url('ventas/saldos_clientes'); ?>" id="saldoCliente">
	<div class="grid2x1">
		<div class="container registros">
			<div class="column">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  ESTADOS DE CUENTA: </h3>
				</div>
			</div>

			<div class="column">
				
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
				
				<div class="input-container">
<!-- 					<i class="fa-solid fa-building-flag icon"></i>
					<select name="tipo" id="tipo" required>
						<option value="salida">Salida</option>
						<option value="retorno">Retorno</option>
					</select> -->	
				</div>
			</div>
			<div class="column">
				
				<div class="input-container">
					<!-- <i class="icon"></i> -->
					<!-- <input type="submit" class="btn btn-register" form="ingresoRemito" style="margin-left: 40px; width: 120px;" value="Generar Remito"> -->
				</div>
				
			</div>
			
		</div>

		<div class="container registros2">
			<table class='listado' id="tablaSaldo">
			<thead>
				<tr class="listado__encabezado">
					<th class="listado__fecha" style="width: 40px;">#</th>
					<th class="listado__fecha">Fecha </th>
					<th class="listado__fecha">Remito </th>
					<th scope='col'>Cliente </th>
					<th scope='col'>Precio</th>
					<th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($historial);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">	
					<td><input class='ingresoRemito' type='checkbox' id="<?php echo $historial[$i]->remito ?>" name='equipos_seleccionados[]' value="<?php echo $historial[$i]->remito ?>"><input type="hidden" name="equipos[]" value="<?php echo $historial[$i]->remito; ?>"></td>					
					<td class="listado__fecha" style="width: 380px;"> <?php echo $historial[$i]->fecha;?></td>
					<td><input type='hidden' name='capacidad[]'value="<?php echo $historial[$i]->remito; ?>"> <?php echo $historial[$i]->remito; ?></td>
					<!--<td><input class='price' type='number' value='<?php ?>' step='any' name='horas[]' style='width: 80px;' readonly></td> -->
					<td style="width: 150px;"> <?php echo strtoupper($historial[$i]->cliente); ?></td>
					<td style="width: 150px;"> <?php echo $historial[$i]->precio;?></td>
					<td style="width: 150px;"> <?php echo strtoupper($historial[$i]->estado);?></td>				
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

						var cliente = document.getElementById('cliente');


						cliente.addEventListener('input',function(){

							var idCliente = cliente.value;	
							
							$("#tablaSaldo>tbody").empty();

							$.post("saldos_clientes/saldo",{idCliente: idCliente},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tablaSaldo>tbody").append("<tr class='listado__row'><td><input class='ingresoRemito' type='checkbox' id="
										+json[label].remito+" name='equipos_seleccionados[]' value="
										+json[label].remito+"><input type='hidden' name='equipos[]' value="
										+json[label].remito+"></td>"
										+"<td class='listado__fecha'>"+json[label].fecha+"</td>"
										+"<td><a href='"+window.location.href.slice(0,-15)+"pdfRemito/"+json[label].remito+"'>"+json[label].remito.padStart(4, '0')+"</a></td>"
										+"<td style='width: 250px;'>"+json[label].cliente.toUpperCase()+"</td>"
										+"<td style='width: 150px;'>"+json[label].precio+"</td>"
										+"<td style='width: 150px;'>"+ json[label].estado.toUpperCase()+"</td>"
										+"</tr>");
										
									});		
							});

						});
					});
		</script> 

</form>					


