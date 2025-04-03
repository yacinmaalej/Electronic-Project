<?php
class Connexion {
    private $pdo;

    public function __construct() {
        session_start(); // Start session

        // PDO Connection
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=boutique", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Échec de connexion PDO: " . $e->getMessage());
        }
    }

    // Return PDO connection
    public function CNXpdo() {
        return $this->pdo;
    }
}
?>