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
					<i class="fa-solid fa-people-group"></i><a href="<?php echo base_url(); ?>/rrhh/">RRHH</a>
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
