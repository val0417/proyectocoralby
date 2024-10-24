<?php

class producto{
    private $pdo;

    public function __construct() {

        $this->pdo = BasedeDatos::Conectar(); // Asignar la conexión a una propiedad
 
}
public function Actualizardatos(){
    if ($_POST){
        $Doc=$_POST['txtDoc'];
        $Nom=$_POST['txtNom'];
        $Tel=$_POST['txtTel'];
        $Cor=$_POST['txtCor'];
        $Dir=$_POST['txtDir'];
        require_once('conexion.php');
        $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE productos SET  cli_nom=:Nom, cli_telefono=:Tel, cli_correo=:Cor, cli_direccion=:Dir WHERE cli_doc=:Doc';
        $stmt =$conexion->prepare($sql);
        $stmt ->bindParam(":Nom", $nom);
        $stmt ->bindParam(":Tel", $des);
        $stmt ->bindParam(":Cor", $can);
        $stmt ->bindParam(":Dir", $pci);
        $stmt ->bindParam(":Doc", $Doc);
        $stmt->execute();
        header('location: actualizar_cli.php');
    }
    
}
 }