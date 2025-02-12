<?php
session_start();
require_once "../includes/db.php";
require_once "../classes/User.php";

$user = new User($pdo);
if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

echo "Bienvenue dans l'admin !";
?>
<a href="logout.php">Se déconnecter</a>

session_start();
require_once 'config.php';

$conn = Database::getConnection();
$query = $conn->query("SELECT * FROM quizzes");
$quizList = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Night</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>

    <div class="background"></div>
    
    <h1>Bienvenue sur Quiz Night</h1>

    <button onclick="ouvrirModal()">Connexion Admin</button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2>Connexion Administrateur</h2>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>

    <h2>Liste des Quiz</h2>
    <ul>
        <?php foreach ($quizList as $quizzes): ?>
            <li><a href="quizzes.php?id=<?= $quizzes['id'] ?>"><?= htmlspecialchars($quizzes['titre']) ?></a></li>
        <?php endforeach; ?>
    </ul>

    <script src="./assets/js/script.js"></script>
</body>
</html>