<?php
require_once('modelos/conexion.php');
$conexion = BasedeDatos::Conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pro_cod = $_POST['pro_cod'];
    $pro_nom = $_POST['pro_nom'];
    $pro_tipo = $_POST['pro_tipo'];
    $pro_desc = $_POST['pro_desc'];
    $pro_cant = $_POST['pro_cant'];
    $pro_pre = $_POST['pro_pre'];
    $pro_precin = $_POST['pro_precin'];

    $SQL = "UPDATE productos SET pro_nom = ?, pro_tipo = ?, pro_desc = ?, pro_cant = ?, pro_pre = ?, pro_precin = ? WHERE pro_cod = ?";
    $stmt = $conexion->prepare($SQL);
    $stmt->execute([$pro_nom, $pro_tipo, $pro_desc, $pro_cant, $pro_pre, $pro_precin, $pro_cod]);

    header('Location: consultar.php');
}
