document.getElementById("LoginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevents form submission
    
    // Get the email and password from the input fields
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Prepare the data to send to the server
    const loginData = {
        email: email,
        password: password
    };

    // Use fetch to send the data to the server
    fetch("login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(loginData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Login successful!");
            window.location.href = "../index.html"; // Redirect on success
        } else {
            alert("Invalid email or password.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("There was an error with the login request.");
    });
});
