<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Expedia</title>
    <?php include_once("include/link.php") ?>
</head>

<body>
    <?php include_once("include/header.php")  ?>
    <?php include_once("include/search-loader.php")  ?>
    <div id="main-section">
        <?php include_once("popup.php") ?>
        <?php include_once("popup-head.php") ?>
        <!-- Banner Section -->
        <div class="expedia_banner text-white position-relative py-3 py-md-5 mb-lg-5">
            <div class="container">
                <h1 class="display-5 fw-bold mb-3 text-white">Descubre Tu Viaje Perfecto</h1>
            </div>
            <div class="container position-static position-lg-absolute form-absolute start-0 z-3 end-0 searchForm">
                <?php include_once("search-form/form.php"); ?>
            </div>
        </div>

        <div class="py-3">
            <div class="container">
                <h3 class="h5 mt-4">Resumen de Expedia</h3>
                <p>
                    Expedia ofrece una amplia gama de servicios de viaje para adaptarse a todos los presupuestos. Con más de 200 sitios web de viajes y operaciones en más de 70 países, Expedia Group facilita a los viajeros la reserva de todo lo que necesitan para un viaje. Con cientos de miles de socios hoteleros internacionales y una oferta inclusiva de vuelos económicos, los viajeros pueden planificar cómodamente todo su viaje en un solo lugar.
                </p>

                <p>
                    En Expedia, creemos que viajar es una fuerza para el bien. Nuestra misión es impulsar los viajes globales para todos, en todas partes, proporcionando acceso sin interrupciones a experiencias de viaje y fomentando conexiones significativas en todo el mundo. A través de su plataforma y capacidades tecnológicas, Expedia Group busca hacer que viajar sea más fácil, agradable y accesible para personas de todo el mundo.
                </p>

                <h3 class="h5 mt-4">Qué ofrece Expedia</h3>
                <ul>
                    <li><strong>Variedad Extensa:</strong> Explora más de 3 millones de propiedades, incluyendo hoteles, alquileres vacacionales y más.</li>
                    <li><strong>Alcance Global:</strong> Coordinación con más de 500 aerolíneas y numerosas líneas de cruceros.</li>
                </ul>

                <h3 class="h5 mt-4">Servicios de Reserva de Vuelos</h3>
                <p>
                    Expedia ofrece una plataforma completa para la reserva de vuelos, permitiendo a los pasajeros buscar y comparar opciones de vuelo de una red global de aerolíneas. Al utilizar las funciones y herramientas de Expedia, los viajeros pueden buscar y reservar vuelos de manera eficiente, asegurando una experiencia de viaje fluida y rentable.
                </p>

                <h3 class="h5 mt-4">Servicios de Reserva de Hoteles</h3>
                <p>
                    Expedia proporciona acceso a un inventario extenso de opciones de alojamiento, que abarca más de 3.5 millones de propiedades en todo el mundo. Esta diversa selección va desde alojamientos económicos hasta resorts de lujo, atendiendo a una amplia gama de preferencias y presupuestos de los viajeros. A través de las diversas plataformas de Expedia, los viajeros pueden buscar, comparar y reservar alojamientos que mejor se adapten a sus necesidades.
                </p>

                <h3 class="h5 mt-4">Servicios de Alquiler de Coches</h3>
                <p>
                    Expedia colabora con una diversa gama de proveedores de alquiler de coches reconocidos para ofrecer a los viajeros una amplia selección de vehículos adaptados a diversas necesidades y preferencias. A través de la plataforma de Expedia, los clientes pueden navegar, comparar y reservar coches de alquiler de manera fluida con socios confiables, asegurando opciones de transporte convenientes y fiables para sus viajes.
                </p>

                <p>
                    Estamos orgullosos de ser uno de los sitios web afiliados que colaboran con Expedia Group, un líder global en servicios de viaje. Ofrecemos a nuestros usuarios acceso sin interrupciones a la extensa gama de productos de viaje de Expedia, que incluye más de 3 millones de alojamientos, vuelos de más de 500 aerolíneas, alquiler de coches, cruceros y actividades en todo el mundo.
                </p>

                <p>Gracias por elegir <?php echo $website_name; ?>. Esperamos poder ayudarte a explorar el mundo y crear experiencias de viaje inolvidables.</p>
            </div>
        </div>


        <?php include_once("include/footer.php") ?>
        <?php include_once("include/script.php") ?>
    </div>
</body>

</html>