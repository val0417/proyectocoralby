<?php
require_once("modelos/conexion.php");
try{
    $idCliente = $_POST["id_cliente"];
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE cli_doc = :id");
    $stmt->bindParam(':id', $idCliente, PDO::PARAM_INT);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($cliente){
        $response = array(
            'cli_nom' => $cliente['cli_nom'],
            'cli_apell' => $cliente['cli_apell'],
            'cli_id' => $cliente['cli_id']
        );
        echo json_encode($response);

    }else{
        echo json_encode(array('error' => 'cliente no encontrado'));  
    }

}catch (PDOException $e){
    echo json_encode(array('error' => 'Error de conexion'.$e->getMessage()));
}
?>