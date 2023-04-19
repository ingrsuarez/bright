

<div class="container_registro medium">
	<form method="POST" action="<?php echo site_url('ventas/modificar_cliente/'.$cliente[0]->id); ?>" id="editarCliente">	
		<div class="titulo">
			<h3> <i class="fa-solid fa-pen-to-square"></i> EDITAR CLIENTE: </h3>
			
		</div>
		<div class="row">
			
			<div class="input-container">
				<i class="fa-solid fa-tag icon"></i>
				<input type="text" class="input-field" placeholder="Nombre:" form="editarCliente" id="nombre" name="nombre" value="<?php echo $cliente[0]->nombre;?>" maxlength="300" autofocus required>
				<input type="hidden" form="editarCliente" id="id" name="id" value="<?php echo $cliente[0]->id;?>">	
			</div>
			
		</div>
		<div class="row">
			
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<input type="text" class="input-field" placeholder="Cuit:" form="editarCliente" id="cuit" name="cuit" value="<?php echo ucfirst($cliente[0]->cuit);?>" maxlength="300" required>

				
			</div>
			
		</div>
		<div class="row">
			
			<div class="input-container">
				<i class="fa-regular fa-envelope icon"></i>
				<input type="text" class="input-field" placeholder="Email:" form="editarCliente" id="email" name="email" value="<?php echo $cliente[0]->email;?>"maxlength="300">

				
			</div>
			
		</div>
		<div class="row">
			
			<div class="input-container">
				<i class="fa-solid fa-phone icon"></i>
				<input type="text" class="input-field" placeholder="Telefono:" form="editarCliente" id="telefono" name="telefono" value="<?php echo $cliente[0]->telefono;?>" maxlength="300" required>
			</div>
	
			<div class="input-container">
				<i class="fa-solid fa-location-dot icon"></i>
				<input type="text" class="input-field" placeholder="Domicilio:" form="editarCliente" id="domicilio" name="domicilio" value="<?php echo $cliente[0]->domicilio;?>" required>
			</div>

		</div>
		<div class="row">
			
			<div class="input-container">
				<i class="far fa-address-card icon"></i>
				<select class="select-field" id="iva" name="iva" required>
					<option selected value="<?php echo $cliente[0]->iva;?>"> <?php echo $cliente[0]->iva;?> </option>
					<option value='inscripto'> INSCRIPTO </option>
					<option value='monotributo'> MONOTRIBUTO </option>
					<option value='exento'> EXENTO </option>
				</select>
			</div>
			

		</div>
		<div class="row">
			<div class="input-container">
				<i class="icon"></i>
				<input type="submit" class="btn btn-register" form="prevCliente" style="margin-left: 40px; width: 100px;" value="<">
			</div>
			<div class="input-container">		
				<input type="submit" class="btn btn-register" form="editarCliente" style="margin-left: 40px; width: 100px;" value="Editar">
			</div>
			<div class="input-container">
				<input type="submit" class="btn btn-register" form="nextCliente" style="margin-left: 40px; width: 100px;" value=">">
			</div>
			
		</div>
	</form>		
</div>
	
<?php 
$next = intval($cliente[0]->id)+1;
$prev = intval($cliente[0]->id)-1;
		?>				
<form method="POST" action="<?php echo site_url('ventas/editar_cliente/'.$next); ?>" id="nextCliente">
</form>
<form method="POST" action="<?php echo site_url('ventas/editar_cliente/'.$prev); ?>" id="prevCliente">
</form>

