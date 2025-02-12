<?php
class Quiz {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllQuizzes() {
        $stmt = $this->pdo->query("SELECT * FROM quizzes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createQuiz($title, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO quizzes (title, created_by) VALUES (?, ?)");
        $stmt->execute([$title, $userId]);
        return $this->pdo->lastInsertId();
    }
}
?>