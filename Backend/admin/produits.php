<!-- admin/produits.php -->
<?php include 'admin_header.php'; ?>
<h1>Gestion des Produits</h1>
<a href="ajout_produit.php">Ajouter un produit</a>
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
        <td><img src="../images/<?= htmlspecialchars($produit['image']) ?>" width="100"></td>
        <td>
            <a href="modifier_produit.php?id=<?= $produit['id'] ?>">Modifier</a>
            <a href="supprimer_produit.php?id=<?= $produit['id'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'admin_footer.php'; ?>
