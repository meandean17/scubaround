
// Function to handle form submission
function handleFormSubmit(event) {
    event.preventDefault();

    // Get form elements
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    // Prepare data to send to the server
    const formData = {
        username: usernameInput.value,
        password: passwordInput.value
    };

    // Send the form data to the server using AJAX or fetch

    // Example using fetch:
    fetch('../php/login.php', {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            // Handle the server response
            console.log('Authentication result:', data);
            // Optionally, perform any additional actions after authentication
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle any error that occurs during the request
        });
}

// Attach event listener to form submit event
const loginForm = document.getElementById('loginForm');
loginForm.addEventListener('submit', handleFormSubmit);
