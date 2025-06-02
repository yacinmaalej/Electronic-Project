<?php
require_once('../config.php');

$cnx = new Connexion();
$pdo = $cnx->CNXbase();

// Vérifier si un ID est fourni
if (!isset($_GET['id'])) {
    echo "ID du produit manquant.";
    exit;
}

$id = $_GET['id'];

// Récupérer les infos du produit
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Produit non trouvé.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>

<h2>Update Product</h2>
<form action="update_product.php" method="POST">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <label>Name of the Product :</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>

    <label>brand of the Product :</label>
    <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required><br>

    <label>Description :</label>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>

    <label>Price :</label>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br>

    

    <label>Category :</label>
    <select name="category">
        <option value="accessories" <?= $product['category'] == 'accessories' ? 'selected' : '' ?>>Accessories</option>
        <option value="smartphone" <?= $product['category'] == 'smartphone' ? 'selected' : '' ?>>Smartphone</option>
        <option value="laptop" <?= $product['category'] == 'laptop' ? 'selected' : '' ?>>Laptop</option>
    </select><br>

    <label>Stock :</label>
    <input type="number" name="stock" value="<?= $product['stock'] ?>"><br>

    <label>Image (URL) :</label>
    <input type="text" name="image" value="<?= $product['image'] ?>"><br>

    <button type="submit">Modifier</button>
</form>

</body>
</html>
