<?php
include "include/header.php";

$sql = "SELECT users.name, SUM(quiz_scores.score) as total_score 
        FROM quiz_scores 
        JOIN users ON quiz_scores.user_id = users.id 
        GROUP BY quiz_scores.user_id 
        ORDER BY total_score DESC 
        LIMIT 10";
$result = $conn->query($sql);

echo "<div class='w-full max-w-2xl mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg'>";
echo "<h2 class='text-3xl font-bold text-center mb-5'>Leaderboard</h2>";
echo "<table class='w-full text-left'>";
echo "<tr class='border-b'><th class='pb-2 text-lg'>User</th><th class='pb-2 text-lg'>Total Score</th></tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr class='bg-gray-100 rounded-lg shadow-md my-2'>";
    echo "<td class='p-3 rounded-l-lg'>" . $row['name'] . "</td>";
    echo "<td class='p-3 rounded-r-lg'>" . $row['total_score'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

$conn->close();
?>
