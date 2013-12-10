
<body>

    <div class="out-container">
        <div class="header">
            <div class="top">
                <div class="in">
                    <ul class="right_menu">
                        <li class="menu uno"><a class="uno" href="https://Intranet.senaf.gob.ar" target="_blank"> Intranet </a></li>
                        <li class="menu dos"><a class="dos" href="https://correo.senaf.gob.ar/exchange" target="_blank"> Mail </a></li>
                        <li class="menu tres"><a class="tres" href="#" target="_blank"> Información </a></li>
                        <li class="menu cuatro"><a class="cuatro" href="#" target="_blank"> Ayuda (F1) </a></li>
                    </ul>
                    <div class="bottom_menu">
                        <div class="logo">
                            <a href="<?php echo site_url('homepage');?>">
                                <img class="logo_image" src=" <?php echo ASSETS . 'frontend/images/icono-stock.png'; ?>" alt="stock" title="Stock" width="72" height="50" />
                            </a>
                            <!-- SUMINISTROS -->
                        </div>
                        <ul class="menu_principal">
                            <li> <a href="<?php echo site_url('productos/add');?>">Alta de Productos </a></li>
                            <li> <a href="<?php echo site_url('stock_actual/listar');?>">Stock Actual </a></li>
                            <li> <a href="<?php echo site_url('entrada_stock/nueva_entrada');?>">Entrada de Stock </a></li>
                            <li> <a href="#">Salida de Stock </a></li>
                            <li> <a href="<?php echo site_url('remitos/agregar');?>">Remitos </a></li>
                            <li> <a href="#">Consultas </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="in">
                    <h1> Control de Stock   &nbsp;&nbsp;&nbsp;<span style="color: #D82133;">[ <?php echo $title_section; ?> ]</span> </h1>
                    <?php if (isset( $login ) && $login): ?>
                        <div class="logout">
                            <a href="<?php echo site_url('login/salir');?>" > S A L I R </a>
                        </div>
                    <?php else: ?>
                        <div class="login">
                            <a href="<?php echo site_url('login');?>" > I N G R E S A R </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>