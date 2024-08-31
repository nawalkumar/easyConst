<?php
include 'include/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'samvidhan');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle new post submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle new reply submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_reply'])) {
    $reply_content = $conn->real_escape_string($_POST['reply_content']);
    $post_id = $conn->real_escape_string($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO replies (post_id, user_id, content) VALUES ('$post_id', '$user_id', '$reply_content')";
    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all posts
$sql = "SELECT p.id, p.title, p.content, u.name FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id DESC";
$posts = $conn->query($sql);

if (!$posts) {
    die("Error fetching posts: " . $conn->error);
}
?>

<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-6 text-center">Discuss Forum</h1>

    <!-- New Post Form -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-6">
        <form method="POST" action="discuss.php">
            <h2 class="text-2xl mb-4">Drop Your Doubt</h2>
            <input type="text" name="title" class="w-full p-2 mb-4 border border-gray-300 rounded-lg" placeholder="Title" required>
            <textarea name="content" class="w-full p-2 mb-4 border border-gray-300 rounded-lg" rows="4" placeholder="Your doubt..." required></textarea>
            <button type="submit" name="new_post" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post</button>
        </form>
    </div>

    <!-- Posts List -->
    <?php if ($posts->num_rows > 0): ?>
        <?php while($post = $posts->fetch_assoc()): ?>
        <div class="bg-white p-4 rounded-lg shadow-lg mb-6">
            <h2 class="text-xl font-bold"><?= htmlspecialchars($post['title']); ?></h2>
            <p class="text-gray-700"><?= htmlspecialchars($post['content']); ?></p>
            <p class="text-sm text-gray-500">Posted by <?= htmlspecialchars($post['name']); ?></p>

            <!-- Fetch and display replies -->
            <?php
            $post_id = $post['id'];
            $sql_replies = "SELECT r.id, r.content, r.likes, u.name FROM replies r JOIN users u ON r.user_id = u.id WHERE r.post_id = '$post_id' ORDER BY r.id ASC";
            $replies = $conn->query($sql_replies);

            if ($replies && $replies->num_rows > 0):
                while($reply = $replies->fetch_assoc()): ?>
                <div class="mt-4 bg-gray-100 p-3 rounded-lg">
                    <p><?= htmlspecialchars($reply['content']); ?></p>
                    <p class="text-sm text-gray-500">- <?= htmlspecialchars($reply['name']); ?> | Likes: <?= $reply['likes']; ?> 
                        <a href="discuss.php?thumbs_up=<?= $reply['id']; ?>" class="text-blue-500">Thumbs Up</a>
                    </p>
                </div>
                <?php endwhile;
            endif;
            ?>

            <!-- Reply Form -->
            <form method="POST" action="discuss.php" class="mt-4">
                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                <textarea name="reply_content" class="w-full p-2 mb-4 border border-gray-300 rounded-lg" rows="2" placeholder="Your reply..." required></textarea>
                <button type="submit" name="new_reply" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Reply</button>
            </form>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center text-gray-500">No posts available. Be the first to post a discuss!</p>
    <?php endif; ?>
</div>

<?php
include 'include/footer.php';
$conn->close();
?>

</body>
</html>
