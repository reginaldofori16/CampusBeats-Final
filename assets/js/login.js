document.getElementById("userType").addEventListener("change", function () {
    const userType = this.value;

    // You can dynamically handle user-type-specific actions here if needed
    console.log(`User Type Selected: ${userType}`);
});

// Email Validation
document.getElementById("email").addEventListener("input", function () {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailMessage = document.getElementById("emailMessage");

    if (!emailRegex.test(this.value)) {
        emailMessage.textContent = "Please enter a valid email address.";
        emailMessage.style.display = "block";
    } else {
        emailMessage.textContent = "";
        emailMessage.style.display = "none";
    }
});

// Password Validation (Basic Example)
document.getElementById("password").addEventListener("input", function () {
    const password = this.value;
    const passwordMessage = document.getElementById("passwordMessage");

    if (password.length < 8) {
        passwordMessage.textContent = "Password must be at least 8 characters long.";
        passwordMessage.style.display = "block";
    } else {
        passwordMessage.textContent = "";
        passwordMessage.style.display = "none";
    }
});

// Form Submission Validation
document.getElementById("loginForm").addEventListener("submit", function (e) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Please fill in all required fields.");
        e.preventDefault();
    }
});
