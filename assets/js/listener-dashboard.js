document.addEventListener('DOMContentLoaded', () => {
    // Handle "Add to Favorites" button click
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const musicItem = event.target.closest('.music-item');
            toggleFavorite(musicItem);
        });
    });

    // Search functionality
    const searchInput = document.querySelector('#search-input');
    searchInput.addEventListener('input', searchMusic);
});

// Function to toggle favorite status
function toggleFavorite(musicItem) {
    const favoriteIcon = musicItem.querySelector('.favorite-icon');
    favoriteIcon.classList.toggle('favorited');
    alert('Song added to your favorites!');
}

// Function to handle search (you can implement the actual search logic here)
function searchMusic(event) {
    const query = event.target.value.toLowerCase();
    const musicItems = document.querySelectorAll('.music-item');

    musicItems.forEach(item => {
        const title = item.querySelector('.music-title').textContent.toLowerCase();
        if (title.includes(query)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}
