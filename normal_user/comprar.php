<?php
// Obtener el ID del usuario de la sesión
session_start();

$correo = $_SESSION['usuario'];

require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Encabezado del documento
    function Header() {
        // Logo o título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Productos', 0, 1, 'C');
        $this->Ln(10);
    }

    // Contenido del documento
    function Content($data) {
        // Encabezados de columna
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, 'ID', 1, 0, 'C');
        $this->Cell(60, 10, 'Nombre', 1, 0, 'C');
        $this->Cell(40, 10, 'Precio', 1, 0, 'C');
        $this->Ln();

        // Datos de los productos
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            $this->Cell(30, 10, $row['id'], 1, 0, 'C');
            $this->Cell(60, 10, $row['nombre'], 1, 0, 'C');
            $this->Cell(40, 10, $row['precio'], 1, 0, 'C');
            $this->Ln();
        }
    }
}

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
$sql = "SELECT id_producto FROM carrito WHERE id_usuario = $idUsuario";
$result = $conn->query($sql);

$productIds = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productIds[] = $row['id_producto'];
    }
}

// Obtener los datos de los productos correspondientes en la tabla de productos
$data = array();
foreach ($productIds as $valor) {
    $sql = "SELECT * FROM productos WHERE id = $valor";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

$conn->close();

// Crear una nueva instancia de la clase PDF
$pdf = new PDF();

// Crear una página en blanco
$pdf->AddPage();

// Generar el encabezado del documento
$pdf->Header();

// Generar el contenido del documento
$pdf->Content($data);

// Carpeta de almacenamiento
$carpeta = '/home/download/' . $correo . '/';

// Verificar si la carpeta existe, si no, crearla
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

// Generar un número aleatorio del 1 al 1000
$numeroAleatorio = rand(1, 1000);

// Nombre del archivo
$nombreArchivo = 'comprar_' . $numeroAleatorio . '.pdf';

// Ruta completa del archivo
$rutaArchivo = $carpeta . '/' . $nombreArchivo;

// Salida del PDF
$pdf->Output($rutaArchivo, 'F');