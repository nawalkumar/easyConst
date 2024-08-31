<?php
include "include/header.php"; // Including the header for connection and common functionalities

// Check if $pdo is defined
if (!isset($pdo)) {
    die('PDO connection not initialized.');
}

$user_id = $_SESSION['user_id']; // Assuming the user is logged in and user_id is stored in the session

try {
    // Get user information
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    // Get total score
    $stmt = $pdo->prepare('SELECT SUM(score) as total_score FROM quiz_scores WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $total_score = $stmt->fetchColumn();

    // Get recent scores (e.g., last 5 scores)
    $stmt = $pdo->prepare('SELECT quiz_title, score FROM quiz_scores WHERE user_id = ? ORDER BY id DESC LIMIT 5');
    $stmt->execute([$user_id]);
    $recent_scores = $stmt->fetchAll();
} catch (Exception $e) {
    // Handle query errors
    die('Error: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>User Profile</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($user['name']); ?></h5>
            <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p class="card-text"><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
            <p class="card-text"><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p class="card-text"><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
            <p class="card-text"><strong>Total Score:</strong> <?php echo htmlspecialchars($total_score); ?></p>
        </div>
    </div>

    <h3 class="mt-5">Recent Quiz Scores</h3>
    <ul class="list-group">
        <?php foreach ($recent_scores as $score): ?>
            <li class="list-group-item">
                <?php echo htmlspecialchars($score['quiz_title']) . ": " . htmlspecialchars($score['score']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3 class="mt-5">Edit Profile</h3>
    <form action="updateprofile.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
</body>
</html>