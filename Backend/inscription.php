<!-- inscription.php -->
<?php include 'header.php'; ?>
<form action="traitement_inscription.php" method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
</form>
<?php include 'footer.php'; ?>