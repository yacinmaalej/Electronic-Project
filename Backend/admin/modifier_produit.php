<!-- admin/modifier_produit.php -->
<?php include 'admin_header.php'; ?>
<form action="traitement_modifier_produit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <input type="text" name="nom" value="<?= $produit['nom'] ?>" required>
    <input type="text" name="marque" value="<?= $produit['marque'] ?>" required>
    <input type="number" name="prix" value="<?= $produit['prix'] ?>" required>
    <input type="file" name="image">
    <button type="submit">Modifier</button>
</form>
<?php include 'admin_footer.php'; ?>