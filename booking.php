<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reserva</title>
    <?php include_once("include/link.php") ?>
</head>

<body class="bg-light">
    <?php include_once("include/header.php") ?>
    <div class="search-result py-4">
        <div class="container">
            <form id="bookingForm" method="POST">
                <div class="row g-3">
                    <div class="col-lg-6 position-relative">
                        <div class="card shadow-sm mb-3">
                            <h4 class="mb-0 h5 card-header bg-primary text-white">
                                <i class="fas fa-plane me-2"></i>Vuelo Seleccionado
                            </h4>
                            <div class="card-body p-3" id="selectedFlightContainer">
                                <!-- Los detalles del vuelo serán completados por JavaScript -->
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                    <p class="mt-3">Cargando detalles del vuelo...</p>
                                </div>
                            </div>
                        </div>
                        <!-- Detalles del Pasajero -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 h5 text-white">
                                    <i class="fas fa-users me-2"></i>Detalles del Pasajero
                                </h4>
                                <button type="button" class="btn btn-sm btn-outline-light" id="addPassengerBtn">
                                    <i class="fas fa-plus me-1"></i>Agregar Pasajero
                                </button>
                            </div>
                            <div class="card-body p-3">
                                <div class="alert alert-primary bg-light border-0 mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Ingrese el/los nombre(s) exactamente como aparece(n) en el pasaporte o identificación oficial.
                                </div>

                                <div id="passengersContainer">
                                    <!-- Los campos de pasajero se agregarán aquí -->
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="card shadow-sm mb-3">
                            <h4 class="mb-0 h5 card-header bg-primary text-white">
                                <i class="fas fa-envelope me-2"></i>Información de Contacto
                            </h4>
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Correo Electrónico*</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Número de Teléfono*</label>
                                        <input type="tel" name="phone" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Información de Pago -->
                        <div class="card shadow-sm mb-3">
                            <h4 class="mb-0 h5 card-header bg-primary text-white">
                                <i class="fas fa-credit-card me-2"></i>Información de Pago
                            </h4>
                            <div class="card-body p-3">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Número de Tarjeta*</label>
                                        <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Nombre en la Tarjeta*</label>
                                        <input type="text" name="card_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Mes de Expiración*</label>
                                        <select class="form-select" name="exp_month" required>
                                            <option value="">Mes</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Año de Expiración*</label>
                                        <select class="form-select" name="exp_year" required>
                                            <option value="">Año</option>
                                            <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">CVV*</label>
                                        <input type="text" name="cvv" class="form-control" placeholder="123" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 position-relative">
                        <!-- Resumen de Pago -->
                        <div class="card shadow-sm position-sticky" style="top: 100px;">
                            <h4 class="mb-0 h5 card-header bg-primary text-white">
                                <i class="fas fa-receipt me-2"></i>Resumen de Tarifas
                            </h4>
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Pasajeros:</span>
                                    <span id="passengerCount">Cargando...</span>
                                </div>

                                <hr>

                                <h6 class="mb-3">Tarifa Base</h6>
                                <div id="baseFare"></div>

                                <hr>

                                <h6 class="mb-3">Impuestos y Cargos</h6>
                                <div id="taxesFees"></div>

                                <hr>

                                <div class="d-flex justify-content-between fw-bold fs-0">
                                    <span>Precio Total:</span>
                                    <span id="totalPrice">$0.00</span>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-4 py-3">
                                    <i class="fas fa-lock me-2"></i>Confirmar Reserva
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Formularios de Pasajeros y Pago -->
        </div>
    </div>

    <!-- <style>
        .flight-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .airline-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .segment-details {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin-bottom: 15px;
        }

        .flight-route-line {
            height: 1px;
            background: #dee2e6;
            position: relative;
            margin: 5px 0;
        }

        .flight-route-line:after {
            content: '✈';
            position: absolute;
            right: 0;
            top: -8px;
            background: white;
            padding: 0 3px;
        }

        .passenger-card {
            transition: all 0.3s ease;
        }

        .price-summary {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .flight-time {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .flight-info .badge {
            margin-right: 5px;
        }
    </style> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get booking data from sessionStorage
            const selectedFlight = JSON.parse(sessionStorage.getItem('selectedFlight'));
            const searchFormData = JSON.parse(sessionStorage.getItem('searchFormData'));
            const storedPassengerData = JSON.parse(sessionStorage.getItem('passengerData'));

            if (!selectedFlight) {
                window.location.href = 'search-result.php';
                return;
            }

            // Render flight details
            renderSelectedFlight(selectedFlight);

            // Initialize passengers
            initializePassengers(searchFormData?.passengers, storedPassengerData);

            // Update fare summary
            updateFareSummary(selectedFlight, searchFormData?.passengers);

            // Setup form validation and restore saved data
            setupFormValidation();
            restoreFormData(storedPassengerData);

            // Add passenger button
            document.getElementById('addPassengerBtn').addEventListener('click', function() {
                const currentCount = document.querySelectorAll('.passenger-card').length;
                addPassengerField(currentCount);
            });
        });

        function renderSelectedFlight(flight) {
            const container = document.getElementById('selectedFlightContainer');
            const flightData = JSON.parse(sessionStorage.getItem('flightResults'));
            const carriers = flightData?.dictionaries?.carriers || {};
            const aircraft = flightData?.dictionaries?.aircraft || {};

            // Outbound flight details
            const outbound = flight.itineraries[0];
            const outboundSegments = outbound.segments;
            const outboundFirstSegment = outboundSegments[0];
            const outboundLastSegment = outboundSegments[outboundSegments.length - 1];

            // Return flight details (if exists)
            let returnFlightHtml = '';
            if (flight.itineraries[1]) {
                const returnItin = flight.itineraries[1];
                const returnSegments = returnItin.segments;
                const returnFirstSegment = returnSegments[0];
                const returnLastSegment = returnSegments[returnSegments.length - 1];

                returnFlightHtml = `
            <div class="mt-4">
                <h5><i class="fas fa-plane-arrival me-2"></i>Return Flight</h5>
                ${renderItineraryDetails(returnItin, carriers, aircraft)}
            </div>
        `;
            }

            container.innerHTML = `
        <div class="flight-summary">
            <div class="d-flex align-items-center mb-4">
                <img src="https://logo.clearbit.com/${carriers[outboundFirstSegment.carrierCode]?.toLowerCase().replace(/\s/g, '')}.com" 
                     alt="${carriers[outboundFirstSegment.carrierCode]}" 
                     class="airline-logo me-3"
                     onerror="this.src='https://via.placeholder.com/100?text=${outboundFirstSegment.carrierCode}'">
                <div>
                    <h5 class="mb-1">${carriers[outboundFirstSegment.carrierCode]} Flight</h5>
                    <div class="text-muted">${outboundFirstSegment.departure.iataCode} to ${outboundLastSegment.arrival.iataCode}</div>
                </div>
            </div>
            
            <div class="flight-details-section">
                <h5><i class="fas fa-plane-departure me-2"></i>Outbound Flight</h5>
                ${renderItineraryDetails(outbound, carriers, aircraft)}
            </div>
            
            ${returnFlightHtml}
            
            <div class="mt-4">
                <h5><i class="fas fa-suitcase me-2"></i>Información de equipaje</h5>
                ${renderBaggageInfo(flight)}
            </div>
            
            <div class="mt-4 price-summary">
                <h5><i class="fas fa-receipt me-2"></i>Resumen de precios</h5>
                <div class="d-flex justify-content-between">
                    <span>Precio total:</span>
                    <span class="fw-bold">${flight.price.currency} ${flight.price.total}</span>
                </div>
            </div>
        </div>
    `;
        }

        function renderItineraryDetails(itinerary, carriers, aircraft) {
            return itinerary.segments.map(segment => {
                const departure = new Date(segment.departure.at);
                const arrival = new Date(segment.arrival.at);
                const duration = calculateDuration(segment.duration || 'PT0H0M');

                return `
            <div class="segment-details">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="flight-time">${departure.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                        <div class="text-muted small">${segment.departure.iataCode}</div>
                        <div class="text-muted small">${departure.toLocaleDateString()}</div>
                    </div>
                    <div class="text-center px-3">
                        <div class="text-muted small">${duration}</div>
                        <div class="flight-route-line"></div>
                        <span class="badge ${getStopBadgeClass([segment])}">
                            ${segment.numberOfStops === 0 ? 'Non-stop' : `${segment.numberOfStops} Stop(s)`}
                        </span>
                    </div>
                    <div class="text-end">
                        <div class="flight-time">${arrival.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                        <div class="text-muted small">${segment.arrival.iataCode}</div>
                        <div class="text-muted small">${arrival.toLocaleDateString()}</div>
                    </div>
                </div>
                <div class="mt-2 flight-info">
                    <span class="badge bg-light text-dark me-2">
                        ${carriers[segment.carrierCode]} ${segment.number}
                    </span>
                    <span class="badge bg-light text-dark">
                        ${aircraft[segment.aircraft.code] || segment.aircraft.code}
                    </span>
                </div>
            </div>
        `;
            }).join('');
        }

        function initializePassengers(passengerConfig, storedData) {
            const container = document.getElementById('passengersContainer');
            container.innerHTML = '';

            // Default to 1 adult passenger if no stored data
            const passengerCount = storedData?.passengers?.length || passengerConfig?.adults || 1;

            for (let i = 0; i < passengerCount; i++) {
                addPassengerField(i, storedData?.passengers?.[i]);
            }

            updatePassengerCount();
        }

        function addPassengerField(index, data = null) {
            const container = document.getElementById('passengersContainer');
            const passengerId = `passenger-${index}`;

            const passengerHtml = `
    <div class="passenger-card mb-3" id="${passengerId}">
        <div class="card">
            <div class="card-body p-3">
                <div class="row g-3">
                    <div class="col-lg-12 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Pasajero ${index + 1}</h6>
                        ${index > 0 ? `<button type="button" class="btn btn-sm btn-outline-danger remove-passenger" data-passenger-id="${passengerId}">
                            <i class="fas fa-times"></i> Eliminar
                        </button>` : ''}
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nombre*</label>
                        <input type="text" name="passenger_first_name[]" class="form-control" 
                               value="${data?.first_name || ''}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Apellido*</label>
                        <input type="text" name="passenger_last_name[]" class="form-control" 
                               value="${data?.last_name || ''}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipo de pasajero*</label>
                        <select class="form-select" name="passenger_type[]" required>
                            <option value="adult" ${(!data || data.type === 'adult') ? 'selected' : ''}>Adulto (12+ años)</option>
                            <option value="child" ${data?.type === 'child' ? 'selected' : ''}>Niño (2-11 años)</option>
                            <option value="infant" ${data?.type === 'infant' ? 'selected' : ''}>Bebé (0-23 meses)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;

            container.insertAdjacentHTML('beforeend', passengerHtml);

            // Add event listener for remove button
            if (index > 0) {
                document.querySelector(`[data-passenger-id="${passengerId}"]`).addEventListener('click', function() {
                    document.getElementById(passengerId).remove();
                    updatePassengerCount();
                });
            }
        }

        function updatePassengerCount() {
            const adultCount = document.querySelectorAll('select[name="passenger_type[]"] option[value="adult"]:checked').length;
            const childCount = document.querySelectorAll('select[name="passenger_type[]"] option[value="child"]:checked').length;
            const infantCount = document.querySelectorAll('select[name="passenger_type[]"] option[value="infant"]:checked').length;

            document.getElementById('passengerCount').textContent =
                `${adultCount} Adult${adultCount !== 1 ? 's' : ''}, ${childCount} Child${childCount !== 1 ? 'ren' : ''}, ${infantCount} Infant${infantCount !== 1 ? 's' : ''}`;
        }

        function updateFareSummary(flight, passengers = {
            adults: 1,
            children: 0,
            infants: 0
        }) {
            const adultCount = passengers?.adults || 1;
            const childCount = passengers?.children || 0;
            const infantCount = passengers?.infants || 0;

            // Update the fare summary
            document.getElementById('totalPrice').textContent =
                `${flight.price.currency} ${flight.price.total}`;

            // Example breakdown (adjust based on your flight data structure)
            document.getElementById('baseFare').innerHTML = `
        <div class="d-flex justify-content-between">
            <span>Base Fare (${adultCount} Adult${adultCount !== 1 ? 's' : ''})</span>
            <span>${flight.price.currency} ${(parseFloat(flight.price.total) * 0.8).toFixed(2)}</span>
        </div>
        ${childCount > 0 ? `
        <div class="d-flex justify-content-between">
            <span>Base Fare (${childCount} Child${childCount !== 1 ? 'ren' : ''})</span>
            <span>${flight.price.currency} ${(parseFloat(flight.price.total) * 0.6 * childCount).toFixed(2)}</span>
        </div>` : ''}
        ${infantCount > 0 ? `
        <div class="d-flex justify-content-between">
            <span>Base Fare (${infantCount} Infant${infantCount !== 1 ? 's' : ''})</span>
            <span>${flight.price.currency} ${(parseFloat(flight.price.total) * 0.1 * infantCount).toFixed(2)}</span>
        </div>` : ''}
    `;

            document.getElementById('taxesFees').innerHTML = `
        <div class="d-flex justify-content-between">
            <span>Taxes & Fees</span>
            <span>${flight.price.currency} ${(parseFloat(flight.price.total) * 0.2).toFixed(2)}</span>
        </div>
    `;
        }

        function setupFormValidation() {
            const form = document.getElementById('bookingForm');

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        }

        function restoreFormData(data) {
            if (!data) return;

            // Restore contact information
            if (data.contact) {
                document.querySelector('input[name="email"]').value = data.contact.email || '';
                document.querySelector('input[name="phone"]').value = data.contact.phone || '';
            }

            // Restore payment information
            if (data.payment) {
                document.querySelector('input[name="card_number"]').value = data.payment.card_number || '';
                document.querySelector('input[name="card_name"]').value = data.payment.card_name || '';
                document.querySelector('select[name="exp_month"]').value = data.payment.exp_month || '';
                document.querySelector('select[name="exp_year"]').value = data.payment.exp_year || '';
                document.querySelector('input[name="cvv"]').value = data.payment.cvv || '';
            }
        }

        // Helper functions
        function calculateDuration(isoDuration) {
            const matches = isoDuration.match(/PT(?:(\d+)H)?(?:(\d+)M)?/);
            const hours = matches[1] ? parseInt(matches[1]) : 0;
            const minutes = matches[2] ? parseInt(matches[2]) : 0;
            return `${hours}h ${minutes}m`;
        }

        function getStopBadgeClass(segments) {
            const totalStops = segments.reduce((sum, segment) => sum + (segment.numberOfStops || 0), 0);
            if (totalStops === 0) return 'bg-success';
            if (totalStops === 1) return 'bg-warning text-dark';
            return 'bg-danger';
        }

        function getStopText(segments) {
            const totalStops = segments.reduce((sum, segment) => sum + (segment.numberOfStops || 0), 0);
            if (totalStops === 0) return 'Non-stop';
            if (totalStops === 1) return '1 Stop';
            return `${totalStops} Stops`;
        }

        function renderBaggageInfo(flight) {
            const baggage = flight.travelerPricings?.[0]?.fareDetailsBySegment?.[0]?.includedCheckedBags;
            if (!baggage) return '<div class="alert alert-primary bg-light border-0">Información de equipaje no disponible</div>';

            return `
    <div class="alert alert-primary bg-light border-0">
        <i class="fas fa-suitcase me-2"></i>
        Equipaje facturado incluido: ${baggage.weight} ${baggage.weightUnit}
    </div>
    <div class="alert alert-primary bg-light border-0 mt-2">
        <i class="fas fa-briefcase me-2"></i>
        Equipaje de mano: 7kg
    </div>
`;

        }

        // Update count when passenger type changes
        document.addEventListener('change', function(e) {
            if (e.target.matches('select[name="passenger_type[]"]')) {
                updatePassengerCount();
            }
        });
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (this.checkValidity()) {
                const formData = new FormData(this);
                const bookingData = {
                    flight: JSON.parse(sessionStorage.getItem('selectedFlight')),
                    passengers: [],
                    contact: {
                        email: formData.get('email'),
                        phone: formData.get('phone')
                    },
                    payment: {
                        card_number: formData.get('card_number'),
                        card_name: formData.get('card_name'),
                        exp_month: formData.get('exp_month'),
                        exp_year: formData.get('exp_year'),
                        cvv: formData.get('cvv')
                    },
                    timestamp: new Date().toISOString(),
                    pnr: generatePNR()
                };

                // Get all passenger data
                const firstNames = formData.getAll('passenger_first_name[]');
                const lastNames = formData.getAll('passenger_last_name[]');
                const types = formData.getAll('passenger_type[]');

                for (let i = 0; i < firstNames.length; i++) {
                    bookingData.passengers.push({
                        first_name: firstNames[i],
                        last_name: lastNames[i],
                        type: types[i],
                        ticket_number: generateTicketNumber(),
                        seat: generateSeat()
                    });
                }

                // Store booking data in sessionStorage
                sessionStorage.setItem('bookingData', JSON.stringify(bookingData));

                // Redirect to confirmation page
                window.location.href = 'booking-confirmation.php';
            } else {
                this.classList.add('was-validated');
            }
        });

        // Helper function to generate a random PNR
        function generatePNR() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        // Helper function to generate a ticket number
        function generateTicketNumber() {
            return 'SW' + Math.floor(1000000000 + Math.random() * 9000000000);
        }

        // Helper function to generate a random seat
        function generateSeat() {
            const rows = ['A', 'B', 'C', 'D', 'E', 'F'];
            return Math.floor(1 + Math.random() * 30) + rows[Math.floor(Math.random() * rows.length)];
        }
    </script>
    <?php include_once("include/footer.php")  ?>
    <?php include_once("include/script.php")  ?>

</body>

</html>