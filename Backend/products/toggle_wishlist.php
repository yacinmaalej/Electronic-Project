<?php
require_once('../config.php');
require_once('../verify_session.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = intval($_POST['product_id']);

$cnx = new Connexion();
$pdo = $cnx->CNXbase();

// Vérifie si déjà dans la wishlist
$stmt = $pdo->prepare("SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?");
$stmt->execute([$userId, $productId]);

if ($stmt->rowCount() > 0) {
    // Supprimer
    $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?")->execute([$userId, $productId]);
    echo json_encode(['success' => true, 'action' => 'removed']);
} else {
    // Ajouter
    $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)")->execute([$userId, $productId]);
    echo json_encode(['success' => true, 'action' => 'added']);
}
