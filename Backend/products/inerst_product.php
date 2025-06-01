<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Insertion Produit</title>
</head>
<body>

<h2>Ajouter un produit</h2>
<form action="traiement_insc_prod.php" method="post" enctype="multipart/form-data">
    ID: <input type="text" name="id"><br><br>
    Nom: <input type="text" name="nom"><br><br>
    Marque: <input type="text" name="marque"><br><br>
    Description: <input type="text" name="desc"><br><br>
    Prix: <input type="text" name="prix"><br><br>
    Catégorie: <input type="text" name="categorie"><br><br>
    Stock: <input type="number" name="stock"><br><br>
    Photo: <input type="file" name="photo"><br><br>
    <input type="submit" value="Ajouter le produit">
</form>

</body>
</html>
