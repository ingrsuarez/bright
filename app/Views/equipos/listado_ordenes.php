	<div class="container tabla">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE ORDENES: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Fecha </th>
				  <th class="listado__usuario" scope='col'>Equipo </th>
				  <th class="listado__usuario" scope='col'>Marca </th>
				  <th scope='col'>Descripcion</th>
				  <th scope='col'>Repuestos</th>
				  <th scope='col'>Usuario</th>
				  <th scope='col'>Remito</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($ordenes);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="listado__fecha"> <?php echo $ordenes[$i]->fecha;?></td>
					<td> <?php echo $ordenes[$i]->equipo;?></td>
					<td> <?php echo $ordenes[$i]->marca;?></td>
					<td> <?php echo ucfirst($ordenes[$i]->descripcion);?></td>
					<td> <?php echo ucfirst($ordenes[$i]->repuestos);?></td>
					<td> <?php echo strtoupper($ordenes[$i]->usuario);?></td>
					<td> <?php echo str_pad($ordenes[$i]->remito,4,"0",STR_PAD_LEFT);?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

