<?php
// Iniciamos la sesión
session_start();

// Verificamos si la sesión está iniciada y si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    // Si la sesión no está iniciada o el usuario no es administrador, redirigimos a la página de login
    header("Location: ../index.html");
    exit();
}
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

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

            <a href="agregar_productos.php" class="logo d-flex align-items-center">
                <h1>VanShop</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
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
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Link imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" id="nombre"></td>
                    <td><input type="text" class="form-control" id="descripcion"></td>
                    <td><input type="number" class="form-control" id="precio"></td>
                    <td>
                        <button class="btn btn-primary" onclick="guardarProducto()">Guardar</button>
                    </td>
                </tr>
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

                    // Obtener los productos de la tabla productos
                    $sql = "SELECT * FROM productos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $nombre = $row['nombre'];
                            $link_imagen = $row['link_imagen'];
                            $precio = $row['precio'];
                            ?>
                            <tr>
                                <td>
                                    <p><?php echo $nombre; ?></p>
                                    <input type="text" style="width: 100%" onchange="actualizacion(<?php echo $id ?>)" 
                                        name="actualizacion_nombre_<?php echo $id ?>" id="actualizacion_nombre_<?php echo $id ?>">
                                </td>
                                <td>
                                    <p><?php echo $link_imagen; ?></p>
                                    <input type="text" style="width: 100%" onchange="actualizacion(<?php echo $id ?>)" 
                                        name="actualizacion_img_<?php echo $id ?>" id="actualizacion_img_<?php echo $id ?>">
                                </td>
                                <td>
                                    <p><?php echo $precio; ?></p>
                                    <input type="number" step=0.1 style="width: 100%" onchange="actualizacion(<?php echo $id ?>)" 
                                        name="actualizacion_precio_<?php echo $id ?>" id="actualizacion_precio_<?php echo $id ?>">
                                </td>
                                <td>
                                    <button class="btn btn-danger" id="Eliminar_<?php echo $id ?>" onclick="eliminarProducto(<?php echo $id ?>)">Eliminar</button>
                                    <button class="btn btn-warning" style="display: none;" id="Modificar_<?php echo $id ?>" onclick="modificarProducto(<?php echo $id ?>) ">Modificar</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
                    }
                    $conn->close();
                    ?>
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

    <!-- ESTILOS NECESARIOS -->
    <script>
        function actualizacion(id){
            // Obtener el botón de eliminar y el botón de modificar
            var botonEliminar = document.getElementById("Eliminar_" + id);
            var botonModificar = document.getElementById("Modificar_" + id);
        
            // Ocultar el botón de eliminar y mostrar el botón de modificar
            if (botonEliminar) {
                botonEliminar.style.display = "none";
            }
            if (botonModificar) {
                botonModificar.style.display = "block";
                botonModificar.value = id;
            }
        }

        function guardarProducto() {
            var nombre = document.getElementById('nombre').value;
            var descripcion = document.getElementById('descripcion').value;
            var precio = document.getElementById('precio').value;
            console.log("s")
            // Envía los datos a PHP para guardar en la base de datos
            fetch('../php/admin_act/guardar_producto.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        nombre,
                        descripcion,
                        precio
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si la respuesta es exitosa y el producto se guarda en la base de datos, muestra el botón "Eliminar"
                        var eliminarBtn = document.querySelector('.btn-danger');
                        eliminarBtn.style.display = 'inline-block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                location.reload();

        }

        function eliminarProducto(id) {
            // Aquí deberías escribir el código para eliminar el producto de la base de datos
            // utilizando una solicitud AJAX o fetch a tu archivo PHP correspondiente.
            fetch('../php/admin_act/eliminar_producto.php', {
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
                        // También puedes eliminar la fila de la tabla en la interfaz si deseas.
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                location.reload();
        }

        function modificarProducto(id) {
            var identificador = id;
            var nombre = document.getElementById('actualizacion_nombre_'+id).value;
            var descripcion = document.getElementById('actualizacion_img_'+id).value;
            var precio = document.getElementById('actualizacion_precio_'+id).value;

            // Aquí deberías escribir el código para eliminar el producto de la base de datos
            // utilizando una solicitud AJAX o fetch a tu archivo PHP correspondiente.
            fetch('../php/admin_act/modificar_producto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    identificador,
                    nombre,
                    descripcion,
                    precio
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Si la respuesta es exitosa y el producto se guarda en la base de datos, muestra el botón "Eliminar"
                    var eliminarBtn = document.querySelector('.btn-danger');
                    eliminarBtn.style.display = 'inline-block';
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