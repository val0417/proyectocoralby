<?php
if ($_POST) {
    $cod = $_POST['txtCodigo']; 
    $cat = $_POST['txtcat'];
    $nom = $_POST['txtNombres'];
    $des = $_POST['txtDescripcion'];
    $can = $_POST['txtCantidad'];
    $pi = $_POST['txtPreci'];
    $pb = $_POST['txtprecb'];
    
    require_once('modelos/conexion.php');
    $conexion = BasedeDatos::Conectar();
    
    $SQL = 'INSERT INTO productos (pro_cod, pro_tipo, pro_nom, pro_desc, pro_cant, pro_precin, pro_pre) 
            VALUES (:c, :i, :n, :a, :t, :m, :h)';
    
    $stmt = $conexion->prepare($SQL);
    $stmt->bindParam(":c", $cod);   
    $stmt->bindParam(":i", $cat);
    $stmt->bindParam(":n", $nom);
    $stmt->bindParam(":a", $des);
    $stmt->bindParam(":t", $can);
    $stmt->bindParam(":m", $pi);
    $stmt->bindParam(":h", $pb);
 
    
    try {
        $stmt->execute();
        
        // Redirigir a consultar.php después de guardar
        header("Location: consultar.php"); // Cambia "consultar.php" por la URL deseada
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
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar"src="dayana.jpg" alt="User Image">
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
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-ui-checks"></i>Registrar</h1>
          <p>Añade tu nuevo producto</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Registrar</li>
          <li class="breadcrumb-item"><a href="consultar.php">Productos</a></li>
        </ul>
      </div>

      <form action="registrar.php" method="post">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form>
                  <div class="mb-3">
                    <label class="form-label" for="txtCodigo">Código</label>
                    <input class="form-control" type="text" name="txtCodigo" placeholder="Ingrese código producto" required><small class="form-text text-muted" id="emailHelp">Código único para un producto.</small>
                  </div>
                  <div class="mb-3">
                  <label for="txtcat">Categoria</label>
        <select name="txtcat" class="form-control" required>
            <option value="Piel">Piel</option>
            <option value="Sombras">Sombras</option>
            <option value="Labiales">Labiales</option>
            <option value="Pestañinas">Pestañinas</option>
            <option value="Rubores">Rubores</option>
            <option value="Polvos">Polvos</option>
        </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="txtNombres">Nombre</label>
                    <input class="form-control" type="text" name="txtNombres" placeholder="Ingrese nombre producto" required>
                  </div>
                
                  <div class="mb-3">
                    <label class="form-label" for="txtDescripcion">Descripción</label>
                    <textarea class="form-control" name="txtDescripcion" placeholder="Deje su referencia" requiredrows="3"></textarea>
                  </div>
              
                  <div class="form-group">
        <label for="txtCantidad">Cantidad</label>
        <input type="number" class="form-control" name="txtCantidad" placeholder="Ingrese cantidad" required>
    </div> <br>

    <div class="form-group">
        <label for="txtPreci">Precio inicial</label>
        <input type="text" class="form-control" name="txtPreci" placeholder=""required>
    </div>
<br>
    <div class="form-group">
        <label for="txtprecb">Precio base</label>
        <input type="text" class="form-control" name="txtprecb" placeholder=""required>
    </div> 

    <br>
    <input type="submit" class="btn-primary" value="Registrar">
  </form>


  </div>

  </div>


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
</body>
