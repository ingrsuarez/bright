	<div class="container_tabla  medium">
		<div class="titulo">
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
					<td class="center"><a href="<?php echo site_url("/ventas/pdfRemito/".$remitos[$i]->id);?>"><?php echo str_pad($remitos[$i]->numero,4,"0",STR_PAD_LEFT);?></a> </td>
					<td class="center"> <?php echo  $remitos[$i]->fecha;?></td>
					<td> <?php echo strtoupper($remitos[$i]->cliente);?></a></td>
					<td class="center"> <?php echo $remitos[$i]->usuario;?></td>
					<td class="center"> <?php echo strtoupper($remitos[$i]->estado);?></td>						
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
		

	</div>
	

