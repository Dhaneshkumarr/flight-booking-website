document.addEventListener('DOMContentLoaded', function () {
  const storedData = sessionStorage.getItem('flightResults');
  if (!storedData) {
    window.location.href = 'index.php';
    return;
  }

  const storeformData = sessionStorage.getItem('formdata');

  if (storeformData) {
    const formData = JSON.parse(storeformData);
    const fromToWhere = document.getElementById('fromToWhere');
    const dateNpassenger = document.getElementById('dateNpassenger');
    const modifySearch = document.getElementById('modifySearch');
    if (formData?.origin && formData?.destination && fromToWhere) {
      fromToWhere.innerHTML = `${formData?.origin?.split('-')[1]} (${formData?.origin?.split('-')[0]}) → ${formData?.destination?.split('-')[1]} (${formData?.destination?.split('-')[0]})`;
    };
    if (formData?.departureDate && formData?.adults && dateNpassenger) {
      const count = Number(formData?.adults || 0) + Number(formData?.children || 0);
      dateNpassenger.innerHTML = `${formData?.departureDate || ''} • ${count} Passenger • ${formData?.travelClass || ''}`;
    };
    modifySearch.addEventListener('click', function () {
      sessionStorage.removeItem('flightResults');
      sessionStorage.removeItem('formdata');
      sessionStorage.removeItem('bookingData');
      sessionStorage.removeItem('searchFormData');
      sessionStorage.removeItem('passengerData');
      window.location.href = 'index.php';
    });
  }

  const searchData = JSON.parse(storedData);

  // Helper function to get carrier names
  function carrierWithName(carriers) {
    return Object.entries(carriers || {}).reduce((acc, [code, name]) => {
      acc[code] = { code, name };
      return acc;
    }, {});
  }

  // DOM elements
  const priceRangeInput = document.getElementById('priceRange');
  const nonStopCheckbox = document.getElementById('nonStop');
  const oneStopCheckbox = document.getElementById('oneStop');
  const moreStopCheckbox = document.getElementById('twoPlusStops');
  const flightResultsContainer = document.getElementById('flightResults');
  const flightCountElement = document.getElementById('flightCount');
  const airlinesContainer = document.getElementById('airlinesFilter');

  // State
  let filteredFlights = [];
  let filters = {
    stops: {
      nonStop: true,
      oneStop: true,
      moreStop: false
    },
    priceRange: 0,
    departureTime: '',
    airlines: {}
  };

  // Calculate carriers and airlines data
  const carriers = searchData?.dictionaries?.carriers || {};
  const airlines = carrierWithName(carriers);

  // Calculate min/max prices and unique airlines
  const { uniqueAirlines, minPrice, maxPrice, stopCounts } = (function () {
    if (!searchData?.data) return {
      uniqueAirlines: [],
      minPrice: 0,
      maxPrice: 1000,
      stopCounts: { nonStop: 0, oneStop: 0, moreStop: 0 }
    };

    const airlinesMap = new Map();
    let min = Infinity;
    let max = 0;
    const counts = { nonStop: 0, oneStop: 0, moreStop: 0 };

    searchData.data.forEach(flight => {
      const price = parseFloat(flight?.price?.total || "0");
      min = Math.min(min, price);
      max = Math.max(max, price);

      // Process each itinerary to count stops
      flight.itineraries.forEach(itinerary => {
        const segments = itinerary.segments || [];
        const totalStops = segments.reduce((sum, segment) => sum + (segment.numberOfStops || 0), 0);

        if (totalStops === 0) counts.nonStop++;
        else if (totalStops === 1) counts.oneStop++;
        else counts.moreStop++;

        // Track airlines
        segments.forEach(segment => {
          const carrierCode = segment.carrierCode || "NA";
          const carrierName = carriers[carrierCode] || "Unknown";

          if (!airlinesMap.has(carrierCode)) {
            airlinesMap.set(carrierCode, {
              name: carrierName,
              code: carrierCode,
              minPrice: price
            });
          } else if (price < airlinesMap.get(carrierCode).minPrice) {
            airlinesMap.get(carrierCode).minPrice = price;
          }
        });
      });
    });

    const airlinesArray = Array.from(airlinesMap.values()).sort((a, b) =>
      a.name.localeCompare(b.name)
    );

    return {
      uniqueAirlines: airlinesArray,
      minPrice: min === Infinity ? 0 : min,
      maxPrice: max === 0 ? 1000 : max,
      stopCounts: counts
    };
  })();

  // Initialize filters
  function initializeFilters() {
    // Set price range
    priceRangeInput.min = minPrice;
    priceRangeInput.max = maxPrice;
    priceRangeInput.value = maxPrice;
    document.getElementById('priceRangeMin').textContent = `$${minPrice}`;
    document.getElementById('priceRangeMax').textContent = `$${maxPrice}`;
    document.getElementById('priceRangeValue').textContent = `$${maxPrice}`;
    filters.priceRange = maxPrice;

    // Update stop counts
    document.getElementById('nonStopCount').textContent = stopCounts.nonStop;
    document.getElementById('oneStopCount').textContent = stopCounts.oneStop;
    document.getElementById('moreStopCount').textContent = stopCounts.moreStop;

    // Initialize airline filters
    airlinesContainer.innerHTML = '';
    uniqueAirlines.forEach(airline => {
      const count = searchData.data.reduce((sum, flight) => {
        return sum + flight.itineraries.reduce((segSum, itinerary) => {
          return segSum + itinerary.segments.filter(s => s.carrierCode === airline.code).length;
        }, 0);
      }, 0);

      const checkbox = document.createElement('div');
      checkbox.className = 'form-check';
      checkbox.innerHTML = `
        <input class="form-check-input" type="checkbox" name="airline" 
               id="${airline.code}" value="${airline.code}" checked>
        <label class="form-check-label" for="${airline.code}">
          ${airline.name} (${count})
        </label>
      `;
      airlinesContainer.appendChild(checkbox);

      filters.airlines[airline.code] = true;
    });
  }

  // Apply filters function
  function applyFilters() {
    if (!searchData?.data) {
      filteredFlights = [];
      renderFlights();
      return;
    }

    // Get current filter values
    filters.priceRange = parseFloat(priceRangeInput.value);
    filters.stops.nonStop = nonStopCheckbox.checked;
    filters.stops.oneStop = oneStopCheckbox.checked;
    filters.stops.moreStop = moreStopCheckbox.checked;

    // Get selected departure time
    const selectedDepartureTime = document.querySelector('[name="departureTime"]:checked');
    filters.departureTime = selectedDepartureTime ? selectedDepartureTime.value : '';

    // Get selected airlines
    document.querySelectorAll('[name="airline"]:checked').forEach(checkbox => {
      filters.airlines[checkbox.value] = true;
    });
    document.querySelectorAll('[name="airline"]:not(:checked)').forEach(checkbox => {
      filters.airlines[checkbox.value] = false;
    });

    // Filter flights
    filteredFlights = searchData.data.filter(flight => {
      // Price filter
      const price = parseFloat(flight?.price?.total || "0");
      if (price > filters.priceRange) {
        return false;
      }

      // Airlines filter
      const selectedAirlines = Object.entries(filters.airlines)
        .filter(([_, isSelected]) => isSelected)
        .map(([code]) => code);

      if (selectedAirlines.length > 0) {
        const hasMatchingAirline = flight.itineraries.some(itinerary =>
          itinerary.segments.some(segment =>
            selectedAirlines.includes(segment.carrierCode)
          )
        );
        if (!hasMatchingAirline) return false;
      }

      // Stops filter
      let hasNonStop = false;
      let hasOneStop = false;
      let hasMultiStop = false;

      flight.itineraries.forEach(itinerary => {
        const totalStops = itinerary.segments.reduce((sum, segment) => sum + (segment.numberOfStops || 0), 0);
        if (totalStops === 0) hasNonStop = true;
        else if (totalStops === 1) hasOneStop = true;
        else hasMultiStop = true;
      });

      const stopFilterPassed =
        (filters.stops.nonStop && hasNonStop) ||
        (filters.stops.oneStop && hasOneStop) ||
        (filters.stops.moreStop && hasMultiStop);

      if (!stopFilterPassed && (filters.stops.nonStop || filters.stops.oneStop || filters.stops.moreStop)) {
        return false;
      }

      // Departure time filter
      if (filters.departureTime) {
        const hasMatchingDeparture = flight.itineraries.some(itinerary => {
          return itinerary.segments.some(segment => {
            if (!segment.departure?.at) return false;
            const hours = new Date(segment.departure.at).getHours();
            switch (filters.departureTime) {
              case "morning": return hours >= 6 && hours < 12;
              case "afternoon": return hours >= 12 && hours < 18;
              case "evening": return hours >= 18 && hours < 21;
              case "night": return hours >= 21 || hours < 6;
              default: return true;
            }
          });
        });
        if (!hasMatchingDeparture) return false;
      }

      return true;
    });

    renderFlights();
  }

  // Render flights function
  function renderFlights() {
    flightCountElement.textContent = `${filteredFlights.length} flights found`;

    flightResultsContainer.innerHTML = '';

    if (filteredFlights.length === 0) {
      flightResultsContainer.innerHTML = `
        <div class="card mb-3 flight-card">
          <div class="card-body text-center py-5">
            <h5>No flights match your filters</h5>
            <p class="text-muted">Try adjusting your filters to see more results</p>
          </div>
        </div>
      `;
      return;
    }

    filteredFlights.forEach((flight, index) => {
      const flightCard = document.createElement('div');
      flightCard.className = 'card mb-3 flight-card';

      // Process itineraries (assuming first is outbound, second is return)
      const outboundItinerary = flight.itineraries[0];
      const returnItinerary = flight.itineraries[1];

      // Outbound details
      const outboundSegments = outboundItinerary.segments;
      const outboundFirstSegment = outboundSegments[0];
      const outboundLastSegment = outboundSegments[outboundSegments.length - 1];
      const outboundDeparture = new Date(outboundFirstSegment.departure.at);
      const outboundArrival = new Date(outboundLastSegment.arrival.at);
      const outboundDuration = calculateDuration(outboundItinerary.duration);

      // Return details (if exists)
      let returnDetails = '';
      if (returnItinerary) {
        const returnSegments = returnItinerary.segments;
        const returnFirstSegment = returnSegments[0];
        const returnLastSegment = returnSegments[returnSegments.length - 1];
        const returnDeparture = new Date(returnFirstSegment.departure.at);
        const returnArrival = new Date(returnLastSegment.arrival.at);
        const returnDuration = calculateDuration(returnItinerary.duration);

        returnDetails = `
          <div class="mt-3">
            <div class="d-flex justify-content-between">
              <div>
                <div class="flight-time">${returnDeparture.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                <div class="text-muted small">${returnFirstSegment.departure.iataCode}</div>
              </div>
              <div class="text-center px-2">
                <div class="flight-duration">${returnDuration}</div>
                <div class="border-bottom my-1"></div>
                <span class="badge ${getStopBadgeClass(returnSegments)}">
                  ${getStopText(returnSegments)}
                </span>
              </div>
              <div class="text-end">
                <div class="flight-time">${returnArrival.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                <div class="text-muted small">${returnLastSegment.arrival.iataCode}</div>
              </div>
            </div>
          </div>
        `;
      }

      // Carrier info (use first segment's carrier)
      const carrierCode = outboundFirstSegment.carrierCode;
      const carrierName = carriers[carrierCode] || carrierCode;

      flightCard.innerHTML = `
  <div class="card-body p-3">
    <div class="row g-2 align-items-center">
      <!-- Airline Logo -->
      <div class="col-md-2 text-center">
        <img src="https://logo.clearbit.com/${carrierName.toLowerCase().replace(/\s/g, '')}.com" 
             alt="${carrierCode}" class="img-fluid airline-logo mb-1" style="max-height: 30px; width: auto;">
        <div class="text-muted small fw-light">${carrierName}</div>
      </div>
      
      <!-- Flight Itinerary -->
      <div class="col-md-5">
        <div class="d-flex justify-content-between align-items-center">
          <div class="text-center">
            <div class="h6 fw-bold mb-0">${outboundDeparture.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
            <div class="text-muted small">${outboundFirstSegment.departure.iataCode}</div>
          </div>
          
          <div class="text-center mx-2 flex-grow-1">
            <div class="text-muted small">${outboundDuration}</div>
            <div class="border-top border-bottom my-1 py-1">
              <span class="badge ${getStopBadgeClass(outboundSegments)} rounded-pill px-2 bg-light text-dark border">
                ${getStopText(outboundSegments)}
              </span>
            </div>
          </div>
          
          <div class="text-center">
            <div class="h6 fw-bold mb-0">${outboundArrival.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
            <div class="text-muted small">${outboundLastSegment.arrival.iataCode}</div>
          </div>
        </div>
        ${returnDetails}
      </div>
      
      <!-- Price -->
      <div class="col-md-3 text-center">
        <div class="h5 text-primary fw-bold mb-1">${flight.price.currency} ${flight.price.total}</div>
        <span class="badge bg-success bg-opacity-10 text-success small mb-2">
          <i class="fas fa-check-circle me-1"></i> Cancelación gratuita
        </span>
        <div>
          <button class="btn btn-sm btn-link text-decoration-none p-0 text-muted flight-details-btn" 
                  data-bs-toggle="collapse" data-bs-target="#flightDetails${index}">
            <i class="fas fa-chevron-down me-1 small"></i> Detalles
          </button>
        </div>
      </div>
      
      <!-- Select Button -->
      <div class="col-md-2 text-center">
        <button class="btn btn-sm btn-primary w-100 py-1 select-flight-btn" data-flight-id="${flight.id}">
          Seleccionar
        </button>
      </div>
    </div>
    
    <!-- Flight Details Collapse -->
    <div class="collapse mt-2" id="flightDetails${index}">
      <hr class="my-2">
      <div class="row g-2">
        <div class="col-md-6">
          <div class="rounded border p-2 bg-light">
            <h6 class="text-secondary mb-2 small"><i class="fas fa-plane me-1"></i> Detalles del vuelo</h6>
            ${renderFlightSegmentsDetails(outboundSegments, 'Outbound')}
            ${returnItinerary ? renderFlightSegmentsDetails(returnItinerary.segments, 'Return') : ''}
          </div>
        </div>
        <div class="col-md-6">
          <div class="rounded border p-2 bg-light">
            <h6 class="text-secondary mb-2 small"><i class="fas fa-suitcase me-1"></i> Equipaje</h6>
            ${renderBaggageInfo(flight)}
          </div>
        </div>
      </div>
    </div>
  </div>
`;


      flightResultsContainer.appendChild(flightCard);
    });
  }

  // Helper functions for rendering
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

  function renderFlightSegmentsDetails(segments, title) {
    return `
      <h6 class="mt-2">${title}</h6>
      ${segments.map(segment => `
        <div class="d-flex justify-content-between mb-2 border-bottom border-secondary border-1 pb-2">
          <span>Flight ${segment.carrierCode} ${segment.number}</span>
          <span>${searchData.dictionaries.aircraft[segment.aircraft.code] || segment.aircraft.code}</span>
        </div>
        <div class="d-flex justify-content-between mb-2 border-bottom border-secondary border-1 pb-2">
          <span>${segment.departure.iataCode} → ${segment.arrival.iataCode}</span>
          <span>${new Date(segment.departure.at).toLocaleString()}</span>
        </div>
      `).join('')}
    `;
  }

  function renderBaggageInfo(flight) {
    const baggage = flight.travelerPricings?.[0]?.fareDetailsBySegment?.[0]?.includedCheckedBags;
    if (!baggage) return '<div class="alert alert-primary bg-white border-0">Información de equipaje no disponible</div>';

    return `
  <div class="alert alert-primary bg-white border-0">
    <i class="fas fa-suitcase me-2"></i>
    Equipaje facturado incluido: ${baggage.weight} ${baggage.weightUnit}
  </div>
  <div class="alert alert-primary bg-white border-0 mt-2">
    <i class="fas fa-briefcase me-2"></i>
    Equipaje de mano: 7kg
  </div>
`;

  }

  // Event listeners
  priceRangeInput.addEventListener('input', function () {
    document.getElementById('priceRangeValue').textContent = `$${this.value}`;
    applyFilters();
  });

  nonStopCheckbox.addEventListener('change', applyFilters);
  oneStopCheckbox.addEventListener('change', applyFilters);
  moreStopCheckbox.addEventListener('change', applyFilters);

  document.addEventListener('change', function (e) {
    if (e.target.matches('[name="departureTime"], [name="airline"]')) {
      applyFilters();
    }
  });

  // Initialize and apply filters
  initializeFilters();
  applyFilters();

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('select-flight-btn')) {
      const flightId = e.target.getAttribute('data-flight-id');
      const selectedFlight = searchData.data.find(f => f.id === flightId);

      if (selectedFlight) {
        sessionStorage.setItem('selectedFlight', JSON.stringify(selectedFlight));

        // Navigate to booking page
        window.location.href = 'booking.php';
      }
    }
  });
});