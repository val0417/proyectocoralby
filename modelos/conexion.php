<?php
class BasedeDatos {
    const servidor = 'localhost';
    const bd = 'tienda';
    const user = 'root';
    const pass = '';

    
    public static function Conectar() {
        try {
            $conexion = new PDO("mysql:host=" . self::servidor . ";dbname=" . self::bd, self::user, self::pass);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion; // Retorna el objeto de conexión
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage()); // Termina la ejecución si hay un error
        }
    }
    
}
?>
