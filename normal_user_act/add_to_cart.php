<?php
// Obtener el ID del usuario de la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $correo = $_SESSION['usuario'];

  // Obtener el ID del producto enviado por el formulario
  $idProducto = $_POST['id'];
  echo "PRODUCTO: " . $idProducto . "<br>";

  // Establecer conexión con la base de datos
  $servername = "localhost";
  $username = "vanessa";
  $password = "12345";
  $dbname = "vanshop";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Consultar el ID del usuario utilizando el correo electrónico
  $idUsuario = 0;

  $sql2 = "SELECT id FROM usuarios WHERE email = '$correo'";
  $resultado = $conn->query($sql2);

  if ($resultado->num_rows > 0) {
    // Obtener el ID del usuario
    $fila = $resultado->fetch_assoc();
    $idUsuario = $fila['id'];
  }
  echo "USUARIO: ".$idUsuario . "<br>";;
  // Insertar el producto en la tabla carrito
  $sql = "INSERT INTO carrito (id_producto, id_usuario) VALUES ($idProducto, $idUsuario)";

  if ($conn->query($sql) === TRUE) {
    header("Location: ../../normal_user/compras.php");
    echo "Producto agregado al carrito exitosamente";
  } else {
    echo "Error al agregar el producto al carrito: " . $conn->error;
  }

  $conn->close();
}