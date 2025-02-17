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

// Vérifier si le formulaire a été soumis
$score = 0;
$totalQuestions = count($questions);
$user_answers = [];
$correct_answers = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $question) {
        $question_id = $question['id'];
        $user_answer = isset($_POST["question_$question_id"]) ? $_POST["question_$question_id"] : null;

        // Stocker la réponse de l'utilisateur
        $user_answers[$question_id] = $user_answer;

        // Récupérer la bonne réponse
        $query = $conn->prepare("SELECT id FROM reponse WHERE question_id = ? AND est_correcte = 1");
        $query->execute([$question_id]);
        $correct_answer = $query->fetchColumn();
        $correct_answers[$question_id] = $correct_answer;

        // Vérifier si la réponse est correcte
        if ($user_answer == $correct_answer) {
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night - <?php echo htmlspecialchars($quiz_title); ?></title>
    <link rel="stylesheet" href="./assets/css/styles2.css">
    <?php if ($quiz_id == 2): ?>
        <link rel="stylesheet" href="./assets/css/histoire_styles.css">
    <?php endif; ?>
    <?php if ($quiz_id == 3): ?>
        <link rel="stylesheet" href="./assets/css/geographie_styles.css">
    <?php endif; ?>
</head>
<body>

    <div class="background"></div>
    <button onclick="history.back()">Retour</button>
    <div class="title">
        <h1>Quiz Night - <?php echo htmlspecialchars($quiz_title); ?></h1>
    </div>

    <div class="quiz-container">
        <form method="POST">
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
                        <?php foreach ($reponses as $reponse) : 
                            $reponse_id = $reponse['id'];
                            $is_correct = $reponse['id'] == ($correct_answers[$question['id']] ?? null);
                            $is_selected = isset($user_answers[$question['id']]) && $user_answers[$question['id']] == $reponse_id;
                            
                            // Définir la couleur selon la réponse
                            $class = "";
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if ($is_selected) {
                                    $class = $is_correct ? "style='color:green; font-weight:bold;'" : "style='color:red; font-weight:bold;'";
                                }
                            }
                        ?>
                            <li>
                                <label>
                                    <input type="radio" name="question_<?php echo $question['id']; ?>" value="<?php echo $reponse['id']; ?>" <?php echo $is_selected ? 'checked' : ''; ?>>
                                    <span <?php echo $class; ?>><?php echo htmlspecialchars($reponse['texte_reponse']); ?></span>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <button type="submit">Soumettre</button>
        </form>
    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="result <?php echo $score > 2 ? 'joy-animation' : ''; ?>">
            <h2>Score : <?php echo $score; ?> / <?php echo $totalQuestions; ?></h2>
        </div>
        <?php if ($score > 2): ?>
            <div class="fireworks"></div>
        <?php endif; ?>
    <?php endif; ?>

    <script src="./assets/js/script2.js"></script>
</body>
</html>
