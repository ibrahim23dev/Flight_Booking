
const searchInputs = document.querySelectorAll('.search-input');

// loop through all input elements
searchInputs.forEach((input) => {
const matchList = document.createElement('div');
matchList.classList.add('search-results', `search-results-${input.id}`);
input.parentNode.insertBefore(matchList, input.nextElementSibling);

const searchCities = async (searchText) => {
  const res = await fetch(baseUrl+"/assets/frontend/js/airports_list.json");
  const cities = await res.json();
  let matches = cities.filter((city_air) => {
  const regex = new RegExp(`^${searchText}`, 'gi');
  return city_air.name.match(regex) || city_air.country.match(regex) || city_air.iata_code.match(regex) || city_air.city.match(regex);
  });

  if (searchText.length === 0) {
  matches = [];
  matchList.innerHTML = '';
  matchList.style.display = 'none';
  matchList.classList.remove('overflow-Class');
  } else {
  outputHtml(matches, matchList,searchText);
  matchList.style.display = 'block';
  matchList.classList.add('overflow-Class');
  }
}

input.addEventListener('input', () => {
  searchCities(input.value);
  const activeResults = document.querySelector(`.search-results-${input.id}`);
  document.querySelectorAll('.search-results').forEach(result => {
  if (result !== activeResults) {
      result.style.display = 'none';
      result.classList.remove('overflow-Class');
  }
  });
}); // input event for input box

const outputHtml = (matches, list, searchText) => {
if (matches.length > 0) {
  const html = matches.map((match) => {
  // create a new regular expression object with global and case-insensitive flags
  const regex = new RegExp(`(${searchText})`, 'gi');
  // highlight the matched text using a span element with a special CSS class
  const highlightedName = match.name.replace(regex, '<span class="highlighted d-inline">$1</span>');
  const highlightedCountry = match.country.replace(regex, '<span class="highlighted d-inline">$1</span>');
  const highlightedIata = match.iata_code.replace(regex, '<span class="highlighted d-inline">$1</span>');
  const highlightedCity = match.city.replace(regex, '<span class="highlighted d-inline">$1</span>');

  return `
      <div class="testing_purpose">
      <h6 onClick="getClickedValues('${match.name} ${match.city}, ${match.country} (${match.iata_code})', '${input.id}')">
      <i class="fas fa-map-marker-alt"></i>
          ${highlightedName} ${highlightedCity}, ${highlightedCountry} <span>(${highlightedIata}) </span>
      </h6>
      </div>
  `;
  }).join('');

  list.innerHTML = html;
} else {

  const html = `
  <div class="testing_purpose">
  <h6 >
      No result found
  </h6>
  </div>
`
list.innerHTML = html;

  }
}


});
// function to get values of clicked element 
const getClickedValues = (textData, inputId) => {
const input = document.querySelector(`#${inputId}`);
input.value = textData;
const iataCode = textData.split('(')[1].replace(')', "");

if (input.getAttribute('name') === 'to[]') {
  let id = parseInt(input.id.split('to-')[1]); // Convert id to a number

  let nextFromInput = document.querySelector(`#from-${id + 1}`);
  if (nextFromInput) {
    let toValue = input.value;
    nextFromInput.value=toValue;
  }
}else if(input.name=='departure_full' || input.name=='arrival_full'){
    const airportCode = document.querySelector(`#${inputId}_code`);
    airportCode.value = iataCode;
}


const matchList = document.querySelector(`.search-results-${inputId}`);
matchList.innerHTML = '';
matchList.classList.remove('overflow-Class');


}

