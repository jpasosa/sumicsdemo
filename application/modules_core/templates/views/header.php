
<body>
		<div class="out-container">
				<div class="header">
						<div class="top">
								<a href="<?php echo site_url('homepage');?>">
										<div class="image_ministerio">
												<img src="<?php echo ASSETS . 'frontend/images/ministerio2.png'; ?>" />
										</div>
								</a>
								<div class="in">
										<ul class="right_menu">
												<li class="menu uno"><a class="uno" href="https://Intranet.senaf.gob.ar" target="_blank"> Intranet </a></li>
												<li class="menu dos"><a class="dos" href="https://correo.senaf.gob.ar/exchange" target="_blank"> Mail </a></li>
												<li class="menu tres"><a class="tres" href="#" target="_blank"> Información </a></li>
												<li class="menu cuatro"><a class="cuatro" href="#" target="_blank"> Ayuda (F1) </a></li>
										</ul>
										<div class="bottom_menu">
												<!-- <div class="logo">
														<a href="<?php echo site_url('homepage');?>">
																<img class="logo_image" src=" <?php echo ASSETS . 'frontend/images/icono-stock.png'; ?>" alt="stock" title="Stock" width="72" height="50" />
														</a>
														SUMINISTROS
												</div> -->
												<ul class="menu_principal">
														<li> <a href="<?php echo site_url('productos/add');?>">ALTA DE PRODUCTOS </a></li>
														<li> <a href="<?php echo site_url('stock_actual/listar');?>">STOCK ACTUAL </a></li>
														<li> <a href="<?php echo site_url('entrada_stock/nueva_entrada');?>">INGRESOS </a></li>
														<li> <a href="<?php echo site_url('remitos/agregar');?>">REMITOS </a></li>
														<!-- <li> <a href="#">Consultas </a></li> -->
												</ul>
										</div>
								</div>
						</div>
						<div class="bottom">
							<div class="in">
								<div>
									<h1>
										Saramago 14.01   &nbsp;&nbsp;&nbsp;
										<span style="color: #D82133;">
											[ <?php echo $title_section; ?> ]
										</span>
										<?php if (isset( $login ) && $login): ?>
											<!-- OPCIONES DEL USUARIO -->
											<div class="dropdown perfil_usuario">
												<a data-toggle="dropdown" href="#">Bienvenido <?php echo $this->session->userdata('nombre'); ?> <b class="caret"></b></a>
												<ul class="dropdown-menu" role="menu">
													<li><a href="#">Perfil</a></li>
													<li><a href="#">Historial Acciones</a></li>
													<li role="presentation" class="divider"></li>
													<li><a href="<?php echo site_url('login/salir');?>">Salir</a></li>
												</ul>
											</div>
										<?php else: ?>
											<div class="login">
													<a href="<?php echo site_url('login');?>" > I N G R E S A R </a>
											</div>
										<?php endif; ?>
									</h1>
								</div>
							</div>
						</div>
				</div>















