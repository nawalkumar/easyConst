<?php
include 'include/header.php';

$questions = [
    1 => [
        'question' => 'In the story, what was the initial accusation made against Ramesh?',
        'options' => ['Theft of a large sum of money', 'Assault', 'Fraud', 'Tax evasion'],
        'answer' => 'Theft of a large sum of money'
    ],
    2 => [
        'question' => 'Which article of the Indian Constitution did Meena invoke to protect Ramesh?',
        'options' => ['Article 19', 'Article 20', 'Article 21', 'Article 22'],
        'answer' => 'Article 20'
    ],
    3 => [
        'question' => 'What protection does Article 20 provide against self-incrimination?',
        'options' => [
            'It allows a person to remain silent during interrogation',
            'It guarantees a lawyer to every accused person',
            'It provides protection from unlawful arrest',
            'It grants immunity from all forms of punishment'
        ],
        'answer' => 'It allows a person to remain silent during interrogation'
    ],
    4 => [
        'question' => 'Why did the townspeople of Shantipur remain silent when Ramesh was accused?',
        'options' => ['Fear of Mr. Kapoor’s influence', 'Lack of evidence', 'Trust in the police', 'Support for Mr. Kapoor'],
        'answer' => 'Fear of Mr. Kapoor’s influence'
    ],
    5 => [
        'question' => 'What does "double jeopardy," as protected by Article 20, mean?',
        'options' => [
            'Being tried twice for the same offense',
            'Being fined twice for the same crime',
            'Being arrested without a warrant',
            'Being forced to testify against oneself'
        ],
        'answer' => 'Being tried twice for the same offense'
    ],
    6 => [
        'question' => 'How did Meena demonstrate the importance of Article 20 during Ramesh’s interrogation?',
        'options' => [
            'By preventing the police from forcing a confession',
            'By proving Ramesh was innocent',
            'By gathering witnesses in Ramesh’s favor',
            'By negotiating a deal with Mr. Kapoor'
        ],
        'answer' => 'By preventing the police from forcing a confession'
    ],
    7 => [
        'question' => 'What action did Meena take after Ramesh was released from custody?',
        'options' => [
            'Filed a complaint against Mr. Kapoor and the police',
            'Left the town',
            'Advised Ramesh to flee the town',
            'Asked the police to apologize'
        ],
        'answer' => 'Filed a complaint against Mr. Kapoor and the police'
    ],
    8 => [
        'question' => 'What is the significance of protecting individuals from being forced to confess under Article 20?',
        'options' => [
            'It upholds the principle of fairness in the judicial process',
            'It allows the police to quickly solve cases',
            'It ensures that only the guilty are punished',
            'It provides immunity to all accused individuals'
        ],
        'answer' => 'It upholds the principle of fairness in the judicial process'
    ],
    9 => [
        'question' => 'In the story, how did Meena help the town of Shantipur learn a valuable lesson?',
        'options' => [
            'By ensuring justice was served and reinforcing constitutional rights',
            'By punishing Ramesh for his actions',
            'By convincing Mr. Kapoor to drop the charges',
            'By leading a protest against the police'
        ],
        'answer' => 'By ensuring justice was served and reinforcing constitutional rights'
    ],
    10 => [
        'question' => 'What is an "ex post facto law," and why is it prohibited by Article 20?',
        'options' => [
            'A law that applies retroactively, prohibited to prevent unfair punishment',
            'A law that applies only to future actions, prohibited to ensure fairness',
            'A law that is passed during an emergency, prohibited to protect citizens',
            'A law that is repealed after its enactment, prohibited to maintain legal consistency'
        ],
        'answer' => 'A law that applies retroactively, prohibited to prevent unfair punishment'
    ]
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
