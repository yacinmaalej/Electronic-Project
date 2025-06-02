<?php
require_once('../config.php');
require_once('../verify_session.php');
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['count' => 0]);
    exit;
}

$pdo = (new Connexion())->CNXpdo();
$stmt = $pdo->prepare("SELECT COUNT(*) FROM wishlist WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$count = $stmt->fetchColumn();

echo json_encode(['count' => (int)$count]);
