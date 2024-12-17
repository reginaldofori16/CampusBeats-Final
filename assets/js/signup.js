document.getElementById("userType").addEventListener("change", function () {
    const userType = this.value;

    // Show/Hide Additional Fields Based on User Type
    document.getElementById("schoolSection").style.display = userType === "recordlabel" ? "none" : "block";
    document.getElementById("artistFields").style.display = userType === "artist" ? "block" : "none";
    document.getElementById("labelFields").style.display = userType === "recordlabel" ? "block" : "none";
});

// Set Default Display States
document.getElementById("schoolSection").style.display = "none";
document.getElementById("artistFields").style.display = "none";
document.getElementById("labelFields").style.display = "none";

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

// Password Validation
document.getElementById("password").addEventListener("input", function () {
    const password = this.value;

    // Requirements
    const lengthReq = document.getElementById("lengthReq");
    const uppercaseReq = document.getElementById("uppercaseReq");
    const numberReq = document.getElementById("numberReq");
    const specialCharReq = document.getElementById("specialCharReq");

    const hasLength = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    lengthReq.style.color = hasLength ? "green" : "red";
    uppercaseReq.style.color = hasUppercase ? "green" : "red";
    numberReq.style.color = hasNumber ? "green" : "red";
    specialCharReq.style.color = hasSpecialChar ? "green" : "red";
});

// Confirm Password Validation
document.getElementById("confirmPassword").addEventListener("input", function () {
    const password = document.getElementById("password").value;
    const confirmPassword = this.value;
    const message = document.getElementById("passwordMessage");

    if (password !== confirmPassword) {
        message.textContent = "Passwords do not match!";
        message.style.display = "block";
    } else {
        message.textContent = "";
        message.style.display = "none";
    }
});

// Form Submission Handler
document.getElementById("signupForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const userType = document.getElementById("userType").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Create FormData object
    const formData = new FormData(this);

    // Send form data to server
    fetch('../actions/register_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Store user data temporarily if needed
            sessionStorage.setItem('tempUserId', data.user_id);
            
            // Redirect based on user type
            let redirectUrl;
            switch(userType) {
                case 'artist':
                    redirectUrl = '../view/profile/artist-profile-creation.php';
                    break;
                case 'listener':
                    redirectUrl = '../view/profile/listener-profile-creation.php';
                    break;
                case 'recordlabel':
                    redirectUrl = '../view/profile/recordlabel-profile-creation.php';
                    break;
                default:
                    redirectUrl = '../view/login.php';
            }

            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Account created successfully. Please complete your profile.',
                icon: 'success',
                confirmButtonText: 'Continue'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = redirectUrl;
                }
            });
        } else {
            // Show error message
            Swal.fire({
                title: 'Error!',
                text: data.message || 'An error occurred during registration.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

// Profile Creation Success Handler
function handleProfileCreationSuccess() {
    Swal.fire({
        title: 'Profile Created!',
        text: 'Your profile has been created successfully. Please log in.',
        icon: 'success',
        confirmButtonText: 'Go to Login'
    }).then((result) => {
        if (result.isConfirmed) {
            // Clear any temporary storage
            sessionStorage.removeItem('tempUserId');
            // Redirect to login page
            window.location.href = '../view/login.php';
        }
    });
}

// Handle back button or page refresh
window.addEventListener('beforeunload', function() {
    // Clear any temporary storage if user leaves before completing profile
    sessionStorage.removeItem('tempUserId');
});
