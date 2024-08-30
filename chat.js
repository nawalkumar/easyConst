document.getElementById('send-btn').addEventListener('click', sendMessage);

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    const username = prompt("Enter your username:");

    if (message === '') return;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "chat.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.status === 200) {
            loadMessages();
            messageInput.value = '';
        }
    };
    xhr.send(`message=${encodeURIComponent(message)}&username=${encodeURIComponent(username)}`);
}

function loadMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "chat.php", true);
    xhr.onload = function() {
        if (this.status === 200) {
            const messages = JSON.parse(this.responseText);
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';

            messages.reverse().forEach(function(msg) {
                const messageDiv = document.createElement('div');
                messageDiv.innerHTML = `<strong>${msg.username}</strong>: ${msg.message} <span style="font-size: smaller;">(${msg.timestamp})</span>`;
                chatBox.appendChild(messageDiv);
            });

            chatBox.scrollTop = chatBox.scrollHeight;
        }
    };
    xhr.send();
}

setInterval(loadMessages, 1000); // Refresh the chat every second