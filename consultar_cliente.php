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
  </body>
</html>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-table"></i>Lista de clientes</h1>
        </div>

        <div class="btn-group">
        <a href="registrar_clientes.php" class="btn btn-primary btn-sm">
    <i class="bi bi-journal-text me-1 fs-5"></i>
</a>


              </div>


        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item">Clientes</li>
          <li class="breadcrumb-item active"><a href="consultar.php">Lista</a></li>
        </ul>
      </div>
           
        <!-- Tabla de clientes -->
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('modelos/conexion.php');
                                    $conexion = BasedeDatos::Conectar();
                                    $SQL = 'SELECT cli_doc, cli_nom, cli_telefono, cli_correo, cli_direccion FROM clientes';
                                    $stmt = $conexion->prepare($SQL);
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach($rows as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['cli_doc']; ?></td>
                                        <td><?php echo $row['cli_nom']; ?></td>
                                        <td><?php echo $row['cli_telefono']; ?></td>
                                        <td><?php echo $row['cli_correo']; ?></td>
                                        <td><?php echo $row['cli_direccion']; ?></td>
                                        <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" 
                        data-doc="<?php echo $row['cli_doc']; ?>"
                       data-nom="<?php echo $row['cli_nom']; ?>"
                        data-tel="<?php echo $row['cli_telefono']; ?>"
                        data-cor="<?php echo $row['cli_correo']; ?>"
                       data-dir="<?php echo $row['cli_direccion']; ?>">
                        <i class="bi bi-arrow-clockwise fs-5"></i>
                    </button>
                    <!-- Botón de eliminar con modal -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-doc="<?php echo $row['cli_doc']; ?>">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </td>
                                    </tr>
            <?php 
            }

          ?>
          </tbody>
        </table>
      </div>

  </div>
    </div>

  </div>



<!-- Modales para Actualizar y Eliminar Profe Iván-->
<!-- Modal para Actualizar Producto -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Actualizar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm" method="POST" action="actualizar_c_ajax.php">
          <!-- Campo oculto para el documento del cliente -->
          <input type="hidden" name="cli_doc" id="updateCliDoc">
          
          <!-- Campo para el nombre del cliente -->
          <div class="mb-3">
            <label for="updateNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="updateNombre" name="cli_nom" required>
          </div>
          
          <!-- Campo para el teléfono del cliente -->
          <div class="mb-3">
            <label for="updateTel" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="updateTel" name="cli_tel" required>
          </div>
          
          <!-- Campo para el correo del cliente -->
          <div class="mb-3">
            <label for="updateCorreo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="updateCorreo" name="cli_cor" required>
          </div>
          
          <!-- Campo para la dirección del cliente -->
          <div class="mb-3">
            <label for="updateDireccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="updateDireccion" name="cli_dir" required>
          </div>

          <!-- Botón de envío -->
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal de eliminación-->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar este cliente?</p>
                        <form id="deleteForm" method="POST" action="eliminar_cliente_ajax.php">
                            <input type="hidden" name="cli_doc" id="deletecliDoc">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>





<script>
  document.addEventListener('DOMContentLoaded', function () {
  var updateModal = document.getElementById('updateModal');
  updateModal.addEventListener('show.bs.modal', function (event) {
   var button = event.relatedTarget;
   var Doc = button.getAttribute('data-doc');
    var Nom = button.getAttribute('data-nom');
  var Tel = button.getAttribute('data-tel');//
  var Cor = button.getAttribute('data-cor');
  var Dir = button.getAttribute('data-dir');

  var modalTitle = updateModal.querySelector('.modal-title');
  var DocInput = updateModal.querySelector('#updateCliDoc');
  var NomInput = updateModal.querySelector('#updateNombre');
  var TelInput = updateModal.querySelector('#updatetel');
  var CorInput = updateModal.querySelector('#updateCorreo');
  var DirInput = updateModal.querySelector('#updateDireccion');


  DocInput.value = Doc;
  NomInput.value = Nom;
  TelInput.value = Tel;
  CorInput.value = Cor;
   DirInput.value = Dir;
 } );

   var deleteModal = document.getElementById('deleteModal');
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var Doc = button.getAttribute('data-doc');
                    var DocInput = deleteModal.querySelector('#deletecliDoc');
                    DocInput.value = Doc;
  });

});

</script>


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
