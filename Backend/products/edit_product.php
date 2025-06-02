<?php
require_once('../verify_session.php');
require_once('product.class.php');

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
<?php require_once('../../frontend/public/header.php'); ?>
<div class="section">
<div class="container mt-5">
<h2>Update Product</h2>
<form action="update_product.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="form-group">
            <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required><br>
        </div>

        <div class="form-group">
            <label for="brand">Brand</label>
        <input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($product['brand']) ?>" required><br>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea><br>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
        <input type="number" step="0.01" name="price"  class="form-control" value="<?= $product['price'] ?>" required><br>
        </div>
        <div class="form-group" >
            <label for="category">Category</label>
       <select name="category" class="form-control">
        <option value="accessories" <?= $product['category'] == 'accessories' ? 'selected' : '' ?>>Accessories</option>
        <option value="smartphone" <?= $product['category'] == 'smartphone' ? 'selected' : '' ?>>Smartphone</option>
        <option value="laptop" <?= $product['category'] == 'laptop' ? 'selected' : '' ?>>Laptop</option>
    </select><br>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
    <input type="number" class="form-control" name="stock" value="<?= $product['stock'] ?>"><br>
        </div>

        <div class="form-group">
    <label for="image">Photo</label>
    <input type="file" name="image" class="form-control-file" id="imageInput" onchange="updateFileName()"><br>
    <span id="fileName"><?= htmlspecialchars($product['image']) ?></span> <!-- Display the current image name -->
</div>
<script>
function updateFileName() {
    const input = document.getElementById('imageInput');
    const fileNameDisplay = document.getElementById('fileName');
    fileNameDisplay.textContent = input.files.length > 0 ? input.files[0].name : '<?= htmlspecialchars($product['image']) ?>';
}
</script>

    <button type="submit" class="btn btn-success" >Modifier</button>
</form>
</div>
</div>
<?php require_once('../../frontend/public/footer.php'); ?>
