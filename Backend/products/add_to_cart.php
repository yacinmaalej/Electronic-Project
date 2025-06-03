<?php
session_start();
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'] ?? 1;

    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        $newQuantity = $existingItem['quantity'] + $quantity;
        $updateStmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $updateStmt->execute([$newQuantity, $userId, $productId]);
    } else {
        $insertStmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insertStmt->execute([$userId, $productId, $quantity]);
    }

    header("Location: ../../frontend/views/store.php"); 
    exit();
}
?>
