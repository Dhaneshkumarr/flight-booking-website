<div class="popup-content bg-light d-lg-none">
    <!-- Main content -->
    <div class="container py-3 px-3">
        <!-- Header -->
        <div class="text-center border-bottom pb-3">
            <img src="assets/img/logo.svg" alt="Logo" class="img-fluid mb-4" style="max-height: 40px;">
            <h3 class="text-danger fw-bolder">¡OFERTA EXCLUSIVA!</h3>
            <p class="text-muted">La oferta expira pronto - ¡no te la pierdas!</p>
        </div>

        <!-- Benefits list -->
        <div class="mb-4">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex">
                        <span class="badge bg-danger me-3">AHORRA</span>
                        <div>
                            <h6 class="card-title fw-bold mb-1">25% de Descuento en Todos los Vuelos</h6>
                            <p class="card-text text-muted small">Descuento por tiempo limitado en tu reserva</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex">
                        <span class="badge bg-success me-3">OFERTA</span>
                        <div>
                            <h6 class="card-title fw-bold mb-1">Cambios Flexibles</h6>
                            <p class="card-text text-muted small">Cancela o modifica sin cargos</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex">
                        <span class="badge bg-primary me-3">24/7</span>
                        <div>
                            <h6 class="card-title fw-bold mb-1">Soporte Dedicado</h6>
                            <p class="card-text text-muted small">Nuestro equipo está siempre disponible</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to action -->
        <div class="text-center mt-4">
            <div class="alert alert-warning d-inline-flex align-items-center mb-3 py-2">
                <i class="bi bi-clock-fill fs-5 me-2"></i>
                <div class="text-start">
                    <small class="d-block fw-bold">Oferta por Tiempo Limitado</small>
                    <small>Expira en 2 horas</small>
                </div>
            </div>

            <a href="tel:<?php echo $phone_number; ?>" class="btn btn-danger btn-lg w-100 mb-3 fw-bold rounded-pill">
                <i class="bi bi-telephone-fill me-2"></i> LLAMA AHORA: <?php echo $phone_number; ?>
            </a>

            <p class="small text-muted m-0">
                <i class="bi bi-lock-fill me-1"></i> Tu información está segura
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.querySelector('.fullscreen-popup');
        const closeBtns = document.querySelectorAll('.btn-close, .btn-dismiss');

        // Show on mobile after 1 second
        if (window.innerWidth <= 768) {
            setTimeout(() => popup.style.display = 'block', 1000);
        }

        // Close buttons
        closeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                popup.style.display = 'none';
            });
        });

        // Hide if window resized to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) popup.style.display = 'none';
        });
    });
</script>