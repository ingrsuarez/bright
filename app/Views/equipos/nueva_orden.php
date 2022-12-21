		
	<form method="POST" action="<?php echo site_url('equipo/ingresar'); ?>" id="nuevaOrden">
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
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="cliente" id="cliente">
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
					</select>

				</div>
				

			</div>

			<div class="column">
				<div class="input-container">
					<i class="icon"></i>
					<input type="submit" class="btn btn-register" form="nuevaOrden" style="margin-left: 40px; width: 120px;" value="Generar orden">
				</div>
				<div class="input-container">
					
				</div>
			</div>
			
		</div>

		<div class="container registros2">
			<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
					<th class="listado__fecha" style="width: 30px;">#</th>
					<th class="listado__fecha" scope='col'>Número </th>
					<th class="listado__usuario" scope='col'>Capacidad </th>
					<th scope='col'>Marca</th>
					<th scope='col'>Cantidad</th>
					<th scope='col' style="width: 130px;">Precio unitario</th>
					<th scope='col'>TOTAL:</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($equipos);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">	
					<td><input class='form-check-input' type='checkbox' id="<?php echo $equipos[$i]->id ?>" name='OC_check[]' value="<?php echo $equipos[$i]->id ?>"></td>					
					<td class="listado__fecha"> <?php echo $equipos[$i]->numero;?></td>
					<td> <?php echo $equipos[$i]->capacidad;?></td>
					<td style="width: 150px;"> <?php echo ucfirst($equipos[$i]->marca);?></td>
					<td > <input class="price" type="number" min="1" step="1" name="cantidad" value="" style="width: 40px;"></td>
					<td > <span class="price">$<input class="price" type="number" min="1" step="any" name="precio" value="" style="width: 80px;"></span></td>
					<td style="width: 150px;"> <span class="price">$<input class="price" type="number" min="1" step="any" name="total" value="" style="width: 80px;" readonly></span></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		</div>
	</div>
	</form>


	<script type="text/javascript">
		const menu1 = document.getElementById("inventario");

		
	</script>					
	

