<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'What Article of the Indian Constitution did Ananya use to challenge the legality of the dam?', 'options' => ['Article 19', 'Article 21', 'Article 265', 'Article 300A'], 'answer' => 'Article 300A'],
    2 => ['question' => 'According to Article 300A, what does the Constitution protect citizens from?', 'options' => ['Unlawful detention', 'Deprivation of property without authority of law', 'Discrimination based on religion', 'Unjust taxation'], 'answer' => 'Deprivation of property without authority of law'],
    3 => ['question' => 'Why was the River Surya important to the villagers of Ratanpur?', 'options' => ['Religious significance', 'Source of drinking water', 'Irrigation for crops', 'All of the above'], 'answer' => 'All of the above'],
    4 => ['question' => 'What was the main legal principle established by the Ratanpur case?', 'options' => ['Dams can only be built by the government', 'Private companies have unrestricted rights to natural resources', 'Community consultation is necessary for projects involving natural resources', 'Natural resources belong exclusively to the state'], 'answer' => 'Community consultation is necessary for projects involving natural resources'],
    5 => ['question' => 'What did Ananya argue was threatened by the loss of the River Surya?', 'options' => ['Villagers\' right to free speech', 'Villagers\' right to life under Article 21', 'Villagers\' right to practice religion', 'Villagers\' right to education'], 'answer' => 'Villagers\' right to life under Article 21'],
    6 => ['question' => 'What was the outcome of the High Court ruling in favor of the villagers?', 'options' => ['The dam construction was halted', 'The villagers were relocated', 'The case was dismissed', 'Shakti Industries was allowed to continue the project'], 'answer' => 'The dam construction was halted'],
    7 => ['question' => 'Which Article of the Indian Constitution did Ananya focus on besides Article 300A?', 'options' => ['Article 19', 'Article 21', 'Article 12', 'Article 14'], 'answer' => 'Article 21'],
    8 => ['question' => 'How did Ananya demonstrate the importance of Article 300A?', 'options' => ['By arguing for the demolition of the dam', 'By proving that the villagers were deprived of their property without due process', 'By negotiating a settlement with Shakti Industries', 'By seeking compensation for the villagers'], 'answer' => 'By proving that the villagers were deprived of their property without due process'],
    9 => ['question' => 'What natural resource was central to the Ratanpur case?', 'options' => ['Forest', 'Minerals', 'River', 'Mountains'], 'answer' => 'River'],
    10 => ['question' => 'What does Article 300A symbolize in this context?', 'options' => ['The power of the government to take property', 'The protection of citizens\' rights to their property', 'The right of corporations to use natural resources', 'The authority of the state over all natural resources'], 'answer' => 'The protection of citizens\' rights to their property']
];

$questionNumber = isset($_SESSION['questionNumber']) ? $_SESSION['questionNumber'] : 1;
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOption = $_POST['option'];
    $correctAnswer = $questions[$questionNumber]['answer'];

    if ($selectedOption === $correctAnswer) {
        $score += 5; // Add 5 points for a correct answer
        $_SESSION['score'] = $score;
    } else {
        $score += 0; // No points for a wrong answer
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
shuffle($currentQuestion['options']); // Shuffle the options
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz on Article 300A</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title">Quiz on Article 300A</h1>
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
