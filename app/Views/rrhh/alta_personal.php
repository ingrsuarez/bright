	
<form method="POST" action="<?php echo site_url('rrhh/alta_personal/send'); ?>" id="altaPersonal">
	
		<div class="container registros">
			<div class="column">
				<div class="register_title">
					<h3><i class="fas fa-tasks"></i>  ALTA PERSONAL: </h3>
				</div>
			</div>

			<div class="column">
				
				<div class="input-container">
					<i class="fa-solid fa-user icon"></i>
					<select name="personal" id="personal" autofocus required>
						<option value="">Seleccione el personal....</option>
					  	<?php
					  	$arrayLength = count($personal);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $personal[$i]->id;?>'><?php echo ucfirst($personal[$i]->nombre)." ".ucfirst($personal[$i]->apellido);?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
				<div class="column"></div>
				
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-diagram-project icon"></i>
					<select name="puesto" id="puesto" autofocus required>
						<option value="">Seleccione el puesto....</option>
					  	<?php
					  	$arrayLength = count($puestos);
						$i = 0;
						while ($i < $arrayLength) {?>
							<option value='<?php echo $puestos[$i]->id;?>'><?php echo ucfirst($puestos[$i]->nombre);?></option>
					 	<?php
						$i++;
						}
						?>	 
						
					</select>

				</div>
			</div>
			<div class="column">
				<div class="input-container">
					<i class="fa-solid fa-tag icon"></i>
					<input type="text" class="input-field" placeholder="Mail:" form="altaPersonal" id="mail" name="mail" style="width: 320px;" value="" required>
				</div>
			</div>
			<div class="column">
				
				<div class="input-container">
					<i class="fa-solid fa-clock icon"></i>
					<input type="number" class="input-field" placeholder="Horas semanales:" form="altaPersonal" id="horas" name="horas" value="" required>
				</div>
				<div class="input-container">
						
				</div>
			</div>
			<div class="column">
				
				<div class="input-container">
					<!-- <i class="icon"></i> -->
					<input type="submit" class="btn btn-register" form="altaPersonal" style="margin-left: 40px; width: 120px;" value="Enviar activacion">
				</div>
				<div class="input-container">
					
				</div>
				
			</div>
			
		</div>

		

	<script type="text/javascript">
					$(document).ready(function(){

						var personal_element = document.getElementById('personal');
						var	mail_element = document.getElementById('mail');	
						var horas_element = document.getElementById('horas');
						personal_element.addEventListener('input',function(){

							var personal_id = personal_element.value;	
							
							
							
							$.post("alta_personal/consulta",{personal_id: personal_id},function(result){	
								
								var cont = 0;
								
								var json = JSON.parse(result);
								
								mail_element.value = json[0].mail;
								horas_element.value = json[0].horas_semanales;
									
							});

						});
					});
		</script> 

</form>					


