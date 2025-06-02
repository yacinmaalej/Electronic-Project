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

    // Initialize the image variable
    $image = null;

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileTemp = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $targetPath = __DIR__ . '/../../frontend/uploads/' . $fileName; // Use __DIR__ for absolute path

        if (move_uploaded_file($fileTemp, $targetPath)) {
            $image = 'uploads/' . $fileName; // Store the relative path
        } else {
            echo "Error uploading the photo.";
            exit();
        }
    } else {
        // Fetch the current image from the database
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $currentProduct = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $currentProduct['image']; // Keep the existing image
    }

    // Prepare the SQL statement
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
        header("Location: ../../frontend/views/store.php"); // Redirection vers la liste des produits
        exit();
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>
