<!doctype html>
<html lang="es">

<head>
  <!-- Meta tags requeridos -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sobre Nosotros</title>
  <?php include_once("include/link.php") ?>
</head>

<body>
  <?php include_once("include/header.php") ?>

  <div class="inner-banner">
    <div class="container">
      <h1 class="text-white bn_heading pb-3 text-uppercase fw-bold text-center">
        Sobre Nosotros
      </h1>
      <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item"><a href="index.php" class="text-warning text-decoration-none">hogar</a></li>
          <li class="breadcrumb-item text-white active" aria-current="page">Sobre Nosotros</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="about-us pt-4">
    <div class="container">
      <h2 class="text-secondary h4">Sobre nosotros</h2>

      <h3 class="h5 mt-4 fw-bold">sobre <?php echo $website_name; ?></h3>
      <p class="fw-semibold">
        En <?php echo $website_name; ?>, nos dedicamos a mejorar la experiencia de viaje integrando perfectamente la narrativa y el descubrimiento de destinos, en línea con el concepto de Libroleto. Nuestra plataforma ofrece servicios de reserva de vuelos en tiempo real, proporcionando una experiencia fluida, rentable y fácil de usar tanto para viajes nacionales como internacionales. Está diseñada para satisfacer una amplia gama de necesidades de viaje, incluyendo viajes de negocios, vacaciones familiares y escapadas espontáneas. Nuestros servicios conectan a los usuarios con información actualizada sobre vuelos y precios competitivos. Nuestro objetivo es simplificar y enriquecer el proceso de planificación de viajes, haciendo que cada viaje sea inolvidable.
      </p>

      <h3 class="h5 mt-4 fw-bold">Nuestra Visión</h3>
      <p>
        Nuestra plataforma ofrece una amplia selección de opciones de reserva de vuelos, adaptadas para satisfacer diversas preferencias, incluyendo precios, horarios y comodidad. Ya sea que estés planeando un viaje de negocios, unas vacaciones en familia o una escapada espontánea, <?php echo $website_name; ?> te conecta con información actualizada sobre vuelos y precios competitivos, simplificando y enriqueciendo tu experiencia de planificación de viajes.
      </p>
      <p>
        Es posible que, ocasionalmente, ofrezcamos descuentos promocionales u ofertas especiales, los cuales están sujetos a disponibilidad y a los términos y condiciones aplicables.
      </p>

      <p class="fw-bold text-success">
        ¡Encantados de ofrecerte un 25% de descuento en todos los servicios!
      </p>
    </div>
  </div>

  <?php include_once("include/footer.php") ?>
  <?php include_once("include/script.php") ?>
</body>

</html>