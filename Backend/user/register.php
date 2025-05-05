<?php include 'config.php'; ?>
<form method="POST" action="">
<input type="text" name="nom" placeholder="Nom" required class="form-control mb-2">
    <input type="text" name="email" placeholder="Email" required class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->execute([
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);
    echo "<div class='alert alert-success'>Enregistré avec succès!</div>";
}
?>
