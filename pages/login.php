<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = Database::getConnection();
    $query = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $query->execute(["username" => $username]);
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin["password"])) {
        $_SESSION["admin"] = $admin["id"];
        header("Location: admin.php");
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
