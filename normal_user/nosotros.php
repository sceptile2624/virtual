<?php
// Iniciamos la sesión
session_start();

// Verificamos si la sesión está iniciada y si el usuario es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
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
                    <li><a href="nosotros.php" class="active">Nosotros</a></li>
                    <li><a href="compras.php">Productos</a></li>
                    <li><a href="carrito.php">Carrito</a></li>
		    <li><a href="http://webdav.vanshop.com/index.html">Ver PDF</a></li> 
                    <li><a href="../php/cerrar_sesion.php">Salir</a></li>
                </ul>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero">
        <div class="info d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 data-aos="fade-down"><span>VanShop</span></h2>
                    </div>
                </div>
            </div>
        </div>

        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-item active" style="background-image: url(https://img2.rtve.es/i/?w=1600&i=1599041762848.jpg)"></div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">
        <!-- ======= Constructions Section ======= -->
        <section id="constructions" class="constructions">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Acerca de nosotros</h2>
                </div>

                <div class="row gy-4">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-item">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="card-bg" style="background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGB
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
SlAKUpQClKUApSlAKUpQH//2Q==);"></div>
                                </div>
                                <div class="col-xl-7 d-flex align-items-center">
                                    <div class="card-body">
                                        <h4 class="card-title">Mejores prendas.</h4>
                                        <p>Vestibulum et metus gravida, pharetra metus at, molestie nibh. Fusce sollicitudin odio risus, vel place
rat massa tincidunt consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed purus vitae ligula consectetur convallis s
ollicitudin non risus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-item">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="card-bg" style="background-image: url(https://www.netrivals.com/wp-content/uploads/2019/11/noun_pr
ice_2011160-300x300.png)"></div>
                                </div>
                                <div class="col-xl-7 d-flex align-items-center">
                                    <div class="card-body">
                                        <h4 class="card-title">Los mejores precios</h4>
                                        <p>Sunt deserunt maiores voluptatem autem est rerum perferendis rerum blanditiis. Est laboriosam qui iste 
numquam laboriosam voluptatem architecto. Est laudantium sunt at quas aut hic. Eum dignissimos.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card Item -->
                </div>

            </div>
        </section><!-- End Constructions Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Servicios</h2>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                            <h3>Rapidez</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius scelerisque lorem, finibus luctus velit orn
are eget. Quisque egestas semper quam ut vestibulum. In ultrices elit in nisl lacinia, sit amet aliquet nisl pulvinar. Curabitur laoreet nunc arcu
, id aliquam est dignissim efficitur. Vestibulum et metus gravida, pharetra metus at, molestie nibh. Fusce sollicitudin odio risus, vel placerat m
assa tincidunt consectetur.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-face-laugh-beam"></i>
                            </div>
                            <h3>Calidad</h3>
                            <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolor
em.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                            <h3>Precio</h3>
                            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum cor
rupti.</p>
                        </div>
                    </div><!-- End Service Item -->
                </div>
            </div>
        </section><!-- End Services Section -->
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

</body>

</html>
