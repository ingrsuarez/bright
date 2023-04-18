	<div class="container_tabla">
		<div class="titulo">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE EQUIPOS: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Número </th>
				  <th class="listado__usuario" scope='col'>Capacidad </th>
				  <th scope='col'>Marca</th>
				  <th class="extra" scope='col'>Horas</th>
				  <th class="extra" scope='col'>Ubicación</th>
				  <th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($equipos);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="center"> <?php echo $equipos[$i]->numero;?></td>
					<td> <?php echo $equipos[$i]->capacidad;?></td>
					<td> <?php echo ucfirst($equipos[$i]->marca);?></td>
					<td class="extra right"> <?php echo ucfirst($equipos[$i]->horas);?></td>
					<td class="extra center"> <?php echo strtoupper($equipos[$i]->ubicacion);?></td>
					<td class="center <?php if(strtoupper($equipos[$i]->estado) == "DISPONIBLE"){echo("success");}?>" > <?php echo strtoupper($equipos[$i]->estado);?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

