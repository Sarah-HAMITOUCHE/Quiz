<?php
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
    <link rel="stylesheet" href="assets/css/styles2.css">
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const element = document.querySelector('.short-animation');
            if (element) {
                setTimeout(() => {
                    window.location.href = '/index.php'; // Redirection vers la page index après 10 secondes
                }, 10000); // 10 seconds
            }
        });
    </script>
</head>
<body>

    <div class="background"></div>
    
    <div class="logo-container">
       <img src="./assets/images/reflexion.webp" alt="Logo Quiz_Night">
    </div>
    <div class="title"> 
           <h1>Bienvenue sur Quiz Night</h1>
    </div>
    
    <button onclick="ouvrirModal()">Connexion Admin</button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2>Connexion Administrateur</h2>
            <form action="./add_quiz.php" method="post">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
    
    <div class="container">
    <?php
    $sql = "SELECT * FROM theme";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="theme">';
        echo '<a href="theme.php?id=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nom']) . '</a>';
        echo '</div>';
    }
    ?>
    </div>

    <div class="short-animation">Your content here</div>

    <script src="./assets/js/script2.js"></script>
</body>
</html>
