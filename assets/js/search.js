document.addEventListener('DOMContentLoaded', () => {
    const searchButton = document.querySelector('.search-btn');
    const searchInput = document.querySelector('.search-bar');
    const resultsContainer = document.querySelector('.results-container');

    // Function to display search results
    const displayResults = (tracks) => {
        resultsContainer.innerHTML = ''; // Clear any previous results

        if (tracks.length === 0) {
            resultsContainer.innerHTML = '<p>No tracks found.</p>';
            return;
        }

        // Loop through results and display them
        tracks.forEach(track => {
            const trackElement = document.createElement('div');
            trackElement.classList.add('result-item');
            trackElement.innerHTML = `
                <p><strong>${track.track_name}</strong> - ${track.artist_name}</p>
            `;
            resultsContainer.appendChild(trackElement);
        });
    };

    // Function to handle errors
    const handleError = (message) => {
        console.error(message); // Log error to console
        resultsContainer.innerHTML = `<p style="color: red;">${message}</p>`;
    };

    // Event Listener for the Search Button
    searchButton.addEventListener('click', async () => {
        const searchQuery = searchInput.value.trim();

        if (searchQuery === '') {
            handleError('Please enter a search query.');
            return;
        }

        try {
            // Send POST request to search_action.php
            const response = await fetch('../actions/search_tracks.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `searchQuery=${encodeURIComponent(searchQuery)}`
            });

            const resultText = await response.text(); // Raw response text
            console.log('Raw Response:', resultText); // Log the raw response

            const result = JSON.parse(resultText); // Parse as JSON

            if (result.success) {
                console.log('Parsed Result:', result);
                displayResults(result.tracks); // Display search results
            } else {
                handleError(result.message); // Display error message
            }
        } catch (error) {
            console.error('Error fetching search results:', error);
            handleError('An error occurred. Please try again later.');
        }
    });

    // Optional: Add "Enter" key functionality for the search bar
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            searchButton.click();
        }
    });
});
