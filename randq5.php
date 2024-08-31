<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'Which part of the Indian Constitution contains the Fundamental Duties?', 'options' => ['Part III', 'Part IV', 'Part IVA', 'Part V'], 'answer' => 'Part IVA'],
    2 => ['question' => 'Which Article of the Indian Constitution lists the Fundamental Duties of citizens?', 'options' => ['Article 12', 'Article 51A', 'Article 21', 'Article 19'], 'answer' => 'Article 51A'],
    3 => ['question' => 'The Fundamental Duties were added to the Indian Constitution by which amendment?', 'options' => ['42nd Amendment', '44th Amendment', '52nd Amendment', '74th Amendment'], 'answer' => '42nd Amendment'],
    4 => ['question' => 'Which of the following is NOT a Fundamental Duty under Article 51A?', 'options' => ['To uphold and protect the sovereignty of India', 'To protect and improve the natural environment', 'To abolish untouchability', 'To safeguard public property'], 'answer' => 'To abolish untouchability'],
    5 => ['question' => 'How many Fundamental Duties are listed under Article 51A?', 'options' => ['9', '10', '11', '12'], 'answer' => '11']
];

$questionNumber = isset($_SESSION['questionNumber']) ? $_SESSION['questionNumber'] : 1;
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOption = $_POST['option'];
    $correctAnswer = $questions[$questionNumber]['answer'];

    if ($selectedOption === $correctAnswer) {
        $score += 5; // Add 5 points for a correct answer
        $_SESSION['score'] = $score;
    }

    $questionNumber++;
    $_SESSION['questionNumber'] = $questionNumber;

    if ($questionNumber > count($questions)) {
        // Store the quiz score in the database
        $quiz_title = 'Article 1 Quiz';
        $stmt = $conn->prepare("INSERT INTO quiz_scores (user_id, quiz_title, score) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $user_id, $quiz_title, $score);
        $stmt->execute();
        $stmt->close();

        // Reset session variables
        unset($_SESSION['questionNumber']);
        unset($_SESSION['score']);

        header('Location: leaderboard.php');
        exit();
    }
}

if ($questionNumber > count($questions)) {
    echo "<p class='end-message'>You have completed the quiz. Your final score is: $score</p>";
    session_destroy();
    exit;
}

$currentQuestion = $questions[$questionNumber];
shuffle($currentQuestion['options']); // Shuffle the options
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class="p-5 mt-5 shadow-lg rounded-lg w-11/12 md:w-7/10 lg:w-4/5 mx-auto mb-16 break-words hover:transform hover:scale-105 transition-transform duration-300 ease-in-out">
        <h1 class="quiz-title my-20 color-gray-600 text-3xl mb-3 text-center md:text-center">Quiz</h1>
        <form id="quizForm" method="post">
            <p class="question"><?php echo $currentQuestion['question']; ?></p>
            <?php foreach ($currentQuestion['options'] as $option): ?>
                <div class="option">
                    <input type="radio" id="<?php echo $option; ?>" name="option" value="<?php echo $option; ?>" required>
                    <label for="<?php echo $option; ?>"><?php echo $option; ?></label>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="checkAnswer()" class="submit-button bg-green-600 color-white ml-5 rounded-lg p-2 mb-1 text-3xl font-bold text-center md:text-center">Submit</button>
            <button type="button" onclick="exitQuiz()" class="exit-button bg-red-600 color-white ml-5 rounded-lg p-2 mb-1 text-3xl font-bold text-center md:text-center">Exit</button>
        </form>
        <div id="feedback" class="feedback"></div>
    </div>

    <script>
        function checkAnswer() {
            const selectedOption = document.querySelector('input[name="option"]:checked');
            if (!selectedOption) return;

            const correctAnswer = "<?php echo $currentQuestion['answer']; ?>";
            const feedback = document.getElementById('feedback');

            if (selectedOption.value === correctAnswer) {
                feedback.innerHTML = 'Correct!';
                feedback.style.color = 'green';
                selectedOption.parentElement.style.backgroundColor = '#d4edda';
                setTimeout(() => {
                    document.getElementById('quizForm').submit();
                }, 1000); // Delay for animation
            } else {
                feedback.innerHTML = 'Incorrect!';
                feedback.style.color = 'red';
                selectedOption.parentElement.style.backgroundColor = '#f8d7da';
                document.querySelector(`input[value="${correctAnswer}"]`).parentElement.style.backgroundColor = '#d4edda';
                document.querySelector(`input[value="${correctAnswer}"]`).nextElementSibling.style.color = 'green';
                selectedOption.nextElementSibling.style.color = 'red';
                setTimeout(() => {
                    document.getElementById('quizForm').submit();
                }, 1000); // Delay for animation
            }
        }

        function exitQuiz() {
            // Navigate to the previous page
            window.history.back();
        }
    </script>
</body>
</html>
