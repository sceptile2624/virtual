<?php

// Iniciamos la sesión
session_start();

// Incluimos la clase de conexión
include('conexion.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenemos los valores de email y password del formulario de login
    $email = $_POST['email'];
$password = $_POST['password'];

// Consultamos la base de datos para verificar si el usuario existe y si es administrador
$sql = "SELECT * FROM usuarios WHERE email='$email' AND pass='$password'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    // El usuario fue encontrado
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario['es_admin'] == 1) {
        // El usuario es administrador
        $_SESSION['usuario'] = $usuario['email']; // Almacenamos el nombre del usuario en la sesión
        $_SESSION['rol'] = 'admin'; // Almacenamos el rol del usuario en la sesión
        echo "<script>alert('Administrador');</script>";
        header("Location: ../admin/agregar_productos.php");
        exit();
    } else {
        // El usuario no es administrador
        $_SESSION['usuario'] = $usuario['email']; // Almacenamos el nombre del usuario en la sesión
        $_SESSION['rol'] = 'usuario'; // Almacenamos el rol del usuario en la sesión
        echo "<script>alert('Usuario');</script>";
        header("Location: ../normal_user/nosotros.php");
        exit();
    }
} else {
    // El usuario no fue encontrado
    echo "<script>alert('Usuario no encontrado');</script>";
}
}