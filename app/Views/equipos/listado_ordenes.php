	<div class="container_tabla">
		<div class="titulo">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE ORDENES: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Fecha </th>
				  <th class="listado__usuario" scope='col'>Equipo </th>
				  <th class="extra">Marca </th>
				  <th>Descripcion</th>
				  <th>Repuestos</th>
				  <th>Usuario</th>
				  <th class="extra">Remito</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($ordenes);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="center"> <?php echo $ordenes[$i]->fecha;?></td>
					<td class="center"> <?php echo $ordenes[$i]->equipo;?></td>
					<td class="extra"> <?php echo $ordenes[$i]->marca;?></td>
					<td> <?php echo ucfirst($ordenes[$i]->descripcion);?></td>
					<td> <?php echo ucfirst($ordenes[$i]->repuestos);?></td>
					<td> <?php echo strtoupper($ordenes[$i]->usuario);?></td>
					<td class="extra"> <?php echo str_pad($ordenes[$i]->remito,4,"0",STR_PAD_LEFT);?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

