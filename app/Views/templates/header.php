<body>
		
	<header class="header">
		<nav class="menu">
			<ul class="menu__logo" ><img src="<?php echo base_url(); ?>/images/logo.png"></ul>
			<ul class="menu__item" >
				<li class="dropdown__item dropdown__item--active" id="home"><a href="<?php echo base_url(); ?>/home">INICIO</a></li> 
				<li class="dropdown__item" id="compras">
					<i class="fa-solid fa-bolt"></i><a href="<?php echo base_url(); ?>/equipos/" >  EQUIPOS</a>
				</li>
				<li class="dropdown__item" id="procedimientos">
					<a href="<?php echo base_url(); ?>index.php/procedimientos/instructivos/">PROCEDIMIENTOS</a>
					<ul class="inside__menu" id="procedimientos__inside">
						<li class="inside__item">
							<a href="#">Pre-analítica</a>
						</li>
						<li class="inside__item">
							<a href="#">Analítica</a>
						</li>
						<li class="inside__item">
							<a href="#">Sistema</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="registros">
					<a href="<?php echo base_url(); ?>index.php/registros/circulares/" >REGISTROS</a>
					<ul class="inside__menu" id="servicios__inside">
						<li class="inside__item">
							<a href="#">Servicio 1</a>
						</li>
						<li class="inside__item">
							<a href="#">Servicio 2</a>
						</li>
						<li class="inside__item">
							<a href="#">Servicio 3</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item" id="contacto">
					<i class="fa-solid fa-people-group"></i><a href="<?php echo base_url(); ?>index.php/rrhh/panel/">RRHH</a>
				</li>
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			
			<div class="menu__logout">
				<form method="POST" action="<?php echo site_url('logout'); ?>">
					<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
				</form>
			</div>
		</nav>
	</header>