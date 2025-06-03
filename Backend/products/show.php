<?php 
require_once(__DIR__ . '/../config.php');


// Create a new connection instance
$cnx = new Connexion();
// Get the connection
$pdo = $cnx->CNXbase();
$id = $_GET['id'] ?? null;

// Check if an ID is provided
if (!isset($id)) {
    echo "Product ID is missing.";
    exit;
}

// Prepare the SQL statement
$req = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($req); // Use prepare instead of query

// Bind the parameter
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the statement
$stmt->execute();

// Fetch the product details
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}

// Now you can use the $product array to display product details
?>
