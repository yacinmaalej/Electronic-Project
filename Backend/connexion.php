

<!-- connexion.php -->
<?php include 'header.php'; ?>
<form action="traitement_connexion.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
<?php include 'footer.php'; ?>