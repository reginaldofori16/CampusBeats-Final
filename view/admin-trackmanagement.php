<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Track Management - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/admin-trackmanagement.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h2>Campus Beats</h2>
        </div>
        <ul>
            <li><a href="./admin-dashboard.php">Dashboard</a></li>
            <li><a href="./admin-usermanagement.php">User Management</a></li>
            <li><a href="admin-trackmanagement.php" class="active">Track Management</a></li>
            <li><a href="report-management.html">Reports</a></li>
            <li><a href="settings.html">Settings</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search for tracks...">
                <button class="search-btn">Search</button>
            </div>
            <div class="user-info">
                <span>Welcome, Admin</span>
                <img src="profile-picture.jpg" alt="Admin" class="admin-avatar">
            </div>
        </nav>

        <!-- Track Management Section -->
        <section class="track-management">
            <h2>Track Management</h2>
            <table class="track-table">
                <thead>
                    <tr>
                        <th>Track Name</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th>Upload Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Track 1</td>
                        <td>Artist 1</td>
                        <td>Pop</td>
                        <td>2024-11-01</td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Track 2</td>
                        <td>Artist 2</td>
                        <td>Hip-Hop</td>
                        <td>2024-11-03</td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Track 3</td>
                        <td>Artist 3</td>
                        <td>R&B</td>
                        <td>2024-11-05</td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="delete-btn">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
        </footer>
    </div>

</body>
</html>
