<?php
// Afficher toutes les erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    // Paramètres de connexion à la base de données
    private static $host = "localhost";
    private static $dbname = "quiz_night";
    private static $username = "root";
    private static $password = "";
    private static $conn = null;

    // Méthode pour obtenir une connexion à la base de données
    public static function getConnection() {
        if (self::$conn === null) {
            try {
                // Créer une nouvelle connexion PDO
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password);
                // Définir le mode d'erreur sur Exception
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Afficher un message d'erreur en cas d'échec de connexion
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        // Retourner la connexion PDO
        return self::$conn;
    }
}
?>