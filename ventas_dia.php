<?php
// Incluir el archivo de conexión
require 'modelos/conexion.php';

// Crear una instancia de la conexión
$conexion = BasedeDatos::Conectar();

// Inicializar variables
$resultados = [];
$total_ventas = 0; // Para almacenar el total de ventas
$tipo = ''; // Para almacenar el tipo de filtro (día, mes, año)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprobar si el tipo de filtro está definido
    if (isset($_POST['tipo'])) {
        // Obtener el tipo de filtro y la fecha, mes o año seleccionados
        $tipo = $_POST['tipo'];

        // Inicializar la consulta y los parámetros
        $query = '';
        $params = [];

        try {
            if ($tipo == 'dia') {
                $fecha = $_POST['fecha'];
                $query = "
                    SELECT 
                        f.fec_enc_fecha AS fecha,
                        SUM(fd.fact_det_cant * p.pro_pre) AS total_ventas
                    FROM 
                        factura f
                    JOIN 
                        factura_det_pro fd ON f.fac_enc_id = fd.fac_enc_id
                    JOIN 
                        productos p ON fd.pro_id = p.pro_id
                    WHERE 
                        DATE(f.fec_enc_fecha) = :fecha
                    GROUP BY 
                        f.fec_enc_fecha
                ";
                $params[':fecha'] = $fecha;
            } elseif ($tipo == 'mes') {
                $mes = $_POST['mes'];
                $query = "
                    SELECT 
                        DATE_FORMAT(f.fec_enc_fecha, '%Y-%m') AS fecha,
                        SUM(fd.fact_det_cant * p.pro_pre) AS total_ventas
                    FROM 
                        factura f
                    JOIN 
                        factura_det_pro fd ON f.fac_enc_id = fd.fac_enc_id
                    JOIN 
                        productos p ON fd.pro_id = p.pro_id
                    WHERE 
                        MONTH(f.fec_enc_fecha) = :mes
                    GROUP BY 
                        DATE_FORMAT(f.fec_enc_fecha, '%Y-%m')
                ";
                $params[':mes'] = $mes;
            } elseif ($tipo == 'anio') {
                $anio = $_POST['anio'];
                $query = "
                    SELECT 
                        YEAR(f.fec_enc_fecha) AS fecha,
                        SUM(fd.fact_det_cant * p.pro_pre) AS total_ventas
                    FROM 
                        factura f
                    JOIN 
                        factura_det_pro fd ON f.fac_enc_id = fd.fac_enc_id
                    JOIN 
                        productos p ON fd.pro_id = p.pro_id
                    WHERE 
                        YEAR(f.fec_enc_fecha) = :anio
                    GROUP BY 
                        YEAR(f.fec_enc_fecha)
                ";
                $params[':anio'] = $anio;
            }

            if ($query) {
                $stmt = $conexion->prepare($query);
                $stmt->execute($params);
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Calcular el total de ventas
                foreach ($resultados as $row) {
                    $total_ventas += $row['total_ventas'];
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

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
    <title>Ventas Fecha</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function mostrarOpciones() {
            const tipo = document.getElementById('tipo').value;
            document.getElementById('dia').style.display = tipo === 'dia' ? 'block' : 'none';
            document.getElementById('mes').style.display = tipo === 'mes' ? 'block' : 'none';
            document.getElementById('anio').style.display = tipo === 'anio' ? 'block' : 'none';
        }
    </script>
</head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="pag.php">Coralby</a>
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
                <h1><i class="bi bi-ui-checks"></i> Consultar Ventas Por Fecha</h1>
                <p>Acontinuacion las ventas realizadas en la fecha correspondiente</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item">Ventas Fechas</li>
                <li class="breadcrumb-item"><a href="consultar_clientes.php">Factura</a></li>
            </ul>
        </div>
        <form method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
        <label for="tipo">Selecciona el tipo de consulta:</label> <br>
        <select id="tipo" name="tipo" onchange="mostrarOpciones()" required>
            <option value="">Seleccione...</option>
            <option value="dia">Por Día</option>
            <option value="mes">Por Mes</option>
            <option value="anio">Por Año</option>
        </select>

        <div id="dia" style="display:none;">
            <label for="fecha">Selecciona una fecha:</label>
            <input type="date" id="fecha" name="fecha">
        </div>

        <div id="mes" style="display:none;">
            <label for="mes">Selecciona un mes:</label>
            <select id="mes" name="mes">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo $m; ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div id="anio" style="display:none;">
            <label for="anio">Selecciona un año:</label>
            <select id="anio" name="anio">
                <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                    <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <button type="submit">Consultar Ventas</button>
    </form>

    <?php if (!empty($resultados)): ?>
        <h2>Resultados</h2>
        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Total Ventas</th>
                                        <th scope="col">Ventas por Fecha</th>
                                    </tr>
            <tr>
            <tr>
                <td><?php echo htmlspecialchars($total_ventas); ?></td>
                <td>
                    <ul>
                        <?php foreach ($resultados as $row): ?>
                            <li><?php echo htmlspecialchars($row['fecha']) . ': ' . htmlspecialchars($row['total_ventas']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No se encontraron ventas para el periodo seleccionado.</p>
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




