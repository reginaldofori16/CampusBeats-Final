document.querySelector('.profile-form').addEventListener('submit', function (event) {
    // event.preventDefault();

    // Collect form data and display in console (for testing purposes)
    const formData = new FormData(event.target);

    // Log each field's value
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    // alert('Profile Saved!');
});
