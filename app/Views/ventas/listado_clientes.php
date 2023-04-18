	<div class="container_tabla">
		<div class="titulo">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE CLIENTES: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th class="listado__fecha" scope='col'>Razón Social </th>
				  <th class="listado__usuario" scope='col'>Teléfono </th>
				  <th class="extra">Mail</th>
				  <th class="extra">Domicilio</th>
				  <th class="extra">Descuento</th>
				  <th class="extra">Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($clientes);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="listado__fecha"> <?php echo  strtoupper($clientes[$i]->nombre);?></td>
					<td><a href="https://api.whatsapp.com/send?phone=<?php echo $clientes[$i]->telefono;?>"><?php echo $clientes[$i]->telefono;?></a> </td>
					<td class="extra"> <a href="mailto:<?php echo $clientes[$i]->email;?>"><?php echo $clientes[$i]->email;?></a></td>
					<td class="extra"> <?php echo $clientes[$i]->domicilio;?></td>
					<td class="extra"> %<?php echo $clientes[$i]->descuento;?></td>
					<td class="extra"> <?php echo $clientes[$i]->estado;?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

