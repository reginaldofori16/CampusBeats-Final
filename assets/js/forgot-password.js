document.getElementById("forgotPasswordForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailMessage = document.getElementById("emailMessage");

    if (!emailRegex.test(email)) {
        emailMessage.textContent = "Please enter a valid email address.";
        emailMessage.style.display = "block";
        return;
    } else {
        emailMessage.textContent = "";
        emailMessage.style.display = "none";
    }

    // Simulate sending a reset link
    alert(`A password reset link has been sent to ${email}`);
    window.location.href = "reset-password-confirmation.html";
});
