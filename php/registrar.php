<?php
include('../conexion.php');

    $nombre = $_POST['nombre_usuario'];
    $apellidos = $_POST['apellidos_usuario'];
    $correo = $_POST['email_usuario'];
    $contrasena = $_POST['pass_usuario'];
    $sexo = $_POST['sexo_usuario'];
    $telefono = $_POST['phone_usuario'];
    
    //Verifica si el radio button "SI" ha sido seleccionado y asigna 1 a $es_admin en caso afirmativo
    //$es_admin = isset($_POST['es_admin']) && $_POST['es_admin'] == 'es_admin' ? 1 : 0;
    $es_admin = isset($_POST['es_admin']) ? $_POST['es_admin'] : 0;

    $query = "INSERT INTO usuarios (nombre, apellidos, email, pass, sexo, telefono, es_admin) VALUES ('$nombre', '$apellidos', '$correo', '$contrasena', '$sexo', '$telefono', '$es_admin')";

    if(mysqli_query($conn, $query)){
        header("Location: index.html");
    } else{
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

?>