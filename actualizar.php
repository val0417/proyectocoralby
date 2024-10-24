<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro Personas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Proyecto SENA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active"  href="registrar.php">Registrar </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active"  href="consultar.php">Consultar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  href="eliminar.php">Eliminar </a>
        </li>
        <li class="nav-item">
           <a class="nav-link active"  href="actualizar.php">Actualizar</span></a>
        </li>
             </ul>
        </div>
</nav>
   
<div class="container">
        <div class="container-sm" style="margin-top:1%">
      <form action="actualizar.php" method="POST">
     <div class="form-group">
          <label for="txtID">Ingrese una identificacion</label>
          <input type="text" class="form-control" name="txtID" placeholder="Código" required>
</div>
  <input type="submit" class="btn btn-success" value="Buscar">
</form>



<?php
if($_POST){
  $cod = $_POST['txtID'];
  require_once('modelos/conexion.php');
  $conexion = BasedeDatos::Conectar();
  $SQL = 'SELECT * FROM productos WHERE pro_cod=:cod';
  $stmt = $conexion->prepare($SQL);
  $stmt->bindParam('cod', $cod);
  $result = $stmt->execute();
  $rows = $stmt->fetchALL(\PDO::FETCH_ASSOC);
  if (count($rows)){
    foreach ($rows as $row){
      ?>
      <form method="POST" action="actualizar_datos.php">
        <p>Por favor, diligencie todos los campos de este formulario, para actualizar.</p>
        <input type="hidden" name="txtCodigo" readonly value="<?php print($row['pro_cod']) ?>" />
    
        <div class="form-group">
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
  
    <div class="form-group">
        <label for="txtNombres">Nombre</label>
        <input type="text" class="form-control" value="<?php print($row['pro_nom']) ?>" name="txtNombres" placeholder="Ingrese nombre producto" required>
    </div>
    <div class="form-group">
        <label for="txtDescripcion">Descripción</label>
        <input type="text" class="form-control" value="<?php print($row['pro_desc']) ?>" name="txtDescripcion" placeholder="Deje su referencia" required>
    </div>
    <div class="form-group">
        <label for="txtCantidad">Cantidad</label>
        <input type="number" class="form-control" value="<?php print($row['pro_cant']) ?>" name="txtCantidad" placeholder="Ingrese cantidad" required>
    </div>
    <div class="form-group">
        <label for="txtPreci">Precio inicial</label>
        <input type="text" class="form-control" value="<?php print($row['pro_precin']) ?>" name="txtPreci" placeholder=""required>
    </div>
    <div class="form-group">
        <label for="txtprecb">Precio base</label>
        <input type="text" class="form-control" value="<?php print($row['pro_pre']) ?>" name="txtprecb" placeholder=""required>
    </div> 


<input type="submit" class="btn btn-success" value="Actualizar producto">



  <?php

    }
  }else{
    ?> 
    <div class="alert alert-danger" role="alert" style="margin-top:1%">
    <b>Aviso:</b> ¡El usuario no existe!.
  </div>
  <?php
  }
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
