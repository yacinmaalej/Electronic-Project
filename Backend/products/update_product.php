<?php
require_once('product.class.php');
require_once('..\config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileTemp = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $targetPath = __DIR__ . '/../../frontend/uploads/' . $fileName; 

        if (move_uploaded_file($fileTemp, $targetPath)) {
            $image = 'uploads/' . $fileName; 
        } else {
            echo "Error uploading the photo.";
            exit();
        }
    } else {
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $currentProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $currentProduct['image']; 
    }

    $sql = "UPDATE products SET 
            name = :name, 
            description = :description, 
            brand = :brand,
            price = :price, 
            image = :image, 
            category = :category, 
            stock = :stock 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':stock', $stock);

    if ($stmt->execute()) {
        header("Location: ../../frontend/views/store.php"); 
        exit();
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
