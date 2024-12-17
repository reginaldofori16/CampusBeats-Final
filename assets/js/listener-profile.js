// This JavaScript file will handle dynamic updates for the profile page

document.addEventListener("DOMContentLoaded", function() {
    // Sample dynamic data (can be fetched from a database or session)
    const username = "John Doe";
    const email = "johndoe@example.com";
    const genres = ["Pop", "Rock", "Hip Hop"];
    const location = "Accra, Ghana";
    const schoolLogo = "sch1.png"; // Update this with the correct school logo
    const schoolName = "University of Ashesi"; // Update with the school name

    // Update profile with dynamic data
    document.querySelector(".username").textContent = username;
    document.querySelector(".user-details p:nth-child(2)").textContent = `Email: ${email}`;
    document.querySelector(".user-details p:nth-child(3)").textContent = `Favorite Genres: ${genres.join(", ")}`;
    document.querySelector(".user-details p:nth-child(4)").textContent = `Location: ${location}`;
    
    // Update School Info
    const schoolLogoContainer = document.querySelector(".school-logo-container");
    schoolLogoContainer.querySelector("img").src = schoolLogo;
    schoolLogoContainer.querySelector("strong").textContent = schoolName;
});
