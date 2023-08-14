<?php
// Conexión a la base de datos
$servidor = "localhost"; // Cambiar si es necesario
$usuario = "nando"; // Cambiar si es necesario
$contrasena = "1234"; // Cambiar si es necesario
$base_datos = "vanshop"; // Cambiar si es necesario

// Crear conexión
$conn = mysqli_connect($servidor, $usuario, $contrasena, $base_datos);

// Verificar si hay errores de conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>