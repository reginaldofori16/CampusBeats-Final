<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Chat</title>
    <link rel="stylesheet" href="../assets/css/artist-chat.css">
</head>
<body>

<header>
    <div class="logo">Campus Beats</div>
    <nav>
        <ul>
            <li><a href="artist-dashboard.php">Home</a></li>
            <li><a href="artist-profile.php">Profile</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="chat-container">
        <aside class="chat-sidebar">
            <h3>Recent Chats</h3>
            <ul id="chat-list">
                <!-- List of chats will be dynamically populated -->
            </ul>
        </aside>

        <div class="chat-window">
            <div class="chat-header">
                <h2 id="chat-title">Select a chat to start</h2>
            </div>
            <div class="chat-history" id="chat-history">
                <!-- Chat history will be dynamically loaded -->
            </div>
            <div class="chat-input">
                <input type="text" id="message-input" placeholder="Type your message...">
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2024 Campus Beats. All rights reserved.</p>
</footer>

<script src="../assets/js/artist-chat.js"></script>

</body>
</html>
