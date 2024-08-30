<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "samvidhan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $username = $_POST['username'];

    if (!empty($message) && !empty($username)) {
        $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $message);
        $stmt->execute();
    }
}

$query = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $conn->query($query);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Platform</title>
    <style>
        body { font-family: Arial, sans-serif; }
        #chat-box { border: 1px solid #ccc; width: 60%; height: 400px; overflow-y: scroll; margin-bottom: 10px; padding: 10px; }
        #message-input { width: 80%; }
        #send-btn { width: 15%; }
    </style>
</head>
<body>

    <div id="chat-box"></div>

    <input type="text" id="message-input" placeholder="Type your message..." />
    <button id="send-btn">Send</button>

    <script src="chat.js"></script>
</body>
</html>
