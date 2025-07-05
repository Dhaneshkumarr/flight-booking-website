<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Confirmación de reserva</title>
    <?php include_once("include/link.php") ?>
</head>

<body>
    <?php include_once("include/header.php")  ?>
    <section class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Confirmation Header -->
                    <div class="confirmation-card mb-4">
                        <div class="confirmation-header p-2 text-center">
                            <h1 class="display-5 fw-bold mb-3"><i class="fas fa-check-circle me-2"></i> ¡Reserva Confirmada!</h1>
                            <p class="lead mb-0">Tu vuelo ha sido reservado con éxito. Los detalles se muestran a continuación.</p>
                        </div>
                        <div class="card-body bg-white p-3 mt-3">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-success rounded-pill p-2 me-3" id="confirmationPnr">PNR: Cargando...</span>
                                <span class="text-muted" id="bookingDate">Fecha de Reserva: Cargando...</span>
                            </div>
                            <h3 class="mb-2">¡Gracias por elegir nuestro servicio!</h3>
                            <p class="mb-0">Se ha enviado un correo de confirmación a <strong id="confirmationEmail">Cargando...</strong> con tu billete electrónico y detalles del itinerario.</p>
                        </div>
                    </div>

                    <!-- Flight Details -->
                    <div class="confirmation-card card mb-4">
                        <h3 class="mb-0 h5 card-header bg-secondary text-white"><i class="fas fa-plane "></i> Detalles del Vuelo</h3>
                        <div class="card-body" id="flightDetailsContainer">
                            <!-- Será completado por JavaScript -->
                        </div>
                    </div>

                    <!-- Passenger Details -->
                    <div class="confirmation-card card mb-4">
                        <h3 class="mb-0 h5 card-header bg-secondary text-white"><i class="fas fa-users"></i> Detalles de los Pasajeros</h3>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-border" id="passengersTable">
                                    <thead>
                                        <tr>
                                            <th>Pasajero</th>
                                            <th>Asiento</th>
                                            <th>Número de Boleto</th>
                                            <th>Equipaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Será completado por JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="confirmation-card card mb-4">
                        <h3 class="mb-0 h5 card-header bg-secondary text-white"><i class="fas fa-receipt"></i> Resumen de Pago</h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h5 class="fw-bold mb-3">Resumen de Tarifas</h5>
                                    <ul class="list-group list-group-flush" id="fareSummary">
                                        <!-- Será completado por JavaScript -->
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Método de Pago</h5>
                                    <div class="card border-0 bg-light p-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fab fa-cc-visa fa-2x text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-0" id="paymentCard">VISA terminando en ****</h6>
                                                <small class="text-muted" id="paymentDate">Pagado el Cargando...</small>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class=" mb-1"><i class="fas fa-receipt me-2"></i> Factura #<span id="invoiceNumber">Cargando...</span></p>
                                            <p class=" mb-0"><i class="fas fa-envelope me-2"></i> Enviado a <span id="paymentEmail">Cargando...</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get booking data from sessionStorage
            const bookingData = JSON.parse(sessionStorage.getItem('bookingData'));

            if (!bookingData) {
                sessionStorage.removeItem('selectedFlight');
                sessionStorage.removeItem('flightResults');
                sessionStorage.removeItem('formdata');
                sessionStorage.removeItem('bookingData');
                sessionStorage.removeItem('searchFormData');
                sessionStorage.removeItem('passengerData');
                window.location.href = 'index.php';
                return;
            }

            // Set confirmation header info
            document.getElementById('confirmationPnr').textContent = `PNR: ${bookingData.pnr}`;
            document.getElementById('bookingDate').textContent = `Booking Date: ${new Date(bookingData.timestamp).toLocaleDateString()}`;
            document.getElementById('confirmationEmail').textContent = bookingData.contact.email;

            // Render flight details
            renderFlightDetails(bookingData.flight);

            // Render passenger details
            renderPassengerDetails(bookingData.passengers);

            // Render payment summary
            renderPaymentSummary(bookingData);

            // Set up button event listeners
            setupConfirmationButtons(bookingData);
        });

        function renderFlightDetails(flight) {
            const container = document.getElementById('flightDetailsContainer');

            if (!flight || !flight.itineraries || flight.itineraries.length === 0) {
                container.innerHTML = '<div class="alert alert-danger">Flight details not available</div>';
                return;
            }

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
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-0 bg-light p-3 h-100">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Return Flight</span>
                            <span class="badge bg-primary">${returnFirstSegment.carrierCode} ${returnFirstSegment.number}</span>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <h5 class="fw-bold">${new Date(returnFirstSegment.departure.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h5>
                                <p class=" mb-0">${returnFirstSegment.departure.iataCode}</p>
                                <p class="">${new Date(returnFirstSegment.departure.at).toLocaleDateString()}</p>
                            </div>
                            <div class="col-4 text-center">
                                <p class=" mb-1">${calculateDuration(returnItin.duration)}</p>
                                <div class="border-top pt-1">
                                    <span class="badge bg-light text-dark">${returnFirstSegment.numberOfStops === 0 ? 'Non-stop' : `${returnFirstSegment.numberOfStops} Stop(s)`}</span>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <h5 class="fw-bold">${new Date(returnLastSegment.arrival.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h5>
                                <p class=" mb-0">${returnLastSegment.arrival.iataCode}</p>
                                <p class="">${new Date(returnLastSegment.arrival.at).toLocaleDateString()}</p>
                            </div>
                        </div>
                        <div class="mt-3">
    <p class="mb-1"><i class="fas fa-suitcase-rolling me-2"></i> Equipaje de mano: 7kg</p>
    <p class="mb-0"><i class="fas fa-suitcase me-2"></i> Equipaje facturado: 23kg × 1</p>
</div>

                    </div>
                </div>
            </div>
        `;
            }

            container.innerHTML = `
        <div class="flight-route mb-4">
            <div class="row mb-3">
                <div class="col-5">
                    <h4 class="fw-bold">${outboundFirstSegment.departure.iataCode}</h4>
                    <p class="text-muted mb-0">${new Date(outboundFirstSegment.departure.at).toLocaleDateString()}</p>
                </div>
               <div class="col-2 position-relative">
                        <hr class="text-primary border-2">
                        <i class="text-secondary fs-6 fas fa-plane position-absolute top-50 start-50 translate-middle"></i>
                    </div>
                <div class="col-5 text-end">
                    <h4 class="fw-bold">${outboundLastSegment.arrival.iataCode}</h4>
                    <p class="text-muted mb-0">${new Date(outboundLastSegment.arrival.at).toLocaleDateString()}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 bg-light p-3 h-100">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-bold">Outbound Flight</span>
                        <span class="badge bg-primary">${outboundFirstSegment.carrierCode} ${outboundFirstSegment.number}</span>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h5 class="fw-bold">${new Date(outboundFirstSegment.departure.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h5>
                            <p class=" mb-0">${outboundFirstSegment.departure.iataCode}</p>
                            <p class="">${new Date(outboundFirstSegment.departure.at).toLocaleDateString()}</p>
                        </div>
                        <div class="col-4 text-center">
                            <p class=" mb-1">${calculateDuration(outbound.duration)}</p>
                            <div class="border-top pt-1">
                                <span class="badge bg-light text-dark">${outboundFirstSegment.numberOfStops === 0 ? 'Non-stop' : `${outboundFirstSegment.numberOfStops} Stop(s)`}</span>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <h5 class="fw-bold">${new Date(outboundLastSegment.arrival.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</h5>
                            <p class=" mb-0">${outboundLastSegment.arrival.iataCode}</p>
                            <p class="">${new Date(outboundLastSegment.arrival.at).toLocaleDateString()}</p>
                        </div>
                    </div>
                    <div class="mt-3">
    <p class="mb-1"><i class="fas fa-suitcase-rolling me-2"></i> Equipaje de mano: 7kg</p>
    <p class="mb-0"><i class="fas fa-suitcase me-2"></i> Equipaje facturado: 23kg × 1</p>
</div>

                </div>
            </div>
        </div>
        ${returnFlightHtml}
    `;
        }

        function renderPassengerDetails(passengers) {
            const tbody = document.querySelector('#passengersTable tbody');
            tbody.innerHTML = '';

            passengers.forEach(passenger => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>
                <strong>${passenger.first_name} ${passenger.last_name}</strong><br>
                <div class="">${passenger.type.charAt(0).toUpperCase() + passenger.type.slice(1)}</div>
            </td>
            <td>${passenger.seat}</td>
            <td>${passenger.ticket_number}</td>
            <td>23kg</td>
        `;
                tbody.appendChild(row);
            });
        }

        function renderPaymentSummary(bookingData) {
            // Calculate fare breakdown
            const adultCount = bookingData.passengers.filter(p => p.type === 'adult').length;
            const childCount = bookingData.passengers.filter(p => p.type === 'child').length;
            const infantCount = bookingData.passengers.filter(p => p.type === 'infant').length;

            const basePrice = parseFloat(bookingData.flight.price.total) * 0.8;
            const taxes = parseFloat(bookingData.flight.price.total) * 0.2;

            document.getElementById('fareSummary').innerHTML = `
        <li class="list-group-item d-flex justify-content-between px-0">
            <span>Base Fare (${adultCount} Adult${adultCount !== 1 ? 's' : ''})</span>
            <span>${bookingData.flight.price.currency} ${basePrice.toFixed(2)}</span>
        </li>
        ${childCount > 0 ? `
        <li class="list-group-item d-flex justify-content-between px-0">
            <span>Base Fare (${childCount} Child${childCount !== 1 ? 'ren' : ''})</span>
            <span>${bookingData.flight.price.currency} ${(basePrice * 0.75 * childCount).toFixed(2)}</span>
        </li>` : ''}
        ${infantCount > 0 ? `
        <li class="list-group-item d-flex justify-content-between px-0">
            <span>Base Fare (${infantCount} Infant${infantCount !== 1 ? 's' : ''})</span>
            <span>${bookingData.flight.price.currency} ${(basePrice * 0.1 * infantCount).toFixed(2)}</span>
        </li>` : ''}
        <li class="list-group-item d-flex justify-content-between px-0">
            <span>Taxes & Fees</span>
            <span>${bookingData.flight.price.currency} ${taxes.toFixed(2)}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between px-0 fw-bold">
            <span>Total Amount</span>
            <span>${bookingData.flight.price.currency} ${bookingData.flight.price.total}</span>
        </li>
    `;

            // Set payment method info
            document.getElementById('paymentCard').textContent =
                `VISA ending in ${bookingData.payment.card_number.slice(-4)}`;
            document.getElementById('paymentDate').textContent =
                `Paid on ${new Date(bookingData.timestamp).toLocaleDateString()}`;
            document.getElementById('invoiceNumber').textContent =
                `INV-${new Date(bookingData.timestamp).getFullYear()}-${Math.floor(1000 + Math.random() * 9000)}`;
            document.getElementById('paymentEmail').textContent = bookingData.contact.email;
        }

        function setupConfirmationButtons(bookingData) {
            document.getElementById('downloadTicketBtn').addEventListener('click', function() {
                // In a real app, this would generate/download the ticket
                alert('Your e-ticket has been downloaded!');
            });

            document.getElementById('resendConfirmationBtn').addEventListener('click', function() {
                // In a real app, this would resend the confirmation email
                alert(`Confirmation email resent to ${bookingData.contact.email}`);
            });
        }

        // Helper function to calculate duration
        function calculateDuration(isoDuration) {
            const matches = isoDuration.match(/PT(?:(\d+)H)?(?:(\d+)M)?/);
            const hours = matches[1] ? parseInt(matches[1]) : 0;
            const minutes = matches[2] ? parseInt(matches[2]) : 0;
            return `${hours}h ${minutes}m`;
        }
    </script>
    <?php include_once("include/footer.php")  ?>
    <?php include_once("include/script.php")  ?>

</body>

</html>