
		
	
		<nav class="menu_sub">
			<div class="menu__logo2" ><a href="#"><i class="fa-solid fa-oil-well"></i></a></div>
			<ul class="menu__item" >
				
				<li class="dropdown__item2" id="inventario">
					<a href="#" >INVENTARIO</a>
					<ul class="inside__menu" id="inventario__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipo/nuevo/">Ingresar Equipo</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipos/listado/">Listado de equipos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipos/editar/1">Editar Equipo</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="mantenimiento">
					<a href="#" >MANTENIMIENTO</a>
					<ul class="inside__menu" id="mantenimiento__inside">
						<li class="inside__item">
							<a href="#">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>

						<li class="inside__item">
							<a href="#">Listado de Ordenes</a>
						</li>
						<li class="inside__item">
							<a href="#">Estado equipos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="#"></a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="orden_trabajo">
					<a href="#">ORDEN DE SERVICIO</a>
					<ul class="inside__menu" id="orden_trabajo__inside">
						<li class="inside__item">
							<a href="#">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<a href="#">Listado de Ordenes</a>
						</li>
						<li class="inside__item">
							<a href="#">Cerrar Orden</a>
						</li>
					</ul>
				</li>
				
				
				<li class="dropdown__item2" id="documentos">
					<a href="#">DOCUMENTOS</a>
					<ul class="inside__menu" id="documentos__inside">
						<li class="inside__item">
							<a href="#">Subir documento</a>
						</li>
						<li class="inside__item">
							<a href="#">Listado de documentos</a>
						</li>
						<li class="inside__item">
							<a href="#">Servicio 3</a>
						</li>
					</ul>
				</li>
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			<div class="menu__logo" ></div>
		</nav>
<script type = 'text/javascript' src = "<?php echo base_url();?>/js/menuEquiposJava.js"></script>	
</header>