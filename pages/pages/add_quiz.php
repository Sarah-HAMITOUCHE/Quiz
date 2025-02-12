<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = trim($_POST['theme']);
    $question = trim($_POST['question']);
    $answers = array_map('trim', explode(',', $_POST['answers']));
    $correct_answer = trim($_POST['correct_answer']);

    if (empty($theme) || empty($question) || empty($answers) || empty($correct_answer)) {
        die("Tous les champs sont obligatoires.");
    }

    try {
        $conn = Database::getConnection();

        // Vérifier si le thème existe déjà
        $query = $conn->prepare("SELECT id FROM theme WHERE nom = ?");
        $query->execute([$theme]);
        $theme_id = $query->fetchColumn();

        if (!$theme_id) {
            $query = $conn->prepare("INSERT INTO theme (nom) VALUES (?)");
            if (!$query->execute([$theme])) {
                throw new Exception("Erreur lors de l'ajout du thème.");
            }
            $theme_id = $conn->lastInsertId();
        }

        // Ajouter la question
        $query = $conn->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
        if (!$query->execute([$theme_id, $question])) {
            throw new Exception("Erreur lors de l'ajout de la question.");
        }
        $question_id = $conn->lastInsertId();

        // Ajouter les réponses
        foreach ($answers as $answer) {
            $is_correct = ($answer === $correct_answer) ? 1 : 0;
            $query = $conn->prepare("INSERT INTO reponse (question_id, texte_reponse, est_correcte) VALUES (?, ?, ?)");
            if (!$query->execute([$question_id, $answer, $is_correct])) {
                throw new Exception("Erreur lors de l'ajout des réponses.");
            }
        }

        header("Location: admin.php");
        exit();
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    die("Méthode de requête non autorisée.");
}
?>
