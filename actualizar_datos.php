<?php

require_once 'modelos/conexion.php'; // Ajusta la ruta si es necesario

class producto{
    private $pdo;
    

    public function __construct() {

        $this->pdo = BasedeDatos::Conectar(); // Asignar la conexión a una propiedad
 
}
public function Actualizardatos(){
    if ($_POST){
        $cod=$_POST['txtCodigo'];
        $cat=$_POST['txtcat'];
        $nom=$_POST['txtNombres'];
        $des=$_POST['txtDescripcion'];
        $can=$_POST['txtCantidad'];
        $pci=$_POST['txtPreci'];
        $preb=$_POST['txtprecb'];
        require_once('conexion.php');
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE productos SET pro_tipo=:cat, pro_nom=:nomb, pro_desc=:descr, pro_cant=:cant, pro_precin=:prei, pro_pre=:preb  WHERE pro_cod=:cod';
        $stmt =$conexion->prepare($sql);
        $stmt ->bindParam(":cat", $cat);
        $stmt ->bindParam(":nomb", $nom);
        $stmt ->bindParam(":descr", $des);
        $stmt ->bindParam(":cant", $can);
        $stmt ->bindParam(":prei", $pci);
        $stmt ->bindParam(":preb",  $preb);
        $stmt ->bindParam(":cod", $cod);
        $stmt->execute();
        header('location: actualizar.php');
    }
    
}

public function Cantidad() {
    try {
        $consulta = $this->pdo->prepare("SELECT SUM(pro_cant) AS total_cantidad FROM productos;");
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_OBJ);
        return $resultado->total_cantidad; // Asegúrate de devolver la propiedad correcta
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

public function Listar(){
    try{
        $consulta=$this->pdo->prepare("SELECT * FROM productos;");
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ);
    } catch (exception $e){
    die($e->getMessage());
    }

}
}
 

?>


