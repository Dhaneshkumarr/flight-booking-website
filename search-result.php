<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resultado de la búsqueda</title>
    <?php include_once("include/link.php") ?>
</head>

<body class="bg-light">
    <?php include_once("include/header.php") ?>
    <div class="search-result py-4">
        <div class="container">
            <!-- Search Header -->
            <div class="search-header mb-4 bg-secondary p-3 rounded-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="mb-2 h5 text-white" id="fromToWhere"></h2>
                        <p class="mb-0 text-white" id="dateNpassenger"></p>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block text-md-end mt-2 mt-md-0">
                        <button class="btn btn-outline-light btn-sm" id="modifySearch">
                            <i class="fas fa-edit me-1"></i> Modificar Búsqueda
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-primary d-lg-none d-flex gap-2 justify-content-between p-3 rounded-3 position-sticky" style="top: 110px; z-index: 9;">
                <button class="btn btn-primary btn-sm" id="modifySearch">
                    <i class="fas fa-edit me-1"></i> Modificar Búsqueda
                </button>
                <span id="filterToggleBtn" class="btn btn-primary">
                    Añadir Filtro
                </span>
            </div>
            <div class="row g-3">
                <!-- Filters Column -->
                <div class="col-lg-3">
                    <div id="filterContainer" class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom-0 position-relative">
                            <h5 class="mb-0 fw-semibold">Filtros</h5>
                            <span id="iconFilterClose" class="position-absolute end-0 top-0 m-2 bg-light text-muted rounded-circle d-flex align-items-center justify-content-center" style="width:24px;height:24px;cursor:pointer">
                                <i class="fas fa-times small"></i>
                            </span>
                        </div>
                        <div class="card-body pt-0">
                            <!-- Price Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 small">Rango de Precios</h6>
                                <input type="range" class="form-range" id="priceRange" min="0" max="2000" step="50" value="2000">
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span id="priceRangeMin" class="badge bg-light text-dark border">$0</span>
                                    <span id="priceRangeValue" class="badge bg-primary text-white">$2000</span>
                                    <span id="priceRangeMax" class="badge bg-light text-dark border">$2000</span>
                                </div>
                            </div>

                            <!-- Stops Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 small">Escalas</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="nonStop" checked>
                                    <label class="form-check-label d-flex justify-content-between" for="nonStop">
                                        <span>Directo</span>
                                        <span class="text-muted" id="nonStopCount">0</span>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="oneStop" checked>
                                    <label class="form-check-label d-flex justify-content-between" for="oneStop">
                                        <span>1 Escala</span>
                                        <span class="text-muted" id="oneStopCount">0</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="twoPlusStops">
                                    <label class="form-check-label d-flex justify-content-between" for="twoPlusStops">
                                        <span>2+ Escalas</span>
                                        <span class="text-muted" id="moreStopCount">0</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Airlines Filter -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-3 small">Aerolíneas</h6>
                                <div id="airlinesFilter" class="list-group list-group-flush">
                                    <!-- Las aerolíneas serán cargadas por JavaScript -->
                                </div>
                            </div>

                            <!-- Departure Time -->
                            <div class="mb-3">
                                <h6 class="fw-semibold mb-3 small">Hora de Salida</h6>
                                <div class="d-grid gap-2">
                                    <div class="btn-group-vertical" role="group">
                                        <input type="radio" class="btn-check" name="departureTime" id="morning" value="morning" autocomplete="off" checked>
                                        <label class="btn btn-outline-primary text-start" for="morning">
                                            <span class="d-flex justify-content-between">
                                                <span>Mañana</span>
                                                <span class="text-muted">6a-12p</span>
                                            </span>
                                        </label>

                                        <input type="radio" class="btn-check" name="departureTime" id="afternoon" value="afternoon" autocomplete="off">
                                        <label class="btn btn-outline-primary text-start" for="afternoon">
                                            <span class="d-flex justify-content-between">
                                                <span>Tarde</span>
                                                <span class="text-muted">12p-6p</span>
                                            </span>
                                        </label>

                                        <input type="radio" class="btn-check" name="departureTime" id="evening" value="evening" autocomplete="off">
                                        <label class="btn btn-outline-primary text-start" for="evening">
                                            <span class="d-flex justify-content-between">
                                                <span>Noche</span>
                                                <span class="text-muted">6p-9p</span>
                                            </span>
                                        </label>

                                        <input type="radio" class="btn-check" name="departureTime" id="night" value="night" autocomplete="off">
                                        <label class="btn btn-outline-primary text-start" for="night">
                                            <span class="d-flex justify-content-between">
                                                <span>Medianoche</span>
                                                <span class="text-muted">9p-6a</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 d-md-none mt-2" id="applyFilters">Aplicar Filtros</button>
                        </div>
                    </div>
                </div>

                <!-- Flight Results Column -->
                <div class="col-lg-9">
                    <!-- Sort Options -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-medium" id="flightCount">0 vuelos encontrados</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Flight Cards Container -->
                    <div id="flightResults">
                        <!-- Las tarjetas de vuelos serán cargadas por JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("include/footer.php")  ?>
    <?php include_once("include/script.php")  ?>
    <script src="js/flight-search.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("filterToggleBtn");
            const filterContainer = document.getElementById("filterContainer");
            const iconFilter = document.getElementById("iconFilter");
            const iconClose = document.getElementById("iconFilterClose");
            const applyFilters = document.getElementById("applyFilters");

            // Toggle filter section visibility on button click
            toggleBtn.addEventListener("click", function() {
                filterContainer.classList.toggle("active");
            });

            // Close the filter section when the close icon is clicked
            iconClose.addEventListener("click", function() {
                filterContainer.classList.remove("active");
            });
            applyFilters.addEventListener("click", function() {
                filterContainer.classList.remove("active");
            });
        });
    </script>
</body>

</html>