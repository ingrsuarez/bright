
		
	
		<nav class="menu_sub">
			<div class="menu__logo2" ><a href="#"><i class="fa-solid fa-oil-well"></i></a></div>
			<ul class="menu__item" >
				
				<li class="dropdown__item2" id="remito">
					<a href="#" >REMITOS</a>
					<ul class="inside__menu" id="remito__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/ventas/nuevo_remito/">Nuevo Remito</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/ventas/listado/">Listado de remitos</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="#">Editar Remito</a>
						</li>
					</ul>
				</li>
				<li class="dropdown__item2" id="presupuesto">
					<a href="#" >PRESUPUESTOS</a>
					<ul class="inside__menu" id="presupuesto__inside">
						<li class="inside__item">
							<a href="#">Nuevo presupuesto</a>
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
				<li class="dropdown__item2" id="clientes">
					<a href="#">CLIENTES</a>
					<ul class="inside__menu" id="clientes__inside">
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/ventas/nuevo_cliente/">Nuevo cliente</a>
						</li>
						<li class="inside__item">
							<a href="<?php echo base_url(); ?>/ventas/listado_clientes/">Listado de Clientes</a>
						</li>
						<li class="inside__item">
							<hr class="dropdown__divider">
						</li>
						<li class="inside__item">
							<a href="#">Editar cliente</a>
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
					</ul>
				</li>
				<div class="dropdown__toggle" id="toggle">
					<i class="fa-solid fa-bars"></i>
				</div>
			</ul>
			<div class="menu__logo" ></div>
		</nav>
<script type = 'text/javascript' src = "<?php echo base_url();?>/js/menuVentasJava.js"></script>	
</header>