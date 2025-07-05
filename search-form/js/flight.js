const backendURL = 'https://early-neysa-hamidasraf-261ddf5b.koyeb.app/flights/'
fetch("include/airportsdata.php")
  .then((response) => response.json())
  .then((data) => {
    window.airportsData = data;
  })
  .catch((error) => console.error("Error loading airports data:", error));

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById('searchFlightsBtn').addEventListener('click', function(e) {
      e.preventDefault();
      searchFlights();
  });

  const locationInput = document.getElementById("location");
  const location2Input = document.getElementById("location2");

  const suggestionsContainer1 = document.createElement("ul");
  suggestionsContainer1.className = "autocomplete-list list-group";
  suggestionsContainer1.style.display = "none";
  locationInput.parentNode.appendChild(suggestionsContainer1);

  const suggestionsContainer2 = document.createElement("ul");
  suggestionsContainer2.className = "autocomplete-list list-group";
  suggestionsContainer2.style.display = "none";
  location2Input.parentNode.appendChild(suggestionsContainer2);

  function handleInputChange(input, suggestionsContainer) {
    const term = input.value.toLowerCase();

    if (term.trim() === "") {
      suggestionsContainer.style.display = "none";
      return;
    }

    const filteredSuggestions = window.airportsData.filter((airport) =>
      airport.toLowerCase().includes(term)
    ).slice(0, 20);

    displaySuggestions(filteredSuggestions, suggestionsContainer, input);
  }

  function displaySuggestions(suggestions, container, input) {
    container.innerHTML = "";

    if (suggestions.length === 0) {
      container.style.display = "none";
      return;
    }

    suggestions.forEach((suggestion) => {
      const li = document.createElement("li");
      li.className =
        "list-group-item autocomple-option d-flex align-items-center text-start";

      const parts = suggestion.split("~");

      li.innerHTML = `
          <button type="button" class="btn code-btn">${parts[0]}</button>
          <div class="mx-2" style="line-height: 14px;">
            <strong><small>${parts[1]}</small></strong>
            <div class="d-block text_nowrap_auto">
              <small>${parts[2]}<strong> ${parts[3]}</strong></small>
            </div>
          </div>
        `;

      li.addEventListener("click", () => {
        input.value = `${parts[0]} - ${parts[1]}`;
        container.style.display = "none";
      });

      container.appendChild(li);
    });

    container.style.display = "block";
  }

  document.addEventListener("click", function (e) {
    if (!locationInput.contains(e.target)) {
      suggestionsContainer1.style.display = "none";
    }
    if (!location2Input.contains(e.target)) {
      suggestionsContainer2.style.display = "none";
    }
  });

  locationInput.addEventListener("input", debounce(() =>
  handleInputChange(locationInput, suggestionsContainer1), 300));

  location2Input.addEventListener("input", debounce(() =>
  handleInputChange(location2Input, suggestionsContainer2), 300));

  locationInput.addEventListener("focus", () => {
    if (locationInput.value) {
      handleInputChange(locationInput, suggestionsContainer1);
    }
  });

  location2Input.addEventListener("focus", () => {
    if (location2Input.value) {
      handleInputChange(location2Input, suggestionsContainer2);
    }
  });
});

function searchFlights() {
  const loderElem =  document.getElementById("loadersection");
  const maiElem = document.getElementById("main-section");
  const origin = document.getElementById("location").value.split(" - ")[0];
  const destination = document
    .getElementById("location2")
    .value.split(" - ")[0];
  const departureDate = formatDate(document.getElementById("datepicker").value);
  const returnDate = document.querySelector('input[value="roundtrip"]:checked')
    ? formatDate(document.getElementById("datepicker2").value)
    : "";
  const adults = document.getElementById("AdultsRT").value;
  const children = document.getElementById("ChildrenRT").value;
  const infants = document.getElementById("InfantsRT").value;
  const travelClass = document.querySelector('select[name="ct"]').value;

  // Validate inputs
  if (!origin || !destination || !departureDate) {
    alert("Please fill in all required fields");
    return;
  }
  
  sessionStorage.setItem('formdata', JSON.stringify({
    origin: document.getElementById("location").value,
    destination: document.getElementById("location2").value,
    departureDate: document.getElementById("datepicker").value,
    returnDate: returnDate? document.getElementById("datepicker2").value: null,
    adults,
    children,
    travelClass
  }));
  // Build API URL
  let apiUrl = `${backendURL}flight-offers?originLocationCode=${origin}&destinationLocationCode=${destination}&departureDate=${departureDate}&adults=${adults}&children=${children}&infants=${infants}&travelClass=${travelClass}`;
  const apiKey = '59842c17-f697-4c7d-86f1-ca56e63a4171';
  if(loderElem?.style && maiElem?.style){
    loderElem.style.display = 'flex';
    maiElem.style.display = 'none';
    mapPopupData();
  }
  
  if (returnDate) {
    apiUrl += `&returnDate=${returnDate}`;
  }
  fetch(apiUrl, {
    method: 'GET',
    headers: {
      'x-api-key': apiKey,
      'Content-Type': 'application/json'
    }
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      sessionStorage.setItem("flightResults", JSON.stringify(data));
      if(loderElem?.style && maiElem?.style){
        loderElem.style.display = 'none';
        maiElem.style.display = 'block';
      }
      window.location.href = `search-result.php`;
    })
    .catch((error) => {
      console.error("Error fetching flights:", error);
      alert("Error searching for flights. Please try again.");
      if(loderElem?.style && maiElem?.style){
        loderElem.style.display = 'none';
        maiElem.style.display = 'block';
      }
    });
}

function formatDate(inputDate) {
  const [day, month, year] = inputDate.split('-');
  
  const monthMap = {
    'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04',
    'May': '05', 'Jun': '06', 'Jul': '07', 'Aug': '08',
    'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12'
  };
  
  const monthNumber = monthMap[month];
  

  const paddedDay = day.padStart(2, '0');

  return `${year}-${monthNumber}-${paddedDay}`;
}

function mapPopupData() {
  const from = document.getElementById("pop-from");
  const where = document.getElementById("pop-where");
  const date = document.getElementById("pop-date");
  const origin = document.getElementById("location").value;
  const destination= document.getElementById("location2").value;
  const departureDate = document.getElementById("datepicker").value;
  const returnDate = document.querySelector('input[value="roundtrip"]:checked')
    ? formatDate(document.getElementById("datepicker2").value)
    : "";

    from.innerHTML = `<span>From</span>
    <span>${origin?.split(" - ")[0]}</span>
    <span>${origin?.split(" - ")[1]}</span>`;

    const [dday, dmonth] = departureDate.split('-');

    where.innerHTML = `<span>To</span>
    <span>${destination?.split(" - ")[0]}</span>
    <span>${destination?.split(" - ")[1]}</span>`;
    date.innerHTML = `${dmonth} ${dday}`;
    if(returnDate){
      const [rday, rmonth] = returnDate.split('-');
      date.innerHTML = `${dmonth} ${dday} - ${rmonth} ${rday}`;
    }
}

function debounce(func, delay) {
  let timeoutId;
  return function(...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      func.apply(this, args);
    }, delay);
  };
}