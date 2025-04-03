<?php 
require_once('user.class.php');
$us = new Utilisateur();

// Secure Input Data
$us->id = $_POST['id'] ?? null;
$us->nom = $_POST['nom'] ?? null;
$us->email = $_POST['email'] ?? null;
$us->password = $_POST['password'] ?? null;

if ($us->id && $us->nom && $us->email && $us->password) {
    $n = $us->recherche_user();
    if ($n == 0) {
        $us->insertUser();
        header('location: liste.php');
    } else {
        header('location: inscription.php'); // Fixed incorrect header syntax
    }
} else {
    echo "Error: Missing required fields!";
}
?>
