<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contáctanos</title>
  <?php include_once("include/link.php") ?>
</head>

<body>
  <?php include_once("include/header.php") ?>
  <div class="inner-banner">
    <div class="container">
      <h1 class="text-white bn_heading pb-3 text-uppercase fw-bold text-center">
        Contáctanos
      </h1>
      <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item"><a href="index.php" class="text-warning text-decoration-none">hogar</a></li>
          <li class="breadcrumb-item text-white active" aria-current="page">Contáctanos</li>
        </ol>
      </nav>
    </div>
  </div>
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4 align-items-stretch">

        <div class="col-lg-4">
          <div class="h-100 p-4 bg-white border rounded shadow-sm">
            <h2 class="h5 fw-bold text-primary mb-4">Ponte en Contacto</h2>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3 fs-4 text-primary">📞</div>
              <div>
                <h6 class="mb-1 fw-semibold">Llámanos</h6>
                <a href="tel:<?php echo $phone_number; ?>" class="text-decoration-none text-dark">
                  <?php echo $phone_number; ?>
                </a>
              </div>
            </div>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3 fs-4 text-primary">✉️</div>
              <div>
                <h6 class="mb-1 fw-semibold">Envíanos un correo</h6>
                <a href="mailto:<?php echo $email_address; ?>" class="text-decoration-none text-dark">
                  <?php echo $email_address; ?>
                </a>
              </div>
            </div>

            <?php if (!empty($address)): ?>
              <div class="d-flex align-items-start">
                <div class="me-3 fs-4 text-primary">📍</div>
                <div>
                  <h6 class="mb-1 fw-semibold">Visítanos</h6>
                  <p class="mb-0 text-dark"><?php echo $address; ?></p>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="h-100 p-4 bg-white border rounded shadow-sm">
            <h2 class="h5 fw-bold text-dark mb-4">Envíanos un Mensaje</h2>
            <form class="row g-3">
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Tu Nombre">
              </div>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico">
              </div>
              <div class="col-md-6">
                <input type="tel" name="phone" class="form-control" placeholder="Número de Teléfono">
              </div>
              <div class="col-md-6">
                <input type="text" name="subject" class="form-control" placeholder="Asunto">
              </div>
              <div class="col-12">
                <textarea name="message" rows="4" class="form-control" placeholder="Tu Mensaje"></textarea>
              </div>
              <div class="col-12">
                <button type="submit" class="btn bg-primary text-light px-4">Enviar Mensaje</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>


  <?php include_once("include/footer.php") ?>
  <?php include_once("include/script.php") ?>
</body>

</html>