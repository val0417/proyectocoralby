<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_POST) {
    $Doc = $_POST['txtDocumento']; 
    $Nom = $_POST['txtnombre'];
    $Tel = $_POST['txtTelefono'];
    $Cor = $_POST['txtCorreo'];
    $Dir = $_POST['txtDireccion'];
    
    require_once('modelos/conexion.php');
    $conexion = BasedeDatos::Conectar();
    
    $SQL = 'INSERT INTO clientes (cli_doc, cli_nom, cli_telefono, cli_correo, cli_direccion) 
            VALUES (:c, :i, :n, :a, :t)';
    
    $stmt = $conexion->prepare($SQL);
    $stmt->bindParam(":c", $Doc);   
    $stmt->bindParam(":i", $Nom);
    $stmt->bindParam(":n", $Tel);
    $stmt->bindParam(":a", $Cor);
    $stmt->bindParam(":t", $Dir);
 
    try {
        $stmt->execute();
        
        // Redirigir a consultar.php después de guardar
        header("Location: consultar_cliente.php"); // Cambia "consultar.php" por la URL deseada
        exit; // Detener la ejecución del script
    } catch (PDOException $e) {
        print("<script>alert('Error al guardar el registro: " . $e->getMessage() . "');</script>");
    }
}
?>

<html lang="en">
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
    <title>Coralby</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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

  </body>
</html>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="bi bi-ui-checks"></i> Registrar</h1>
                <p>Añade tu nuevo cliente</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
                <li class="breadcrumb-item">Registrar</li>
                <li class="breadcrumb-item"><a href="consultar_clientes.php">Clientes</a></li>
            </ul>
        </div>

        <!-- Formulario principal -->
        <form action="registrar_clientes.php" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="txtDocumento">Documento</label>
                                    <input class="form-control" type="text" name="txtDocumento" placeholder="Ingrese su documento" required>
                                    <small class="form-text text-muted" id="emailHelp">Documento único para este cliente</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="txtnombre">Nombre</label>
                                    <input class="form-control" type="text" name="txtnombre" placeholder="Ingrese su nombre completo" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="txtTelefono">Teléfono</label>
                                    <input class="form-control" type="text" name="txtTelefono" placeholder="Ingrese número de teléfono" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="txtCorreo">Correo</label>
                                    <input class="form-control" type="email" name="txtCorreo" placeholder="Ingrese su correo" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="txtDireccion">Dirección</label>
                                    <input class="form-control" type="text" name="txtDireccion" placeholder="Ingrese su Dirección" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Scripts JavaScript -->
    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Otros scripts -->
</body>
</html>

