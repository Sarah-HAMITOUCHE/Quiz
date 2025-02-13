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
    <link rel="stylesheet" href="./assets/css/styles2.css">
</head>
<body>
    <div class="background"></div>
    
    <h1>Quiz Night - <?php echo htmlspecialchars($quiz_title); ?></h1>

    <div class="quiz-container">
        <?php foreach ($questions as $question) : ?>
            <div class="question-card">
                <h3><?php echo htmlspecialchars($question['question_text']); ?></h3>
                <?php
                // Récupérer les réponses de la question
                $query = $conn->prepare("SELECT * FROM reponse WHERE question_id = ?");
                $query->execute([$question['id']]);
                $reponses = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <ul class="reponses-list">
                    <?php foreach ($reponses as $reponse) : ?>
                        <li>
                            <label>
                                <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $reponse['id']; ?>">
                                <?php echo htmlspecialchars($reponse['texte_reponse']); ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <button onclick="ouvrirModal()">Voir les réponses</button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2>Réponses sélectionnées</h2>
            <div id="reponses-selectionnees"></div>
            <button onclick="soumettreQuiz()">Soumettre</button>
        </div>
    </div>

    <script src="./assets/js/script2.js"></script>
</body>
</html>