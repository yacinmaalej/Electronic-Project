<?php
session_start();
require_once('../../Backend/verify_session.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);

    header("Location: ../../frontend/views/cart.php"); 
    exit();
}
?>
