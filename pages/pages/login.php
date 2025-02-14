<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Récupérer l'utilisateur depuis la base de données
    $conn = Database::getConnection();
    $query = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $query->execute([$username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["admin"] = $username;
        header("Location: ../admin.php");
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>