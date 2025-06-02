<?php

require_once('product.class.php');

$produit = new Produit();

$produit->nom = $_POST['name'] ?? null;
$produit->marque = $_POST['brand'] ?? null;
$produit->Description = $_POST['description'] ?? null;
$produit->prix = $_POST['price'] ?? null;
$produit->categorie = $_POST['category'] ?? null;
$produit->stock = $_POST['stock'] ?? null;

// Vérifie que tous les champs requis sont remplis
if ($produit->nom && $produit->marque && $produit->Description && $produit->prix && $produit->categorie && $produit->stock) {

    // Gestion de l'upload de la photo
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $fileTemp = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $targetPath =  __DIR__ . '/../../frontend/uploads/' . $fileName; // Use __DIR__ for absolute path

        if (move_uploaded_file($fileTemp, $targetPath)) {
            $produit->photo = 'uploads/' .$fileName;
        } else {
            echo "Error uploading the photo.";
            exit();
        }
    } else {
        echo "Please select an image.";
        exit();
    }

    // Insertion du produit
    $produit->insertproduct();
    
    // Redirection après insertion
    header('Location: ../../frontend/views/store.php');
    exit();

} else {
    echo "Erreur : Tous les champs sont obligatoires.";
}
?>
