<?php
// Obtener el ID del usuario de la sesión
session_start();

$correo = $_SESSION['usuario'];

// Establecer conexión con la base de datos
$servername = "localhost";
$username = "nando";
$password = "1234";
$dbname = "vanshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del usuario o establecerlo como necesario
$idUsuario = 0;

// OBTENER EL ID
$sql = "SELECT id FROM usuarios WHERE email = '$correo'";
// Ejecuta la consulta
$result = $conn->query($sql);

// Verifica si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtiene el primer resultado
    $row = $result->fetch_assoc();
    // Guarda el ID del usuario
    $idUsuario = $row["id"];
}

// Obtener los productos del carrito del usuario
$sql = "DELETE FROM carrito WHERE id_usuario = $idUsuario";
if ($conn->query($sql) === TRUE) {
    echo "Se borraron los datos correctamente.";
} else {
    echo "Error al borrar los datos: " . $conn->error;
}

$conn->close();
?>