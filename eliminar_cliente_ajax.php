<?php
require_once('modelos/conexion.php');
$conexion = BasedeDatos::Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Imprime los valores enviados para depuración
    print_r($_POST);

    $cli_doc = $_POST['cli_doc'];

    if (isset($cli_doc) && !empty($cli_doc)) {
        try {
            $SQL = "DELETE FROM clientes WHERE cli_doc = ?";
            $stmt = $conexion->prepare($SQL);
            $stmt->execute([$cli_doc]);

            // Verifica si se eliminó alguna fila
            if ($stmt->rowCount() > 0) {
                echo "El cliente ha sido eliminado correctamente.";
            } else {
                echo "No se encontró ningún cliente con ese documento.";
            }

            // Redirige después de eliminar
            header('Location: consultar_cliente.php');
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "El documento no está definido o está vacío.";
    }
}
