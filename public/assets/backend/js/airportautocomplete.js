
const search = document.getElementById('departure');
const from_match_list = document.getElementById('from_match_list');
const from_flying = document.getElementById('from_flying');
const departure_code = document.getElementById('departure_code');
const arrival_code = document.getElementById('arrival_code');

const searchCities = async (searchText) => {
  from_flying.classList.remove("-is-active");

  const res = await fetch (baseUrl+"/assets/frontend/js/airports_list.json");
  const cities = await res.json();
  let matches = cities.filter(city_air => {
    const regex = new RegExp(`^${searchText}`, 'gi');
    return city_air.name.match(regex) || city_air.country.match(regex) || city_air.iata_code.match(regex) || city_air.city.match(regex);
  });

  if (searchText.length === 0) {
    matches = [];
    from_match_list.innerHTML = '';
    from_flying.classList.remove("-is-active");
  }

  outputHtml(matches);
  if (searchText.length > 0) {
    from_flying.classList.add("-is-active");
  }
}

const outputHtml = (matches) => {
  if (matches.length > 0) {
    const html = matches.map(match => `
      <div class="search-result-container">
        <h6 class="icon-location-2" onClick="myFunc(this.textContent)">${match.name} ${match.city}, ${match.country} <span>(${match.iata_code}) </span></h6>
      </div>
    `).join('');
    from_match_list.innerHTML = html;
  }
}

search.addEventListener('input', () => searchCities(search.value));

function myFunc(textdata) {
  search.value = textdata;
  addy = textdata;
  const from_iata_code = addy.split('(')[1].replace(')',"");
  departure_code.value = from_iata_code;
  from_match_list.innerHTML = "";
  from_flying.classList.remove("-is-active");
}

 //////// /// arrival code /// ////////

 const to_search = document.getElementById('arrival');
const to_match_list = document.getElementById('to_match_list');
const to_flying = document.getElementById('to_flying');


const tosearchCities = async (searchText) => {
  to_flying.classList.remove("-is-active");

  const res = await fetch (baseUrl+"/assets/frontend/js/airports_list.json");
  const cities = await res.json();
  let matches = cities.filter(city_air => {
    const regex = new RegExp(`^${searchText}`, 'gi');
    return city_air.name.match(regex) || city_air.country.match(regex) || city_air.iata_code.match(regex) || city_air.city.match(regex);
  });

  if (searchText.length === 0) {
    matches = [];
    to_match_list.innerHTML = '';
    to_flying.classList.remove("-is-active");
  }

  tooutputHtml(matches);
  if (searchText.length > 0) {
    to_flying.classList.add("-is-active");
  }
}

const tooutputHtml = (matches) => {
  if (matches.length > 0) {
    const html = matches.map(match => `
      <div class="search-result-container">
        <h6 class="icon-location-2" onClick="tomyFunc(this.textContent)">${match.name} ${match.city}, ${match.country} <span>(${match.iata_code}) </span></h6>
      </div>
    `).join('');
    to_match_list.innerHTML = html;
  }
}

to_search.addEventListener('input', () => tosearchCities(to_search.value));

function tomyFunc(textdata) {
  to_search.value = textdata;
  addy = textdata;
  const from_iata_code = addy.split('(')[1].replace(')',"");
  arrival_code.value = from_iata_code;
  to_match_list.innerHTML = "";
  to_flying.classList.remove("-is-active");
}
    

    