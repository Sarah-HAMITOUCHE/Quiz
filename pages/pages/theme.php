<?php
session_start();
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$theme_id = $_GET['id'];
$conn = Database::getConnection();

// Récupérer les quiz du thème
$query = $conn->prepare("SELECT * FROM quizzes WHERE theme_id = ?");
$query->execute([$theme_id]);
$quizzes = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nom du thème
$query = $conn->prepare("SELECT nom FROM theme WHERE id = ?");
$query->execute([$theme_id]);
$theme_name = $query->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night - <?php echo htmlspecialchars($theme_name); ?></title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <div class="background"></div>
    
    <h1>Quiz Night - <?php echo htmlspecialchars($theme_name); ?></h1>

    <h2>Liste des Quiz</h2>
    <div class="container">
        <?php foreach ($quizzes as $quiz) : ?>
            <div class="theme">
                <a href="quiz.php?id=<?php echo htmlspecialchars($quiz['id']); ?>">
                    <?php echo htmlspecialchars($quiz['title']); ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="./assets/js/script.js"></script>
</body>
</html>