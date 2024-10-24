<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cli_id = $_POST['cli_id'];
    $pro_ids = $_POST['pro_id'];
    $cantidades = $_POST['cantidad'];

    try {
        // Registrar la factura
        $stmt = $pdo->prepare("INSERT INTO factura (cli_id, fec_enc_fecha, fac_enc_est) VALUES (?, NOW(), 'Pendiente')");
        $stmt->execute([$cli_id]);

        $fac_enc_id = $pdo->lastInsertId();

        for ($i = 0; $i < count($pro_ids); $i++) {
            $pro_id = $pro_ids[$i];
            $cantidad = $cantidades[$i];

            // Verificar la cantidad disponible del producto
            $stmt = $pdo->prepare("SELECT pro_cant, pro_pre FROM productos WHERE pro_id = ?");
            $stmt->execute([$pro_id]);
            $producto = $stmt->fetch();

            if ($producto && $producto['pro_cant'] >= $cantidad) {
                // Registrar los detalles de la factura
                $stmt = $pdo->prepare("INSERT INTO factura_det_pro (fac_enc_id, pro_id, fact_det_cant) VALUES (?, ?, ?)");
                $stmt->execute([$fac_enc_id, $pro_id, $cantidad]);

                // Actualizar la cantidad del producto
                $new_quantity = $producto['pro_cant'] - $cantidad;
                $stmt = $pdo->prepare("UPDATE productos SET pro_cant = ? WHERE pro_id = ?");
                $stmt->execute([$new_quantity, $pro_id]);
            } else {
                echo "Cantidad solicitada excede la cantidad disponible para el producto ID: $pro_id.";
                exit;
            }
        }

        // Redirigir al usuario para generar el PDF
        header("Location: generar_pdf.php?id=$fac_enc_id");
        exit; // Asegúrate de llamar a exit después de redirigir

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Registrar Venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Coralby</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <butt on class="app-search__button"><i class="bi bi-search"></i></button>
        </li>
    
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-login.html"><i class="bi bi-box-arrow-right me-2 fs-5"></i>Salir</a></li>
          </ul>
        </li>
      </ul>
    </header>
      <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
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
          <h1><i class="bi bi-table"></i> Consulta De Ventas</h1>
          <p>Acontinuación todas las ventas realizadas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Ventas</li>
          <li class="breadcrumb-item active"><a href="#">Factura</a></li>
        </u>
      </div>
      <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                    <th>ID Factura</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Productos</th>
                    <th>Cantidades</th>
                    <th>Total</th>
                </tr>
              </thead>
            <tbody>
                <?php
                // Obtener las ventas agrupadas por ID de factura
                $stmt = $pdo->query("
                    SELECT f.fac_enc_id, c.cli_nom, f.fec_enc_fecha, 
                           GROUP_CONCAT(p.pro_nom ORDER BY p.pro_nom SEPARATOR ', ') AS productos,
                           GROUP_CONCAT(d.fact_det_cant ORDER BY p.pro_nom SEPARATOR ', ') AS cantidades,
                           SUM(d.fact_det_cant * p.pro_pre) AS total
                    FROM factura f
                    JOIN clientes c ON f.cli_id = c.cli_id
                    JOIN factura_det_pro d ON f.fac_enc_id = d.fac_enc_id
                    JOIN productos p ON d.pro_id = p.pro_id
                    GROUP BY f.fac_enc_id
                ");
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['fac_enc_id']}</td>
                            <td>{$row['cli_nom']}</td>
                            <td>{$row['fec_enc_fecha']}</td>
                            <td>{$row['productos']}</td>
                            <td>{$row['cantidades']}</td>
                            <td>" . number_format($row['total'], 2) . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

      <!-- Essential javascripts for application to work-->
      <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Page specific javascripts-->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
    <!-- Data table plugin-->
    <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
