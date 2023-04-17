<body class="bodyGray">
	<div class="layout">	
		<header class="header">
			<nav class="nav-bar">
				<ul class="menu__logo" ><img src="<?php echo base_url(); ?>/images/logo.jpg"></ul>
				<div class="dropdown__toggle" id="toggleNav">
					<i class="fa-solid fa-bars"></i>
				</div>
				<ul class="menu__item" >
					<li class="dropdown__item invisible <?php echo($active[0]); ?>" id="home"><i class="fa-solid fa-house"></i><a href="<?php echo base_url(); ?>/home">INICIO</a></li> 
					<li class="dropdown__item invisible <?php echo($active[1]); ?>" id="compras">
						<i class="fa-solid fa-bolt"></i><a href="<?php echo base_url(); ?>/equipos/" >  EQUIPOS</a>
					</li>
					<li class="dropdown__item invisible <?php echo($active[2]); ?>" id="ventas">
						<i class="fa-solid fa-money-check-dollar"></i><a href="<?php echo base_url(); ?>/ventas/">VENTAS</a>
					</li>
					<li class="dropdown__item invisible <?php echo($active[3]); ?>" id="rrhh">
						<i class="fa-solid fa-people-group"></i><a href="<?php echo base_url(); ?>/rrhh/">RRHH</a>
					</li>
				</ul>
				
				<div class="menu__logout">
					<form method="POST" action="<?php echo site_url('logout'); ?>">
						<button class="logout" type="submit" name="button_logout"><i class="fa-solid fa-right-to-bracket"></i> Logout</button>
					</form>
				</div>
			</nav>
		</header>