<?php
// Iniciamos la sesión
session_start();

// Verificamos si la sesión está iniciada y si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
    // Si la sesión no está iniciada o el usuario no es administrador, redirigimos a la página de login
    header("Location: ../index.html");
    exit();
}

$correo = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>VanShop</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:i
tal,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,
600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="../assets/css/main.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="nosotros.php" class="logo d-flex align-items-center">
                <h1>VanShop</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="compras.php">Productos</a></li>
                    <li><a href="carrito.php" class="active">Carrito</a></li>
	        	<li><a href="http://webdav.vanshop.com/index.html">Ver PDF</>
                    <li><a href="../php/cerrar_sesion.php">Salir</a></li>
                </ul>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div style="min-height: 1vh; padding: 50px 0;" id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-item active" style="background-image: url(https://img2.rtve.es/i/?w=1600&i=1599041762848.jpg)"></div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">
        <table id="mitabla" class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
                $sql = "SELECT id, id_producto FROM carrito WHERE id_usuario = $idUsuario";
                $result = $conn->query($sql);

                $carritoIds = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $carritoIds[$row['id']] = $row['id_producto'];
                    }
                }

                // Declarar la variable $total e inicializarla en 0
                $total = 0;

                // Obtener los datos de los productos correspondientes en la tabla de productos
                foreach ($carritoIds as $carritoId => $productoId) {
                    $sql = "SELECT * FROM productos WHERE id = $productoId";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $nombre = $row['nombre'];
                            $precio = $row['precio'];
                ?>
                            <tr>
                                <td><?php echo $nombre; ?></td>
                                <td><?php echo $precio; ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="eliminarProducto(<?php echo $carritoId ?>)">Eliminar</button>
                                </td>
                            </tr>
                <?php
                            // Incrementar el valor de $total sumando el precio del producto actual
                            $total += $precio;
                        }
                    } else {
                        echo "<tr><td colspan='3'>No se encontraron productos.</td></tr>";
                    }
                }
                $conn->close();
                ?>
                <tr>
                    <td>TOTAL</td>
                    <td id="total-precio"><?php echo $total; ?></td>
                    <td>
                        <button class="btn btn-primary" id="comprarBtn" onclick="comprarYa()">Comprar!</button>
                    </td>
                </tr>
            </tbody>

        </table>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>VanShop</span></strong>. Todos los derechos reservados
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ESTILOS NECESARIOS -->
    <script>
        function comprarYa(){
            $.ajax({
                url: '../normal_user/comprar.php',
                type: 'POST',
                success: function(response) {
                    $.ajax({
                        url: '../normal_user/EnviarMensaje.php',
                        type: 'POST',
                        success: function(response) {
                            $.ajax({
                                url: '../normal_user/Eliminar_Carrito.php',
                                type: 'POST',
                                success: function(response) {
                                    alert("¡TODO LISTO! El correo fue enviado exitosamente");
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('Error al ejecutar EnviarMensaje.php:');
                                    console.log('Código de estado:', jqXHR.status);
                                    console.log('Texto de estado:', textStatus);
                                    console.log('Error lanzado:', errorThrown);
                                }
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('Error al ejecutar EnviarMensaje.php:');
                            console.log('Código de estado:', jqXHR.status);
                            console.log('Texto de estado:', textStatus);
                            console.log('Error lanzado:', errorThrown);
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error al ejecutar comprar.php:');
                    console.log('Código de estado:', jqXHR.status);
                    console.log('Texto de estado:', textStatus);
                    console.log('Error lanzado:', errorThrown);
                }
            });
        }

        function eliminarProducto(id) {
            console.log(id);
            // Aquí deberías escribir el código para eliminar el producto de la base de datos
            // utilizando una solicitud AJAX o fetch a tu archivo PHP correspondiente.
            fetch('../php/normal_user_act/eliminar_producto.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si la respuesta es exitosa y el producto se elimina de la base de datos, puedes hacer algo como esto:
                        var eliminarBtn = document.querySelector('.btn-danger');
                        eliminarBtn.style.display = 'none';
                        // También puedes eliminar la fila de la tabla en la interfaz si deseas
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            location.reload();
        }
    </script>

</body>

</html>