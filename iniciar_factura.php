<?php
require_once("modelos/conexion.php");

try {
    $cli_id = $_POST["cli_id"];
    $estado = 1;  // Aseguramos que el estado sea un entero

    // Verificamos si se envió el ID del cliente
    if (empty($cli_id)) {
        echo json_encode(array('error'=>'ID del cliente no proporcionado'));
        exit;
    }

    // Preparamos la consulta de inserción
    $stmt = $conexion->prepare("INSERT INTO factura (cli_id, fac_enc_est) VALUES (:cli_id, :fac_enc_est);");
    $stmt->bindParam(':cli_id', $cli_id, PDO::PARAM_INT);
    $stmt->bindParam(':fac_enc_est', $estado, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener el último ID insertado
    $factura_id = $conexion->lastInsertId();

    echo json_encode(array('success'=>true, 'factura_id' => $factura_id));

} catch (PDOException $e) {
    echo json_encode(array('error'=>'Error al ingresar la factura: '.$e->getMessage()));
}
?>
