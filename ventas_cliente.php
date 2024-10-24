<?php
// Incluir el archivo de conexión
require 'modelos/conexion.php';

// Crear una instancia de la conexión
$conexion = BasedeDatos::Conectar();

// Inicializar variable para mostrar resultados
$resultados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente'])) {
    // Obtener el ID del cliente seleccionado del formulario
    $cliente_id = $_POST['cliente'];

    try {
        // Consulta para obtener los productos y cantidades vendidos por cliente
        $query = "
            SELECT 
                c.cli_nom AS cliente,
                GROUP_CONCAT(p.pro_nom ORDER BY p.pro_nom SEPARATOR ', ') AS productos,
                GROUP_CONCAT(fd.fact_det_cant ORDER BY p.pro_nom SEPARATOR ', ') AS cantidades,
                SUM(p.pro_pre * fd.fact_det_cant) AS total_ventas
            FROM 
                factura f
            JOIN 
                factura_det_pro fd ON f.fac_enc_id = fd.fac_enc_id
            JOIN 
                productos p ON fd.pro_id = p.pro_id
            JOIN 
                clientes c ON f.cli_id = c.cli_id
            WHERE 
                c.cli_id = :cliente_id
            GROUP BY 
                c.cli_id
        ";

        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':cliente_id', $cliente_id);
        $stmt->execute();

        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener la lista de clientes para el formulario
$clientes = [];
try {
    $query = "SELECT cli_id, cli_nom FROM clientes";
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conexion = null;
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
      
    </header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="dayana.jpg" alt="User Image">
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
                <h1><i class="bi bi-ui-checks"></i> Consultar Ventas Cliente</h1>
                <p>Acontinuacion las ventas realizadas por cada cliente</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item">Consultar Ventas</li>
                <li class="breadcrumb-item"><a href="consultar_clientes.php">Clientes</a></li>
            </ul>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
        <label for="cliente">Selecciona un cliente:</label> <br>
        <select id="cliente" name="cliente" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo htmlspecialchars($cliente['cli_id']); ?>">
                    <?php echo htmlspecialchars($cliente['cli_nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Consultar Ventas</button>
    </form>

    <?php if (!empty($resultados)): ?>
        <h2>Ventas para <?php echo htmlspecialchars($resultados[0]['cliente']); ?></h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Total de ventas</th>
                                    </tr>
            <tr>
                <td><?php echo htmlspecialchars($resultados[0]['cliente']); ?></td>
                <td><?php echo htmlspecialchars(number_format($resultados[0]['total_ventas'], 2)); ?></td>
            </tr>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No se encontraron ventas para el cliente seleccionado.</p>
    <?php endif; ?>
</body>


        <!-- Essential javascripts for application to work-->
        <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Page specific javascripts-->
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

</html>
