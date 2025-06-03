<?php 
require_once(__DIR__ . '/../config.php');


$cnx = new Connexion();
$pdo = $cnx->CNXbase();
$id = $_GET['id'] ?? null;

if (!isset($id)) {
    echo "Product ID is missing.";
    exit;
}

$req = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($req); 

$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}

?>
