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
$id = $data['id'];

// Eliminar el producto de la tabla productos
$sql = "DELETE FROM carrito WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
  $response = array('success' => true);
} else {
  $response = array('success' => false, 'error' => $conn->error);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>