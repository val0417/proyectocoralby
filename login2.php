<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>CORALBY</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="lockscreen-content">
      <div class="logo">
        <h1>Coralby</h1>
      </div>
      <div class="lock-box"><img class="rounded-circle user-image" src="dayana.jpg">
        <h4 class="text-center user-name">Dayana Ortega</h4>
        <p class="text-center text-muted">Cuenta cerrada</p>
        <form class="unlock-form" method="POST" action="">
          <div class="mb-3">
            <label class="control-label">Correo Electrónico</label>
            <input class="form-control" type="email" name="email" placeholder="Correo Electrónico" required autofocus>
          </div>
          <div class="mb-3">
            <label class="control-label">Contraseña</label>
            <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
          </div>
          <div class="mb-3 btn-container d-grid">
            <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-unlock me-2 fs-5"></i>UNLOCK</button>
          </div>
        </form>
        <p><a href="registrarse.php">No eres Dayana? Registrate aquí</a></p>
      </div>
    </section>

    <?php
// Comprobar si el archivo existe
if (!file_exists('modelos/conexion.php')) {
  die("El archivo de conexión no se encontró. Verifica la ruta.");
}

// Incluir el archivo de conexión a la base de datos
include_once 'modelos/conexion.php';


    // Inicializar la variable de conexión
    $conexion = BasedeDatos::Conectar();

    // Recoger datos del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Mostrar los datos recibidos (para depuración, eliminar en producción)
        echo "Email ingresado: " . $email . "<br>";
        echo "Password ingresado: " . $password . "<br>";

        // Preparar la consulta SQL para verificar el correo y la contraseña
        $query = "SELECT * FROM login WHERE email = :email AND password = :password";
        $stmt = $conexion->prepare($query);

        // Vincular parámetros
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Verificar si hay una coincidencia en la base de datos
        if ($stmt->rowCount() === 1) {
            // Redirigir al usuario si el login es correcto
            header("Location: pag.php");
            exit;
        } else {
            // Mostrar mensaje de error si los datos no coinciden
            echo "<script>alert('Correo o contraseña incorrectos');</script>";
        }

        // Cerrar la conexión (opcional, ya que se cerrará al final del script)
        $conexion = null;
    }
    ?>

    <!-- Essential javascripts for application to work-->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
