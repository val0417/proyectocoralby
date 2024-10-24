<?php
require_once("modelos/conexion.php");
try{
    $idPro = $_POST["codigoProductos"];
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE pro_cod = :codigoProductos");
    $stmt->bindParam(':codigoProductos', $idPro, PDO::PARAM_INT);
    $stmt->execute();

    $productos = $stmt->fetch(PDO::FETCH_ASSOC);

    if($productos){
        echo json_encode($productos);
    }else{
        echo json_encode(array('error' => 'Producto no encontrado'));
    }
    
} catch (PDOException $e){
    echo json_encode(array('error' => 'Error de conexion'.$e->getMessage()));
}
?>