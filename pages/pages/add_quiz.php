<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "quiz_night");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajouter un quiz
if (isset($_POST['add_quiz'])) {
    $theme = $conn->real_escape_string($_POST['theme']);
    $question = $conn->real_escape_string($_POST['question']);
    $answers = explode(',', $conn->real_escape_string($_POST['answers']));
    $correct_answer = $conn->real_escape_string($_POST['correct_answer']);
    
    // Ajouter le thème s'il n'existe pas
    $sql = "INSERT INTO theme (nom) VALUES ('$theme') ON DUPLICATE KEY UPDATE id=id";
    $conn->query($sql);
    $theme_id = ($conn->insert_id) ? $conn->insert_id : $conn->query("SELECT id FROM theme WHERE nom='$theme'")->fetch_assoc()['id'];
    
    // Ajouter la question
    $sql = "INSERT INTO questions (quiz_id, question_text) VALUES ($theme_id, '$question')";
    $conn->query($sql);
    $question_id = $conn->insert_id;
    
    // Ajouter les réponses
    foreach ($answers as $index => $answer) {
        $is_correct = ($answer === $correct_answer) ? 1 : 0;
        $sql = "INSERT INTO reponse (question_id, option_id, texte_reponse, est_correcte) VALUES ($question_id, $index + 1, '$answer', $is_correct)";
        $conn->query($sql);
    }
}

// Modifier un quiz
if (isset($_POST['edit_quiz'])) {
    $question_id = $_POST['question_id'];
    $question = $conn->real_escape_string($_POST['question']);
    $conn->query("UPDATE questions SET question_text='$question' WHERE id=$question_id");
}

// Supprimer un quiz
if (isset($_POST['delete_quiz'])) {
    $question_id = $_POST['question_id'];
    $conn->query("DELETE FROM reponse WHERE question_id=$question_id");
    $conn->query("DELETE FROM questions WHERE id=$question_id");
}

// Récupérer les quiz existants
$quizzes = $conn->query("SELECT questions.id, questions.question_text, theme.nom AS theme FROM questions JOIN theme ON questions.quiz_id = theme.id");
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/admin.css">
    <script src="./assets/js/script2.js"></script>

    <title>Gestion des Quiz</title>
</head>
<body>
    <button onclick="history.back()">Retour</button>
    
    <h2>Gestion des Quiz</h2>
    
    <form method="POST">
        <input type="text" name="theme" placeholder="Thème" required>
        <input type="text" name="question" placeholder="Question" required>
        <input type="text" name="answers" placeholder="Réponses (séparées par des virgules)" required>
        <input type="text" name="correct_answer" placeholder="Réponse correcte" required>
        <button type="submit" name="add_quiz">Ajouter le Quiz</button>
    </form>
    
    <table>
        <tr>
            <th>Thème</th>
            <th>Question</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $quizzes->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['theme']) ?></td>
            <td><?= htmlspecialchars($row['question_text']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="question_id" value="<?= $row['id'] ?>">
                    <input type="text" name="question" value="<?= htmlspecialchars($row['question_text']) ?>" required>
                    <button type="submit" name="edit_quiz">Modifier</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="question_id" value="<?= $row['id'] ?>">
                    <button type="submit" name="delete_quiz" onclick="return confirm('Supprimer ce quiz ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>