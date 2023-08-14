<?php
// Establecer conexión con la base de datos
$servername = "localhost";
$username = "vanessa";
$password = "12345";
$dbname = "vanshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados por la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$identificador = $data['identificador'];
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];

// Insertar los datos en la tabla productos
if ($nombre != "" && $descripcion == "" && $precio == "") {    // SOLO NOMBRE
    $sql = "UPDATE productos SET nombre='$nombre' WHERE id='$identificador'";
} elseif ($nombre != "" && $descripcion != "" && $precio == "") { // NOMBRE Y DESCRIPCION
    $sql = "UPDATE productos SET nombre='$nombre', link_imagen='$descripcion' WHERE id='$identificador'";
} elseif ($nombre != "" && $descripcion == "" && $precio != "") { // NOMBRE Y PRECIO
    $sql = "UPDATE productos SET nombre='$nombre', precio='$precio' WHERE id='$identificador'";
} elseif ($nombre == "" && $descripcion != "" && $precio == "") { // SOLO DESCRIPCION
    $sql = "UPDATE productos SET link_imagen='$descripcion' WHERE id='$identificador'";
} elseif ($nombre == "" && $descripcion != "" && $precio != "") { // DESCRIPCION Y PRECIO
    $sql = "UPDATE productos SET link_imagen='$descripcion', precio='$precio' WHERE id='$identificador'";
} elseif ($nombre == "" && $descripcion == "" && $precio != "") { // SOLO PRECIO
    $sql = "UPDATE productos SET precio='$precio' WHERE id='$identificador'";
} else {
    $sql = "UPDATE productos SET nombre='$nombre', link_imagen='$descripcion', precio='$precio' WHERE id='$identificador'";
}

if ($conn->query($sql) === TRUE) {
  $response = array('success' => true);
} else {
  $response = array('success' => false, 'error' => $conn->error);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>