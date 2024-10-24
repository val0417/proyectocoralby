<?php
require_once 'actualizar_datos.php';

$producto = new producto();
?>

<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <title>Coralby</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="app sidebar-mini">
    <header class="app-header">
        <a class="app-header__logo" href="pag.php">Coralby</a>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <!-- Add any additional navbar items here -->
        </ul>
    </header>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="dayana.jpg" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">Dayana Ortega</p>
                <p class="app-sidebar__user-designation">Administradora</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="pag.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Principal</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Productos</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="consultar.php"><i class="icon bi bi-circle-fill"></i>Inventario</a></li>
                    <li><a class="treeview-item" href="registrar.php"><i class="icon bi bi-circle-fill"></i> Registrar</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Clientes</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="consultar_cliente.php"><i class="icon bi bi-circle-fill"></i> Lista </a></li>
                    <li><a class="treeview-item" href="registrar_clientes.php"><i class="icon bi bi-circle-fill"></i> Registrar</a></li>
                    <li><a class="treeview-item" href="ventas_cliente.php"><i class="icon bi bi-circle-fill"></i> Ventas por cliente</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Factura</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="venta.php"><i class="icon bi bi-circle-fill"></i> Nueva Venta</a></li>
                    <li><a class="treeview-item" href="register_sale.php"><i class="icon bi bi-circle-fill"></i> Ventas </a></li>
                    <li><a class="treeview-item" href="ventas_dia.php"><i class="icon bi bi-circle-fill"></i> Ventas por fecha</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-envelope-at"><br></i>Coralby</h1>
                <p>Lo mejor en gestión de negocios</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item"><a href="#">Principal</a></li>
            </ul>
        </div>


        <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Bienvenida Dayana</h3>
            
            ¿QUE TE GUSTARÍA HACER HOY? <BR></BR>

            <li><a  href="venta.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Realizar una venta nueva</span></a></li>

            <li><a  href="consultar.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">¿Observar tu lista de Productos?</span></a></li>

            <li><a  href="ventas_cliente.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">¿o las ventas de cada cliente?</span></a></li>
            <br>
<h4>"Dayana, en cada transacción, no solo estas intercambiando productos por dinero; estas construyendo relaciones, creando experiencias y sembrando las semillas del éxito. Cada venta es una oportunidad para aprender y adaptarte, para superar desafíos y celebrar logros. Recuerda que, detrás de cada cifra, hay una historia y un sueño por cumplir. ¡Haz de cada venta un paso más hacia tus metas y nunca dejes de perseguir tus sueños!"
</h4>
</div>
          </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="tile p-0">
                    <h4 class="tile-title folder-head">Cantidad de productos agregados</h4>
                    <h3><p><?= $producto->Cantidad() ?></p></h3> 
                </div>
            </div>
        </div>




    </main>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    
    <script type="text/javascript">
      if (document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m) {
          i['GoogleAnalyticsObject'] = r;
          i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
          a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
          a.async = 1;
          a.src = g;
          m.parentNode.insertBefore(a,m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
</body>
</html>
