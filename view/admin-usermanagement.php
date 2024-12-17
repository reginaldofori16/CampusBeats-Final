<?php
 error_reporting(E_ALL);
 ini_set("",1);
 ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management - Campus Beats</title>
    <link rel="stylesheet" href="../assets/css/admin-usermanagement.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div id="edit-user-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Edit User</h3>
            <form id="edit-user-form">
                <input type="hidden" id="edit-user-id">
                <input type="text" id="edit-user-name" placeholder="Full Name" required>
                <input type="email" id="edit-user-email" placeholder="Email" required>
                <button type="submit">Save Changes</button>
            </form>
            <button id="close-modal">Cancel</button>
        </div>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="../assets/imgs/logos_and_backgrounds/CampusBeatsLogo.webp" alt="Campus Beats Logo" class="logo">
            <h2>Campus Beats</h2>
        </div>
        <ul>
            <li><a href="./admin-dashboard.php">Dashboard</a></li>
            <li><a href="./admin-usermanagement.php" class="active">User Management</a></li>
            <li><a href="./admin-trackmanagement.php">Track Management</a></li>
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
                <input type="text" class="search-bar" placeholder="Search for users...">
                <button class="search-btn">Search</button>
            </div>
            <div class="user-info">
                <span>Welcome, Admin</span>
                <img src="profile-picture.jpg" alt="Admin" class="admin-avatar">
            </div>
        </nav>

        <!-- User Management Section -->
        <section class="user-management">
            <h2>User Management</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be populated dynamically here -->
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
            // Fetch Users
            function fetchUsers() {
                $.ajax({
                    url: "../actions/dashboard.php",
                    method: "GET",
                    data: { action: "fetch_users" },
                    success: function (response) {
                        const users = JSON.parse(response);
                        const tbody = $(".user-table tbody");
                        tbody.empty();
                        users.forEach(user => {
                            const row = `
                            <tr>
                                <td>${user.id}</td>
                                <td>${user.full_name}</td>
                                <td>${user.email}</td>
                                <td>${user.user_type}</td>
                                <td>
                                    <button class="edit-btn" data-id="${user.id}" data-name="${user.full_name}" data-type="${user.user_type}"data-email="${user.email}">Edit</button>
                                    <button class="delete-btn" data-id="${user.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                            tbody.append(row);
                        });


                        // Bind edit buttons
                        $(".edit-btn").click(function () {
                            const id = $(this).data("id");
                            const userName = $(this).data("full_name");
                            const userEmail = $(this).data("email");
                            const userType = $(this).data("user_type");

                            // Populate modal fields
                            $("#edit-user-id").val(id);
                            $("#edit-user-name").val(userName);
                            $("#edit-user-email").val(userEmail);
                            $("#edit-user-type").val(userType);

                            // Show modal
                            $("#edit-user-modal").fadeIn();
                        });

                        // Bind delete buttons
                        $(".delete-btn").click(function () {
                            const id = $(this).data("id");
                            deleteUser(id);
                        });
                    },
                    error: function (error) {
                        console.error("Error fetching users:", error);
                    }
                });
            }

            // Edit User
            $("#edit-user-form").submit(function (e) {
                e.preventDefault();
                const id = $("#edit-user-id").val();
                const name = $("#edit-user-name").val();
                const email = $("#edit-user-email").val();
                const type = $("#edit-user-type").val();

                $.ajax({
                    url: "../actions/dashboard.php",
                    method: "POST",
                    data: { action: "edit_user", id: id, name: name, email: email, type: type },
                    success: function (response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            alert("User updated successfully!");
                            fetchUsers();
                            $("#edit-user-modal").fadeOut();
                        } else {
                            alert("Failed to update user: " + result.error);
                        }
                    },
                    error: function (error) {
                        console.error("Error updating user:", error);
                    }
                });
            });

            function deleteUser(id) {
    if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
            url: "../actions/dashboard.php",
            method: "POST",
            data: { action: "delete_user", id: id },
            success: function (response) {
                try {
                    const result = JSON.parse(response); // Safely parse response
                    if (result.success) {
                        // alert("User deleted successfully!");
                        fetchUsers();
                    } 
                } catch (e) {
                    console.error("Invalid JSON response:", response);
                    // alert("An error occurred while processing your request.");
                }
            },
            error: function (error) {
                console.error("Error deleting user:", error);
                alert("Failed to connect to the server. Please try again later.");
            }
        });
    }
}


            // Close Edit Modal
            $("#close-modal").click(function () {
                $("#edit-user-modal").fadeOut();
            });

            // Fetch initial users
            fetchUsers();
        });
    </script>



</body>

</html>