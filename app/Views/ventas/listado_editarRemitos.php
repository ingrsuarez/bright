	<div class="container tabla">
		<div class="container_title">
			<h3><i class="fas fa-tasks"></i>  LISTADO DE REMITOS: </h3>
		</div>
		<table class='listado'>
			<thead>
				<tr class="listado__encabezado">
				  <th scope='col'>Número</th>
				  <th scope='col'>Fecha</th>
				  <th scope='col'>Cliente</th>
				  <th scope='col'>Emisor</th>
				  <th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($remitos);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td><a href="<?php echo site_url("/ventas/listado_editarRemitos/".$remitos[$i]->id);?>"><?php echo str_pad($remitos[$i]->id,4,"0",STR_PAD_LEFT);?></a> </td>
					<td class="listado__fecha"> <?php echo  $remitos[$i]->fecha;?></td>
					<td> <?php echo strtoupper($remitos[$i]->cliente);?></a></td>
					<td> <?php echo $remitos[$i]->usuario;?></td>
					<td> <?php echo $remitos[$i]->estado;?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

