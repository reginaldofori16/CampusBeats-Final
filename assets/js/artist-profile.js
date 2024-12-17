// Assuming we fetch the data for the artist's profile from a server or localStorage
document.addEventListener('DOMContentLoaded', function () {
    const bio = document.getElementById('bio');
    const genres = document.getElementById('genres');
    const profilePic = document.querySelector('.profile-picture img');
    
    // Sample data (replace with actual fetched data)
    const artistProfile = {
        bio: "I'm an up-and-coming artist with a passion for creating unique sounds. I love blending genres and experimenting with new styles.",
        genres: ["Pop", "Jazz", "Rock"],
        profilePicture: "path_to_artist_profile_picture.jpg"  // Replace with actual image URL
    };

    // Populate the profile information dynamically
    bio.textContent = artistProfile.bio;
    genres.textContent = artistProfile.genres.join(", ");
    profilePic.src = artistProfile.profilePicture;

    // Edit Profile Button
    const editBtn = document.querySelector('.edit-btn');
    editBtn.addEventListener('click', function () {
        // Redirect to the profile creation page (or an edit page)
        window.location.href = 'artist-profile-creation.html';
    });
});
