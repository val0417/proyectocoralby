<?php
require_once('modelos/conexion.php');
$conexion = BasedeDatos::Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cli_doc = $_POST['cli_doc'];
    $cli_nom = $_POST['cli_nom'];
    $cli_tel = $_POST['cli_tel'];
    $cli_cor = $_POST['cli_cor'];
    $cli_dir = $_POST['cli_dir'];


    $SQL = "UPDATE clientes SET  cli_nom = ?, cli_telefono = ?, cli_correo = ?, cli_direccion = ?  WHERE cli_doc = ?";
    $stmt = $conexion->prepare($SQL);
    $stmt->execute([$cli_nom, $cli_tel, $cli_cor, $cli_dir, $cli_doc]);

    header('Location: consultar_cliente.php');
}
