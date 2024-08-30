<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'Which part of the Indian Constitution contains the Directive Principles of State Policy?', 'options' => ['Part III', 'Part IV', 'Part V', 'Part VI'], 'answer' => 'Part IV'],
    2 => ['question' => 'What is the purpose of the Directive Principles of State Policy?', 'options' => ['To protect the fundamental rights', 'To ensure social and economic welfare', 'To regulate the executive', 'To define the powers of the Parliament'], 'answer' => 'To ensure social and economic welfare'],
    3 => ['question' => 'Which Article directs the State to promote education and economic interests of the weaker sections?', 'options' => ['Article 39', 'Article 41', 'Article 46', 'Article 49'], 'answer' => 'Article 46'],
    4 => ['question' => 'Article 44 of the Indian Constitution deals with which of the following?', 'options' => ['Uniform Civil Code', 'Prohibition of child labor', 'Protection of monuments', 'Promotion of agriculture'], 'answer' => 'Uniform Civil Code'],
    5 => ['question' => 'Under which Article does the State have a duty to raise the level of nutrition and standard of living?', 'options' => ['Article 38', 'Article 47', 'Article 41', 'Article 43'], 'answer' => 'Article 47']
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
