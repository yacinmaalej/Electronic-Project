<!-- produits.php (Liste des produits) -->
<?php include 'header.php'; ?>
<h1>Liste des Produits</h1>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Marque</th>
        <th>Prix</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php foreach ($produits as $produit) : ?>
    <tr>
        <td><?= htmlspecialchars($produit['nom']) ?></td>
        <td><?= htmlspecialchars($produit['marque']) ?></td>
        <td><?= htmlspecialchars($produit['prix']) ?>€</td>
        <td><img src="images/<?= htmlspecialchars($produit['image']) ?>" width="100"></td>
        <td><a href="commande.php?id=<?= $produit['id'] ?>">Commander</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>