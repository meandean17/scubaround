// dive.js

// Function to generate random coordinates within a given range
function getRandomCoordinates(minLat, maxLat, minLon, maxLon) {
    const randomLat = Math.random() * (maxLat - minLat) + minLat;
    const randomLon = Math.random() * (maxLon - minLon) + minLon;
    return {
        lat: randomLat.toFixed(6),
        lon: randomLon.toFixed(6),
    };
}

// Function to handle form submission
function handleFormSubmit(event) {
    event.preventDefault();

    // Get form elements
    const diveNameInput = document.getElementById('diveName');
    const diveTypeSelect = document.getElementById('diveType');

    // Get selected dive type
    const selectedDiveType = diveTypeSelect.value;

    // Generate random coordinates for start and end points
    const startCoordinates = getRandomCoordinates(0, 90, 0, 180);
    const endCoordinates = getRandomCoordinates(0, 90, 0, 180);

    // Prepare data to send to the server
    const formData = {
        diveName: diveNameInput.value,
        diveType: selectedDiveType,
        startLat: startCoordinates.lat,
        startLon: startCoordinates.lon,
        endLat: endCoordinates.lat,
        endLon: endCoordinates.lon,
    };

    // Send the form data to the server using AJAX or fetch

    // Example using fetch:
    fetch('./php/newdive.php', {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            // Handle the server response
            console.log('Dive created:', data);
            // Optionally, perform any additional actions after the dive is created
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any error that occurs during the request
        });
}

// Attach event listener to form submit event
const diveForm = document.getElementById('diveForm');
diveForm.addEventListener('submit', handleFormSubmit);
