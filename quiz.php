<?php
include 'include/header.php';

$questions = [
    1 => ['question' => 'What Article of the Indian Constitution did Meera explain to the villagers?', 'options' => ['Article 1', 'Article 2', 'Article 3', 'Article 4'], 'answer' => 'Article 1'],
    2 => ['question' => 'According to Article 1 of the Indian Constitution, what is India referred to as?', 'options' => ['A Federation of States', 'A Union of States', 'A Confederation of States', 'A Collection of States'], 'answer' => 'A Union of States'],
    3 => ['question' => 'What was the leader in the village advocating for?', 'options' => ['Independence of the region', 'Joining another country', 'Forming a new state within India', 'Changing the village name'], 'answer' => 'Independence of the region'],
    4 => ['question' => 'Why did the leader believe his region should be independent?', 'options' => ['Unique culture and language', 'Economic reasons', 'Political reasons', 'Geographical reasons'], 'answer' => 'Unique culture and language'],
    5 => ['question' => 'What profession was Meera?', 'options' => ['Law student', 'Doctor', 'Teacher', 'Engineer'], 'answer' => 'Law student'],
    6 => ['question' => 'Where did Meera gather the villagers to explain Article 1?', 'options' => ['Village square', 'School', 'Leader’s house', 'Community center'], 'answer' => 'Village square'],
    7 => ['question' => 'What is the main message of Article 1?', 'options' => ['India is a single entity', 'States can secede from India', 'Regions have full autonomy', 'States can declare independence'], 'answer' => 'India is a single entity'],
    8 => ['question' => 'What did Meera say would happen if the villagers allowed themselves to be divided?', 'options' => ['Lose peace and stability', 'Become wealthier', 'Gain more power', 'Live peacefully'], 'answer' => 'Lose peace and stability'],
    9 => ['question' => 'What was the villagers’ reaction to Meera’s explanation?', 'options' => ['Rejected the leader’s call for independence', 'Supported the leader', 'Remained undecided', 'Ignored Meera'], 'answer' => 'Rejected the leader’s call for independence'],
    10 => ['question' => 'What does the story about Article 1 symbolize?', 'options' => ['Unity and integrity of the nation', 'The need for independence', 'The importance of diversity', 'The right to secede'], 'answer' => 'Unity and integrity of the nation']
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
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title">Quiz</h1>
        <form id="quizForm" method="post">
            <p class="question"><?php echo $currentQuestion['question']; ?></p>
            <?php foreach ($currentQuestion['options'] as $option): ?>
                <div class="option">
                    <input type="radio" id="<?php echo $option; ?>" name="option" value="<?php echo $option; ?>" required>
                    <label for="<?php echo $option; ?>"><?php echo $option; ?></label>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="checkAnswer()" class="submit-button">Submit</button>
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
    </script>
</body>
</html>
