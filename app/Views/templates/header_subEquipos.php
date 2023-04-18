
		
	
		<nav class="menu_sub">
			<div class="menu__logo2" ><a ><i class="fa-solid fa-oil-well"></i></a></div>
			<ul class="menu__item" >
				
				<li class="dropdown__item2" id="inventario">
					<a  >INVENTARIO</a>
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
					<a  >MANTENIMIENTO</a>
					<ul class="inside__menu" id="mantenimiento__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipo/nueva_orden">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipo/ordenes_abiertas">Ordenes Abiertas</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>

						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/equipos/listado_ordenes">Listado de Ordenes</a>
						</li>
						<li class="inside__item">
							<a >Estado equipos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a ></a>
						</li>
					</ul>
				</li>
				
				
				<li class="dropdown__item2" id="documentos">
					<a >DOCUMENTOS</a>
					<ul class="inside__menu" id="documentos__inside">
						<li class="inside__item">
							<a >Subir documento</a>
						</li>
						<li class="inside__item">
							<a >Listado de documentos</a>
						</li>
						<li class="inside__item">
							<a >Servicio 3</a>
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
