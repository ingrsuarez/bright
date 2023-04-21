	<div class="container_tabla">
		<div class="titulo">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE PERSONAL: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th scope='col'>Nombre </th>
				  <th scope='col'>Apellido </th>
				  <th scope='col'>DNI</th>
				  <th scope='col'>Teléfono</th>
				  <th class="extra">Domicilio</th>
				  <th scope='col'>Fecha de ingreso</th>
				  <th class="extra">Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($usuarios);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="left"> <?php echo $usuarios[$i]->nombre;?></td>
					<td class="left"> <?php echo $usuarios[$i]->apellido;?></td>
					<td> <?php echo $usuarios[$i]->dni;?></td>
					<td> <?php echo $usuarios[$i]->telefono;?></td>
					<td class="extra"> <?php echo $usuarios[$i]->domicilio;?></td>
					<td class="center"> <?php echo $usuarios[$i]->fecha_ingreso;?></td>
					<td class="center extra"> <?php echo $usuarios[$i]->estado;?></td>						
				</tr><?php
				$i++;
				}
				?>	  
			</tbody>
		</table>
		

	</div>
	

