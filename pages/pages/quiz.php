<?php
session_start();
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$quiz_id = $_GET['id'];
$conn = Database::getConnection();

// Récupérer les questions du quiz
$query = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$query->execute([$quiz_id]);
$questions = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le titre du quiz
$query = $conn->prepare("SELECT title FROM quizzes WHERE id = ?");
$query->execute([$quiz_id]);
$quiz_title = $query->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night - <?php echo htmlspecialchars($quiz_title); ?></title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <div class="background"></div>
    
    <button onclick="history.back()">Retour</button>
    
    <h1 class="title">Quiz Night - <?php echo htmlspecialchars($quiz_title); ?></h1>

    <h2>Questions</h2>
    <div class="container">
        <?php foreach ($questions as $question) : ?>
            <div class="question">
                <p><?php echo htmlspecialchars($question['question_text']); ?></p>
                <?php
                // Récupérer les réponses de la question
                $query = $conn->prepare("SELECT * FROM reponse WHERE question_id = ?");
                $query->execute([$question['id']]);
                $reponses = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <ul>
                    <?php foreach ($reponses as $reponse) : ?>
                        <li><?php echo htmlspecialchars($reponse['texte_reponse']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="./assets/js/script.js"></script>
</body>
</html>