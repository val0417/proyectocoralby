<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pro_id = $_POST['pro_id'];

    $stmt = $pdo->prepare("SELECT pro_pre FROM productos WHERE pro_id = ?");
    $stmt->execute([$pro_id]);
    $producto = $stmt->fetch();

    echo $producto ? $producto['pro_pre'] : '0';
}
?>
