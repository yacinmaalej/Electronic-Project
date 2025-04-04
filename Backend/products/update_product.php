<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $cnx = new Connexion();
    $pdo = $cnx->CNXpdo();

    $sql = "UPDATE products SET 
            name = :name, 
            description = :description, 
            price = :price, 
            image = :image, 
            category = :category, 
            stock = :stock 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':stock', $stock);

    if ($stmt->execute()) {
        header("Location: liste_produits.php"); // Redirection vers la liste des produits
        exit();
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
