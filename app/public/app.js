// board

// login/signup
function Login() {
    document.getElementById('login').addEventListener('submit', function(event) {
        event.preventDefault();
    
        const usernameOrEmail = document.getElementById('usernameOrEmail').value;
        const password = document.getElementById('password').value;
    
        if (validateInputs(usernameOrEmail, password)) {
            loginUser(usernameOrEmail, password);
        }
    });
}
function validateInputs(usernameOrEmail, password) {
    if (!usernameOrEmail || !password) {
        displayError('Username/Email and password are required.');
        return false;
    }
    return true;
}

function displayError(message) {
    var errorDiv = document.getElementById('error-message');
    errorDiv.innerText = message;
}
function loginUser(usernameOrEmail, password) {
    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            usernameOrEmail: usernameOrEmail,
            password: password
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/dashboard'; // Redirect on successful login
        } else {
            displayError(data.message); // Display error message from server
        }
    })
    .catch(error => {
        displayError('An error occurred. Please try again.');
    });
}