<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'Under which Article can the President declare a National Emergency?', 'options' => ['Article 352', 'Article 356', 'Article 360', 'Article 368'], 'answer' => 'Article 352'],
    2 => ['question' => 'Which type of emergency is declared under Article 356?', 'options' => ['National Emergency', 'State Emergency', 'Financial Emergency', 'External Emergency'], 'answer' => 'State Emergency'],
    3 => ['question' => 'Which Article deals with the declaration of a Financial Emergency?', 'options' => ['Article 352', 'Article 356', 'Article 360', 'Article 368'], 'answer' => 'Article 360'],
    4 => ['question' => 'Which of the following situations is NOT a valid ground for declaring a National Emergency under Article 352?', 'options' => ['War', 'External Aggression', 'Armed Rebellion', 'Internal Disturbance'], 'answer' => 'Internal Disturbance'],
    5 => ['question' => 'How long can a Financial Emergency continue after approval by both Houses of Parliament?', 'options' => ['6 months', '1 year', '2 years', 'Indefinitely'], 'answer' => 'Indefinitely']
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
    <title>Quiz on Emergency Provisions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title">Test Your Knowledge: Emergency Provisions</h1>
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
