<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/admin-dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="../assets/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h2>Campus Beats</h2>
        </div>
        <ul>
            <li><a href="admin-dashboard.php" class="active">Dashboard</a></li>
            <li><a href="admin-usermanagement.php">User Management</a></li>
            <li><a href="track-management.php">Track Management</a></li>
            <li><a href="report-management.php">Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search...">
                <button class="search-btn">Search</button>
            </div>
            <div class="user-info">
                <span>Welcome, Admin</span>
                <img src="profile-picture.jpg" alt="Admin" class="admin-avatar">
            </div>
        </nav>

        <!-- Dashboard Stats -->
        <section class="dashboard-stats">
            <h2>Dashboard Overview</h2>
            <div class="stats-cards">
                <div class="stats-card">
                    <h3>Total Listeners</h3>
                    <p id="total-listeners"></p>
                </div>
                <div class="stats-card">
                    <h3>Total Tracks</h3>
                    <p id="total-tracks">500</p>
                </div>
                <div class="stats-card">
                    <h3>Total Artists</h3>
                    <p id="total-artists">150</p>
                </div>
                <div class="stats-card">
                    <h3>Total Record Labels</h3>
                    <p id="total-record-labels">$12,000</p>
                </div>
            </div>
        </section>

        <!-- Recent Activity -->
        <section class="recent-activity">
            <h2>Recent Activity</h2>
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>User</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>New Track Uploaded</td>
                        <td>Artist A</td>
                        <td>2024-11-15</td>
                    </tr>
                    <tr>
                        <td>User Registered</td>
                        <td>Listener B</td>
                        <td>2024-11-14</td>
                    </tr>
                    <tr>
                        <td>Track Deleted</td>
                        <td>Artist C</td>
                        <td>2024-11-13</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Campus Beats. All Rights Reserved.</p>
        </footer>
    </div>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "../actions/dashboard.php",
                method: "GET",
                data: { action: "fetch_dashboard_summary" },
                success: function (response) {
                    const data = JSON.parse(response);
                    $("#total-listeners").text(data.total_listeners || "0");
                    $("#total-artists").text(data.total_artists || "0");
                    $("#total-tracks").text(data.total_tracks || "0");
                    $("#total-record-labels").text(data.total_record_labels || "0");
                },
                error: function (error) {
                    console.error("Error fetching dashboard data:", error);
                }
            });
        });
    </script>
</body>
</html>
