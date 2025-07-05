<?php
$website_name = "flightbooking.us";
$phone_number = "+1 (806) 307-0003";
$email_address = "info@flightbooking.us";
?>
<!-- Professional Airline Top Bar -->
<div class="airline-top-bar text-white">
    <div class="container">
        <div class="row align-items-center py-2 gy-2 flex-column flex-md-row justify-content-between">

            <!-- Lado izquierdo - Información de confianza -->
            <div class="col-auto">
                <div class="d-flex flex-wrap align-items-center gap-3 small">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-shield-alt text-success"></i>
                        <span>Reserva segura y confiable</span>
                    </div>
                    <div class="d-none d-lg-flex align-items-center gap-2">
                        <i class="fas fa-clock text-info"></i>
                        <span>Reserva en cualquier momento y lugar</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-headset text-primary"></i>
                        <span>Atención al cliente 24/7</span>
                    </div>
                </div>
            </div>

            <!-- Lado derecho - Contacto y ubicación -->
            <div class="col-auto">
                <div class="d-flex flex-wrap justify-content-center justify-content-md-end align-items-center gap-3 text-white">

                    <!-- Teléfono -->
                    <a href="tel:<?php echo $phone_number; ?>" class="text-white text-decoration-none d-flex align-items-center gap-1">
                        <i class="fas fa-phone-alt fs-9 text-success"></i>
                        <span class="d-none d-sm-inline"><?php echo $phone_number; ?></span>
                        <span class="d-inline d-sm-none">Llamar</span>
                    </a>

                    <!-- Correo electrónico -->
                    <a href="mailto:<?php echo $email_address; ?>" class="text-white text-decoration-none d-flex align-items-center gap-1">
                        <i class="fas fa-envelope fs-9 text-primary"></i>
                        <span class="d-none d-md-inline"><?php echo $email_address; ?></span>
                        <span class="d-inline d-md-none">Correo</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Premium Airline Navigation -->
<header class="sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
        <div class="container position-relative">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" alt="Logo de Aerolínea" class="img-fluid transition-all" width="200" style="transition: all 0.3s ease;">
            </a>

            <!-- Botón de menú móvil animado -->
            <button class="navbar-toggler border-0 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

            <!-- Contenido de navegación -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Menú principal con efectos hover -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-1 mx-lg-2 position-relative">
                        <a class="nav-link px-1 py-2 rounded <?php echo ($currentPage == 'index.php') ? 'active text-primary fw-bold' : 'text-primary'; ?>" href="index.php">
                            <i class="fas fa-home me-2"></i>
                            <span>Hogar</span>
                            <div class="nav-hover-indicator"></div>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mx-lg-2 position-relative">
                        <a class="nav-link px-1 py-2 rounded <?php echo ($currentPage == 'about-us.php') ? 'active text-primary fw-bold' : 'text-primary'; ?>" href="about-us.php">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>Sobre Nosotros</span>
                            <div class="nav-hover-indicator"></div>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mx-lg-2 position-relative">
                        <a class="nav-link px-1 py-2 rounded <?php echo ($currentPage == 'privacy-policy.php') ? 'active text-primary fw-bold' : 'text-primary'; ?>" href="privacy-policy.php">
                            <i class="fas fa-map-marked-alt me-2"></i>
                            <span>Política de Privacidad</span>
                            <div class="nav-hover-indicator"></div>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mx-lg-2 position-relative">
                        <a class="nav-link px-1 py-2 rounded <?php echo ($currentPage == 'contact-us.php') ? 'active text-primary fw-bold' : 'text-primary'; ?>" href="contact-us.php">
                            <i class="fas fa-envelope me-2"></i>
                            <span>Contacto</span>
                            <div class="nav-hover-indicator"></div>
                        </a>
                    </li>
                </ul>

                <!-- Botón premium de Llamar ahora -->
                <div class="d-flex ms-lg-3">
                    <a href="tel:<?php echo $phone_number ?>" class="supportBtn btn rounded-pill px-3 py-2 fw-bold d-flex align-items-center shadow hover-effects">
                        <div class="position-relative me-2">
                            <div class="d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <img src="assets/img/call2.gif" alt="" style="width: 68px; height: 46px;">
                            </div>
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle pulse-animation" style="width: 12px; height: 12px; border: 2px solid white;"></span>
                        </div>
                        <div class="d-flex flex-column text-start lh-1 me-2">
                            <small class="small text-white mb-1" style="opacity: 0.9;">Llámanos 24/7</small>
                            <span class="text-white fw-bold"><?php echo $phone_number ?></span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 16 16" class="ms-1">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>