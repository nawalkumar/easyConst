<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'Which term was added to the Preamble by the 42nd Amendment of the Indian Constitution?', 'options' => ['Sovereign', 'Socialist', 'Secular', 'Democratic'], 'answer' => 'Socialist'],
    2 => ['question' => 'Which of the following is NOT mentioned in the Preamble?', 'options' => ['Justice', 'Liberty', 'Equality', 'Fundamental Duties'], 'answer' => 'Fundamental Duties'],
    3 => ['question' => 'The Preamble declares India to be a ________.', 'options' => ['Federation of States', 'Union of States', 'Confederation of States', 'Republic of States'], 'answer' => 'Union of States'],
    4 => ['question' => 'Which of the following reflects the objective of "Liberty" mentioned in the Preamble?', 'options' => ['Liberty of Thought', 'Liberty of Expression', 'Liberty of Belief', 'All of the above'], 'answer' => 'All of the above'],
    5 => ['question' => 'Which phrase in the Preamble indicates the importance of fraternity?', 'options' => ['Unity and Integrity of the Nation', 'Sovereign Socialist Secular', 'Democratic Republic', 'Justice, Social, Economic, and Political'], 'answer' => 'Unity and Integrity of the Nation']
];

$questionNumber = isset($_SESSION['questionNumber']) ? $_SESSION['questionNumber'] : 1;
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOption = $_POST['option'];
    $correctAnswer = $questions[$questionNumber]['answer'];

    if ($selectedOption === $correctAnswer) {
        $score += 5;
        $_SESSION['score'] = $score;
    } else {
        $score += 0;
        $_SESSION['score'] = $score;
    }

    $questionNumber++;
    $_SESSION['questionNumber'] = $questionNumber;

    if ($questionNumber > count($questions)) {
        echo "<p class='end-message'>Congratulations! You have completed the quiz. Your score is: $score</p>";
        session_destroy();
        exit;
    }
}

$currentQuestion = $questions[$questionNumber];
shuffle($currentQuestion['options']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz on the Preamble</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title">Test Your Knowledge: The Preamble</h1>
        <form id="quizForm" method="post">
            <p class="question"><?php echo $currentQuestion['question']; ?></p>
            <?php foreach ($currentQuestion['options'] as $option): ?>
                <div class="option">
                    <input type="radio" id="<?php echo $option; ?>" name="option" value="<?php echo $option; ?>" required>
                    <label for="<?php echo $option; ?>"><?php echo $option; ?></label>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="checkAnswer()" class="submit-button">Submit</button>
            <button type="button" onclick="exitQuiz()" class="exit-button">Exit</button>
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
                }, 1000);
            } else {
                feedback.innerHTML = 'Incorrect!';
                feedback.style.color = 'red';
                selectedOption.parentElement.style.backgroundColor = '#f8d7da';
                document.querySelector(`input[value="${correctAnswer}"]`).parentElement.style.backgroundColor = '#d4edda';
                document.querySelector(`input[value="${correctAnswer}"]`).nextElementSibling.style.color = 'green';
                selectedOption.nextElementSibling.style.color = 'red';
                setTimeout(() => {
                    document.getElementById('quizForm').submit();
                }, 1000);
            }
        }

        function exitQuiz() {
            window.history.back();
        }
    </script>
</body>
</html>
