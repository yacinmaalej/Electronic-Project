<?php
// connexion.php (Connexion à la base de données avec PDO et MySQLi)

session_start();
$mysqli = new mysqli("localhost", "root", "", "boutique");
if ($mysqli->connect_error) {
    die("Échec de connexion MySQLi: " . $mysqli->connect_error);
}

try { 
    $pdo = new PDO("mysql:host=localhost;dbname=boutique", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de connexion PDO: " . $e->getMessage());
}
?>