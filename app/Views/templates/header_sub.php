<body>
		
	<header class="header">
		<nav class="menu">
			<ul class="menu__logo" ><img src="<?php echo base_url(); ?>/images/logo.jpg"></ul>
			<ul class="menu__item" >
				<li class="dropdown__item dropdown__item--active" id="home"><a href="<?php echo base_url(); ?>/home">INICIO</a></li> 
				<li class="dropdown__item" id="compras">
					<i class="fa-solid fa-bolt"></i><a href="<?php echo base_url(); ?>/equipos/" >  EQUIPOS</a>
				</li>
				<li class="dropdown__item" id="contacto">
					<i class="fa-solid fa-people-group"></i><a href="<?php echo base_url(); ?>index.php/rrhh/panel/">RRHH</a>
				</li>
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			
			<div class="sesion">
				<form method="POST" action="<?php echo site_url('logout'); ?>">
					<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
				</form>
			</div>
		</nav>
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
							<a href="#">Editar Equipo</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="mantenimiento">
					<a href="#" >MANTENIMIENTO</a>
					<ul class="inside__menu" id="mantenimiento__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/nuevo_reporte/">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>

						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_reportes/">Listado de Ordenes</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/nueva_reunion/">Estado equipos</a>
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
					<a href="#">ORDEN DE TRABAJO</a>
					<ul class="inside__menu" id="orden_trabajo__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/orden_trabajo/">Nueva Orden</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_ordenes/">Listado de Ordenes</a>
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
							<a href="<?php echo base_url(); ?>index.php/registros/insertar_documento/">Subir documento</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>index.php/registros/listado_documentos/">Listado de documentos</a>
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