<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$theme = $_POST['theme'];
$question = $_POST['question'];
$answers = explode(',', $_POST['answers']);
$correct_answer = $_POST['correct_answer'];

$conn = new mysqli("localhost", "root", "", "quiz8night");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajouter le thème s'il n'existe pas
$sql = "INSERT INTO Theme (name) VALUES ('$theme') ON DUPLICATE KEY UPDATE id=id";
$conn->query($sql);

// Récupérer l'ID du thème
$theme_id = $conn->insert_id;

// Ajouter la question
$sql = "INSERT INTO Question (theme_id, question_text) VALUES ($theme_id, '$question')";
$conn->query($sql);
$question_id = $conn->insert_id;

// Ajouter les réponses
foreach ($answers as $answer) {
    $is_correct = ($answer === $correct_answer) ? 1 : 0;
    $sql = "INSERT INTO Answer (question_id, answer_text, is_correct) VALUES ($question_id, '$answer', $is_correct)";
    $conn->query($sql);
}

$conn->close();
header("Location: admin.php");
?>