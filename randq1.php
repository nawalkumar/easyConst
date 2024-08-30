<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'Which Article in the Indian Constitution guarantees the right to equality?', 'options' => ['Article 14', 'Article 19', 'Article 21', 'Article 25'], 'answer' => 'Article 14'],
    2 => ['question' => 'What does Article 19 of the Indian Constitution guarantee?', 'options' => ['Right to freedom of speech and expression', 'Right to life and personal liberty', 'Right to education', 'Right against exploitation'], 'answer' => 'Right to freedom of speech and expression'],
    3 => ['question' => 'Which Article deals with the prohibition of discrimination on grounds of religion, race, caste, sex, or place of birth?', 'options' => ['Article 15', 'Article 19', 'Article 21', 'Article 32'], 'answer' => 'Article 15'],
    4 => ['question' => 'Article 21 of the Indian Constitution guarantees which of the following rights?', 'options' => ['Right to equality', 'Right to freedom of religion', 'Right to life and personal liberty', 'Right to constitutional remedies'], 'answer' => 'Right to life and personal liberty'],
    5 => ['question' => 'Under which Article can a citizen approach the Supreme Court if their fundamental rights are violated?', 'options' => ['Article 32', 'Article 226', 'Article 14', 'Article 19'], 'answer' => 'Article 32']
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
    <title>Quiz on Fundamental Rights</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title">Test Your Knowledge: Fundamental Rights</h1>
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