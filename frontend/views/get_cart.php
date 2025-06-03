<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../../Backend/config.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); 
    exit();
}

$userId = $_SESSION['user_id'];
$cnx = new Connexion();
$pdo = $cnx->CNXbase();

$stmt = $pdo->prepare("
    SELECT p.id, p.name, p.price, c.quantity, p.image
    FROM cart c 
    JOIN products p ON c.product_id = p.id 
    WHERE c.user_id = ?
");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->errorCode() !== '00000') {
    echo json_encode(['error' => 'Database error: ' . implode(', ', $stmt->errorInfo())]);
    exit();
}
echo json_encode($cartItems); 
?>
