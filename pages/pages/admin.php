<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../login.php");
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
    <link rel="stylesheet" href="./assets/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <div class = titre>
            <h2>Bienvenue a toi </h2>
        </div>
        <h1>Gestion des Quiz</h1>

        <form action="add_quiz.php" method="post" class="admin-form">
            <div class="form-group">
                <label for="theme">Thème:</label>
                <input type="text" id="theme" name="theme" required>
            </div>
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" id="question" name="question" required>
            </div>
            <div class="form-group">
    </form>
</body>
</html>