function updatePassword() {
    var email = document.getElementById("email").value;
    var newPassword = document.getElementById("Password").value;

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL
    xhr.open('POST', 'update_password.php', true);

    // Set request headers
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Set up a function for the response
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Request was successful
            document.getElementById("message").textContent = xhr.responseText;
        } else {
            // Request failed
            document.getElementById("message").textContent = 'Error: ' + xhr.statusText;
        }
    };

    // Handle network errors
    xhr.onerror = function() {
        document.getElementById("message").textContent = 'Network Error';
    };

    // Send the request
    xhr.send('email=' + encodeURIComponent(email) + '&newPassword=' + encodeURIComponent(newPassword));
}
