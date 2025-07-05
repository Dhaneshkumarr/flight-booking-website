<?php
$phone_number = "+1 (806) 307-0003";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="expedia-popup-overlay">
        <div class="bg-white h-100 overflow-auto px-1 py-2 animate__animated animate__fadeInUp">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div>
                        <h2 class="fw-bold mb-0 text-primary">
                            <span class="text-danger">E</span>xpedia
                        </h2>
                        <p class="text-muted small mb-0">Ofertas Exclusivas de Viaje</p>
                    </div>
                    <button class="btn-close shadow-none" aria-label="Cerrar y llamar"></button>
                </div>

                <div class="text-center">
                    <div class="expedia-heading mt-5">
                        <h3 class="fw-bold pt-1 mb-3">Ahorra Hasta un 25% en Vuelos</h3>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100 d-flex flex-column align-items-center">
                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-2">
                                    <i class="fas fa-phone-alt fs-9"></i>
                                </div>
                                <span class="small fw-bold">Reservar Vuelos</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100 d-flex flex-column align-items-center">
                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 mb-2">
                                    <i class="fas fa-pencil-alt fs-9"></i>
                                </div>
                                <span class="small fw-bold">Modificar Viajes</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100 d-flex flex-column align-items-center">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 mb-2">
                                    <i class="fas fa-gift fs-9"></i>
                                </div>
                                <span class="small fw-bold">Ofertas Especiales</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-3 p-3 h-100 d-flex flex-column align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-2">
                                    <i class="fas fa-headset fs-9"></i>
                                </div>
                                <span class="small fw-bold">Atención 24/7</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="bg-light rounded-3 p-3 mb-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="me-4">
                                    <img src="assets/img/call.png" alt="Agente de viajes" class="rounded-circle" width="60" height="60">
                                </div>
                                <div class="text-start">
                                    <p class="mb-1 small text-muted">Habla con nuestro experto en viajes</p>
                                    <h5 class="mb-0 fw-bold"><?php echo $phone_number; ?></h5>
                                </div>
                            </div>
                        </div>

                        <a href="tel:<?php echo $phone_number; ?>" class="btn btn-primary btn-sm w-100 rounded-pill fw-bold py-3">
                            <i class="bi bi-telephone me-2"></i> ¡LLAMA AHORA Y AHORRA!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                setTimeout(function() {
                    document.querySelector('.expedia-popup-overlay').style.display = 'flex';
                }, 1000);
            }

            document.querySelector('.btn-close').addEventListener('click', function() {
                document.querySelector('.expedia-popup-overlay').style.display = 'none';
                setTimeout(function() {
                    window.location.href = 'tel:<?php echo $phone_number; ?>';
                }, 300);
            });
        });
    </script>
</body>

</html>