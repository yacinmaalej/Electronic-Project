<!-- admin/ajout_produit.php -->
<?php include 'admin_header.php'; ?>
<form action="traitement_ajout_produit.php" method="post" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom du produit" required>
    <input type="text" name="marque" placeholder="Marque" required>
    <input type="number" name="prix" placeholder="Prix" required>
    <input type="file" name="image" required>
    <button type="submit">Ajouter</button>
</form>
<?php include 'admin_footer.php'; ?>