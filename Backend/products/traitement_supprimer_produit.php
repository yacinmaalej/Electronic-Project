<?php
// admin/supprimer_produit.php

require_once('../config.php');
require_once('product.class.php');

// Check if the ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Product ID is missing.";
    exit;
}

$id = $_GET['id']; // Ensure it's an integer

try {
    $produit = new Produit();

    // Call the delete method
    if ($produit->supprimerProduct($id)) {
        header("Location: ../../frontend/views/store.php?message=Product deleted successfully");
        exit;
    } else {
        echo "Failed to delete the product.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
