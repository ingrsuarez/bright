	<div class="container tabla">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE CLIENTES: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Razón Social </th>
				  <th class="listado__usuario" scope='col'>Teléfono </th>
				  <th scope='col'>Mail</th>
				  <th scope='col'>Domicilio</th>
				  <th scope='col'>Descuento</th>
				  <th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($clientes);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="listado__fecha"> <?php echo  strtoupper($clientes[$i]->nombre);?></td>
					<td><a href="https://api.whatsapp.com/send?phone=<?php echo $clientes[$i]->telefono;?>">+<?php echo $clientes[$i]->telefono;?></a> </td>
					<td> <a href="mailto:<?php echo $clientes[$i]->email;?>"><?php echo $clientes[$i]->email;?></a></td>
					<td> <?php echo $clientes[$i]->domicilio;?></td>
					<td> %<?php echo $clientes[$i]->descuento;?></td>
					<td> <?php echo $clientes[$i]->estado;?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

