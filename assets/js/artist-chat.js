// Simulating some initial chat data
const chats = [
    { id: 1, name: "Artist A", lastMessage: "Hey, are you free for a collab?", timestamp: "2:45 PM" },
    { id: 2, name: "Artist B", lastMessage: "Let's talk about the new track", timestamp: "1:30 PM" },
    { id: 3, name: "Artist C", lastMessage: "I loved your last release!", timestamp: "11:20 AM" },
];

const chatListElement = document.getElementById("chat-list");
const chatHistoryElement = document.getElementById("chat-history");
const chatTitleElement = document.getElementById("chat-title");
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-btn");

// Render chat list
chats.forEach(chat => {
    const chatItem = document.createElement("li");
    chatItem.classList.add("chat-item");
    chatItem.setAttribute("data-chat-id", chat.id);
    chatItem.innerHTML = `
        <span>${chat.name}</span>
        <span class="chat-message">${chat.lastMessage}</span>
        <span class="chat-time">${chat.timestamp}</span>
    `;
    chatListElement.appendChild(chatItem);
});

// Handle chat selection
chatListElement.addEventListener("click", (e) => {
    const chatId = e.target.closest("li")?.getAttribute("data-chat-id");
    if (chatId) {
        openChat(chatId);
    }
});

// Function to open a chat
function openChat(chatId) {
    const selectedChat = chats.find(chat => chat.id == chatId);
    chatTitleElement.textContent = `Chat with ${selectedChat.name}`;
    chatHistoryElement.innerHTML = `
        <div class="message sent">Hi! Let's work on that track!</div>
        <div class="message">Sounds good! Let's get started.</div>
    `;
}

// Send message functionality
sendButton.addEventListener("click", () => {
    const message = messageInput.value.trim();
    if (message) {
        const newMessage = document.createElement("div");
        newMessage.classList.add("message", "sent");
        newMessage.textContent = message;
        chatHistoryElement.appendChild(newMessage);
        messageInput.value = "";
        chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
    }
});
