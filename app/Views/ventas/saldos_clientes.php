	

	
<div class="container_registro large">
	<form method="POST" action="<?php echo site_url('ventas/saldos_clientes'); ?>" id="saldoCliente">
			<div class="titulo">
				<h3><i class="fas fa-tasks"></i>  ESTADOS DE CUENTA: </h3>
			</div>

			<div class="row">
				
				<div class="input-container">
					<i class="fa-solid fa-building-flag icon"></i>
					<select name="cliente" id="cliente" autofocus required>
						<option value="">Seleccione el cliente.....</option>
					  	<?php
					  	$arrayLength = count($clientes);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $clientes[$i]->id;?>'><?php echo strtoupper(substr($clientes[$i]->nombre,0,22));?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
				
			</div>
	</form>		
</div>

		<div class="container_tabla">
			<div class="titulo">
				<h3><i class="fas fa-tasks"></i>  HISTORICO: </h3>
			</div>
			<table class='listado' id="tablaSaldo">
			<thead>
				<tr class="listado__encabezado">
					<th class="center">Fecha </th>
					<th class="listado__fecha">Remito </th>
					<th scope='col'>Cliente </th>
					<th scope='col'>Precio</th>
					<th scope='col'>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			$arrayLength = count($historial);
			$i = 0;
			while ($i < $arrayLength) {?>
				<tr class="listado__row">						
					<td class="center"> <?php echo $historial[$i]->fecha;?></td>
					<td class="center"><input type='hidden' name='capacidad[]'value="<?php echo $historial[$i]->remito; ?>"> <?php echo $historial[$i]->remito; ?></td>
					<td> <?php echo strtoupper($historial[$i]->cliente); ?></td>
					<td> <?php echo $historial[$i]->precio;?></td>
					<td> <?php echo strtoupper($historial[$i]->estado);?></td>				
				</tr><?php
				$i++;
				}
				 ?>	  
			</tbody>
		</table>
	</div>
	

	<script type="text/javascript">
					$(document).ready(function(){

						var cliente = document.getElementById('cliente');


						cliente.addEventListener('input',function(){

							var idCliente = cliente.value;	
							
							$("#tablaSaldo>tbody").empty();

							$.post("saldos_clientes/saldo",{idCliente: idCliente},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);

								json.forEach(function(value,label){
									cont++;
									$("#tablaSaldo>tbody").append("<tr class='listado__row'>"
										+"<td class='center'>"+json[label].fecha+"</td>"
										+"<td class='center'><a href='"+window.location.href.slice(0,-15)+"pdfRemito/"+json[label].remito+"'>"+json[label].remito.padStart(4, '0')+"</a></td>"
										+"<td>"+json[label].cliente.toUpperCase()+"</td>"
										+"<td>"+json[label].precio+"</td>"
										+"<td>"+ json[label].estado.toUpperCase()+"</td>"
										+"</tr>");
										
									});		
							});

						});
					});
		</script> 

</form>					


