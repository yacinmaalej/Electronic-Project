<?php
require_once('product.class.php'); // Assure-toi que le nom de fichier correspond à ta classe Produit
$prod = new Produit();
$res = $prod->listproducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #000;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 80px;
            height: auto;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Liste des produits</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Marque</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Stock</th>
        <th>Photo</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>

    <?php foreach ($res as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['brand']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['price']) ?> €</td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= htmlspecialchars($row['stock']) ?></td>
            <td>
                <?php if (!empty($row['image'])): ?>
                    <img src="uploads/<?= htmlspecialchars($row['photo']) ?>" alt="Photo produit">
                <?php else: ?>
                    Aucune image
                <?php endif; ?>
            </td>
            <td><a href="edit_product.php?id=<?= $row['id'] ?>">Modifier</a></td>
            <td><a href="supprimer_produit.php?id=<?= $row['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
