	<div class="container tabla">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE PERSONAL: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Nombre </th>
				  <th scope='col'>Apellido </th>
				  <th scope='col'>DNI</th>
				  <th scope='col'>Domicilio</th>
				  <th scope='col'>Fecha de ingreso</th>
				  <th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($usuarios);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="listado__fecha"> <?php echo $usuarios[$i]->nombre;?></td>
					<td> <?php echo $usuarios[$i]->apellido;?></td>
					<td> <?php echo $usuarios[$i]->dni;?></td>
					<td> <?php echo $usuarios[$i]->domicilio;?></td>
					<td> <?php echo $usuarios[$i]->fecha_ingreso;?></td>
					<td> <?php echo $usuarios[$i]->estado;?></td>						
				</tr><?php
				$i++;
				}
				?>	  
			</tbody>
		</table>
		

	</div>
	

