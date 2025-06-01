<?php


require_once('product.class.php');

$produit = new Produit();

$produit->id= $_POST['id'] ?? null;
$produit->nom = $_POST['nom'] ?? null;
$produit->marque = $_POST['marque'] ?? null;
$produit->Description = $_POST['desc'] ?? null;
$produit->prix= $_POST['prix'] ?? null;
$produit->categorie = $_POST['categorie'] ?? null;
$produit->stock = $_POST['stock'] ?? null;


// Vérifie que tous les champs requis sont remplis
if ($produit->id && $produit->nom && $produit->marque && $produit->Description && $produit->prix && $produit->categorie && $produit->stock) {

    // Gestion de l'upload de la photo
   if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

        $fileTemp = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $targetPath = 'uploads/' . $fileName;

        if (move_uploaded_file($fileTemp, $targetPath)) {
            $produit->photo = $fileName;
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
    header('Location: list_products.php');
    exit();

} else {
    echo "Erreur : Tous les champs sont obligatoires.";
}
?>
