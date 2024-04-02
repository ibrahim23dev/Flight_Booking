document.addEventListener('DOMContentLoaded', function() {

    // Get checkbox elements
    const airlineCheckboxes = document.querySelectorAll('input[name="airlineFilter"]');
    const stopCheckboxes = document.querySelectorAll('input[name="stopFilter"]');
    const depTimeCheckboxes = document.querySelectorAll('input[name="departureTime"]');
    // Get price range slider elements
    const priceRangeSlider = document.querySelector('.js-price-rangeSlider');
    const slider = priceRangeSlider.querySelector('.js-slider');
    const lowerValueElement = priceRangeSlider.querySelector('.js-lower');
    const upperValueElement = priceRangeSlider.querySelector('.js-upper');

    // Set initial values for price range slider
    let minPrice = Infinity;
    let maxPrice = -Infinity;

    const flightElements = document.querySelectorAll('.flight-list-main');
    flightElements.forEach(function(flightElement) {
        const price = parseInt(flightElement.dataset.price);
        minPrice = Math.min(minPrice, price);
        maxPrice = Math.max(maxPrice, price);
    });

    noUiSlider.create(slider, {
        start: [minPrice, maxPrice],
        step: 0,
        connect: true,
        range: {
            'min': minPrice,
            'max': maxPrice
        },
        format: {
            to: function(value) {
                return Math.round( value.toString());
            },
            from: function(value) {
                return parseInt(value);
            }
        }
    });

    // Update price range slider values
    slider.noUiSlider.on('update', function(values, handle) {
        if (handle === 0) {
            lowerValueElement.innerHTML = Math.round(values[handle]);
        } else {
            upperValueElement.innerHTML = Math.round(values[handle]);
        }
        
        // Call the filter function to update flight visibility based on price range
        applyFilters();
    });

    // Handle checkbox change event
    function handleCheckboxChange() {
        // Call the filter function to update flight visibility based on checkboxes
        applyFilters();
    }

    // Attach event listeners to checkboxes
    airlineCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    stopCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    depTimeCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    // Helper function to get checked checkbox values
    function getCheckedValues(checkboxes) {
        const values = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                values.push(checkbox.value);
            }
        });
        return values;
    }

    // Filter flights based on selected filters
    function applyFilters() {
        const airlineFilters = getCheckedValues(airlineCheckboxes);
        const depTimeFilter = getCheckedValues(depTimeCheckboxes); // Get selected time filters
        const stopFilters = getCheckedValues(stopCheckboxes);
        const minPrice = parseInt(slider.noUiSlider.get()[0]);
        const maxPrice = parseInt(slider.noUiSlider.get()[1]);
    
        // Iterate over flight elements and apply filters
        flightElements.forEach(function(flightElement) {
            const flightStop = flightElement.dataset.stop;
            const price = parseInt(flightElement.dataset.price);
            const departureTime = new Date(flightElement.dataset.departuretime); // Parse departure time
            const departureHourUTC = departureTime.getUTCHours(); // Get UTC hour
    
            // Check if flight matches the selected filters and price range
            const airlineMatch = (airlineFilters.length === 0 ||
                ['data-airline1', 'data-airline2', 'data-airline3', 'data-airline4', 'data-airline5'].some(attribute => {
                    const attributeValue = flightElement.getAttribute(attribute);
                    return attributeValue && airlineFilters.includes(attributeValue);
                }));
            const stopMatch = (stopFilters.length === 0 || stopFilters.includes(flightStop));
            const priceMatch = (price >= minPrice && price <= maxPrice);
            const timeMatch = (depTimeFilter.length === 0 || depTimeFilter.some(timeFilter => {
                switch (timeFilter) {
                    case '12am_6am':
                        return departureHourUTC >= 0 && departureHourUTC < 6;
                    case '6am_12pm':
                        return departureHourUTC >= 6 && departureHourUTC < 12;
                    case '12pm_6pm':
                        return departureHourUTC >= 12 && departureHourUTC < 18;
                    case 'after_6pm':
                        return departureHourUTC >= 18 && departureHourUTC <= 23;
                    default:
                        return false;
                }
            }));
    
            // Show or hide the flight element based on all filters
            if (airlineMatch && stopMatch && priceMatch && timeMatch) {
                flightElement.style.display = 'block';
            } else {
                flightElement.style.display = 'none';
            }
        });
    }
    
    
    
    
});