<?php
require_once('modelos/conexion.php');
$conexion = BasedeDatos::Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pro_cod = $_POST['pro_cod'];

    $SQL = "DELETE FROM productos WHERE pro_cod = ?";
    $stmt = $conexion->prepare($SQL);
    $stmt->execute([$pro_cod]);

    header('Location: consultar.php');
}
