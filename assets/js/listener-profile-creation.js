// If you want to handle profile picture upload or form validations later
document.querySelector(".profile-form").addEventListener("submit", function(event) {
    // event.preventDefault();

    const bio = document.querySelector("#bio").value;
    const genres = Array.from(document.querySelectorAll('input[name="genres"]:checked')).map(input => input.value);
    const profilePicture = document.querySelector("#profile-picture").files[0];

    // if (bio && genres.length > 0) {
    //     alert("Profile saved successfully!");
    //     // You can handle the form submission here, e.g., via AJAX to your backend
    // } else {
    //     alert("Please fill out all required fields.");
    // }
});
