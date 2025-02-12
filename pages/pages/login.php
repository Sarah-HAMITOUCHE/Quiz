<?php
session_start();
require_once 'config.php'; // Inclut le fichier de configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Définir le nom d'utilisateur et le mot de passe corrects
    $correct_username = "admin";
    // Utilisez le hachage du mot de passe que vous souhaitez utiliser
    // Remplacez par le hachage réel généré
    $correct_password_hash = '$2y$10$...'; // Remplacez par le hachage réel généré

    if ($username === $correct_username && password_verify($password, $correct_password_hash)) {
        $_SESSION["admin"] = $username;
        header("Location: ../admin.php"); // Assurez-vous que le chemin est correct
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>

