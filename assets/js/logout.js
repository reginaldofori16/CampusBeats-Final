document.addEventListener('DOMContentLoaded', () => {
    const logoutButton = document.getElementById('logoutButton');

    // Check if the logout button exists
    if (logoutButton) {
        logoutButton.addEventListener('click', async () => {
            try {
                // Send a POST request to the logout endpoint
                const response = await fetch('../actions/logout.php', {
                    method: 'POST',
                });

                // Parse the JSON response
                const result = await response.json();

                if (result.success) {
                    // Show an optional success message
                    alert(result.message);

                    // Redirect the user to the index page
                    window.location.href = result.redirect;
                } else {
                    console.error('Logout failed:', result.message);
                    alert('Logout failed: ' + result.message);
                }
            } catch (error) {
                // Handle any network or unexpected errors
                console.error('Error:', error);
                alert('An error occurred while logging out. Please try again.');
            }
        });
    } else {
        console.warn('Logout button not found. Make sure the button has id="logoutButton"');
    }
});
