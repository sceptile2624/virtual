<?php
// Establecer conexión con la base de datos
$servername = "localhost";
$username = "nando";
$password = "1234";
$dbname = "vanshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados por la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];

// Insertar los datos en la tabla productos
$sql = "INSERT INTO productos (nombre, link_imagen, precio) VALUES ('$nombre', '$descripcion', '$precio')";

if ($conn->query($sql) === TRUE) {
  $response = array('success' => true);
} else {
  $response = array('success' => false, 'error' => $conn->error);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>