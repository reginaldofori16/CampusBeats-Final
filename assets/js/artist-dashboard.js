// You can use this file to handle any dynamic behavior like fetching data, deleting songs, or updating notifications.

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('uploadModal');
    const uploadBtn = document.getElementById('uploadMusicBtn');
    const closeBtn = document.querySelector('.close');
    const uploadForm = document.getElementById('uploadMusicForm');
    const deleteButtons = document.querySelectorAll('.delete-button');

    // Modal handling
    uploadBtn.onclick = () => modal.style.display = "block";
    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = (e) => {
        if (e.target == modal) modal.style.display = "none";
    }

    // Handle music upload
    uploadForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(uploadForm);
        formData.append('action', 'upload_music');
        
        try {
            const response = await fetch('../actions/artistaction.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            if (result.success) {
                alert('Track uploaded successfully!');
                location.reload();
            } else {
                alert('Upload failed: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Upload failed. Please try again.');
        }
    });

    // Handle track deletion
    deleteButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            if (!confirm('Are you sure you want to delete this track?')) return;
            
            const trackId = e.target.closest('.music-item').dataset.trackId;
            
            try {
                const response = await fetch('../actions/artistaction.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete_track&track_id=${trackId}`
                });
                
                const result = await response.json();
                if (result.success) {
                    e.target.closest('.music-item').remove();
                    alert('Track deleted successfully!');
                } else {
                    alert('Deletion failed: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Deletion failed. Please try again.');
            }
        });
    });
});
