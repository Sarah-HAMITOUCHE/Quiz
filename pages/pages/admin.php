<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ./pages/pages/login.php");
    exit();
}
require_once "./config.php";

$conn = Database::getConnection();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quiz Night</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <h1>Gestion des Quiz</h1>

    <form action="add_quiz.php" method="post">
        <label for="theme">Thème:</label>
        <input type="text" id="theme" name="theme" required>
        <label for="question">Question:</label>
        <input type="text" id="question" name="question" required>
        <label for="answers">Réponses (séparées par une virgule):</label>
        <input type="text" id="answers" name="answers" required>
        <label for="correct_answer">Réponse correcte:</label>
        <input type="text" id="correct_answer" name="correct_answer" required>
        <button type="submit">Ajouter Quiz</button>
    </form>
</body>
</html>