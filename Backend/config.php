<?php
class Connexion {

    public function CNXbase() {

        $host = 'localhost';
        $dbname = 'boutique';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }

    }
}
?>
