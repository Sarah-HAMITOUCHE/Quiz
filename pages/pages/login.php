<?php
session_start();
require_once "../includes/db.php";
require_once "../classes/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($pdo);
    if ($user->login($_POST['username'], $_POST['password'])) {
        header("Location: index.php");
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur">
    <input type="password" name="password" placeholder="Mot de passe">
    <button type="submit">Se connecter</button>
</form>
