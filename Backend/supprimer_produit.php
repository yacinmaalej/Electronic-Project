<!-- admin/supprimer_produit.php -->
<?php include 'admin_header.php'; ?>
<p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
<a href="traitement_supprimer_produit.php?id=<?= $_GET['id'] ?>">Oui, supprimer</a>
<a href="produits.php">Annuler</a>
<?php include 'admin_footer.php'; ?>