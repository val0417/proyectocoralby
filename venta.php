<?php include 'config.php'; ?>

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
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Coralby</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      </ul>
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
          <h1><i class="bi bi-ui-checks"></i>Registrar Venta</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Venta</li>
          <li class="breadcrumb-item"><a href="consultar.php">factura</a></li>
        </ul>
      </div>
        <form method="POST" action="register_sale.php">
        <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-lg-6">
                <form>
                  <div class="mb-3">
                <label class="form-label" for="cli_id">Cliente:</label>
            <select class="form-control" name="cli_id" required>
                    <?php
                    $stmt = $pdo->query("SELECT cli_id, cli_nom FROM clientes");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='{$row['cli_id']}'>{$row['cli_nom']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="productos-container">
                <div class="producto mb-3">
                    <h5>Producto:</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="form-control" name="pro_id[]" required>
                                <?php
                                $stmt = $pdo->query("SELECT pro_id, pro_nom, pro_pre FROM productos");
                                while ($row = $stmt->fetch()) {
                                    echo "<option value='{$row['pro_id']}' data-precio='{$row['pro_pre']}'>{$row['pro_nom']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="precio[]" placeholder="Precio" readonly>
                        </div>
                        <div class="form-group col-md-1">
                            <button type="button" class="btn btn-danger eliminar-producto">Eliminar</button>
                        </div>
                    </div>
                    <div class="subtotal mb-2">
                        <strong>Subtotal: <span class="subtotal-valor">0</span></strong>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-producto">Agregar otro producto</button>
            <h4 class="mt-4">Subtotal: <span id="subtotal-venta">0</span></h4>
            <h4>IVA (19%): <span id="iva-venta">0</span></h4>
            <h4>Total: <span id="total-venta">0</span></h4>
            <button type="submit" class="btn btn-primary mt-3">Registrar Venta</button>
        </form>
        <hr>
        <h2 class="mt-5">Consultar Ventas</h2>
        <a href="register_sale.php" class="btn btn-secondary">Ver Ventas Registradas</a>
    </div>

    <script>
        $(document).ready(function() {
            // Cargar precio del producto al seleccionar
            $(document).on('change', 'select[name="pro_id[]"]', function() {
                const $producto = $(this).closest('.producto');
                const precio = $(this).find('option:selected').data('precio');
                $producto.find('input[name="precio[]"]').val(precio);
                calcularSubtotal($producto.find('input[name="precio[]"]'));
            });

            // Agregar producto
            $('#add-producto').click(function() {
                $('#productos-container').append(`
                    <div class="producto mb-3">
                        <h5>Producto:</h5>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select class="form-control" name="pro_id[]" required>
                                    <?php
                                    $stmt = $pdo->query("SELECT pro_id, pro_nom, pro_pre FROM productos");
                                    while ($row = $stmt->fetch()) {
                                        echo "<option value='{$row['pro_id']}' data-precio='{$row['pro_pre']}'>{$row['pro_nom']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="precio[]" placeholder="Precio" readonly>
                            </div>
                            <div class="form-group col-md-1">
                                <button type="button" class="btn btn-danger eliminar-producto">Eliminar</button>
                            </div>
                        </div>
                        <div class="subtotal mb-2">
                            <strong>Subtotal: <span class="subtotal-valor">0</span></strong>
                        </div>
                    </div>
                `);
            });

            // Eliminar producto
            $(document).on('click', '.eliminar-producto', function() {
                $(this).closest('.producto').remove();
                calcularTotal();
            });

            // Calcular subtotal y total
            $(document).on('input', 'input[name="cantidad[]"]', function() {
                const $producto = $(this).closest('.producto');
                calcularSubtotal($producto.find('input[name="precio[]"]'));
                calcularTotal();
            });

            function calcularSubtotal($precioInput) {
                const cantidad = $precioInput.closest('.producto').find('input[name="cantidad[]"]').val();
                const precio = $precioInput.val();
                const subtotal = cantidad * precio;
                $precioInput.closest('.producto').find('.subtotal-valor').text(subtotal.toFixed(2));
                calcularTotal();
            }

            function calcularTotal() {
                let subtotal = 0;
                $('.subtotal-valor').each(function() {
                    subtotal += parseFloat($(this).text());
                });

                const iva = subtotal * 0.19;
                const total = subtotal + iva;

                $('#subtotal-venta').text(subtotal.toFixed(2));
                $('#iva-venta').text(iva.toFixed(2));
                $('#total-venta').text(total.toFixed(2));
            }
        });
    </script>


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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
