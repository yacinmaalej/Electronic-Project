<?php include 'config.php'; include 'jwt.php'; session_start(); ?>
<form method="POST" action="">
    <input type="text" name="nom" placeholder="Nom" required class="form-control mb-2">
    <input type="email" name="email" placeholder="Email" required class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" required class="form-control mb-2">
    <button type="submit" class="btn btn-success">Login</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['token'] = generateJWT($user['id']);
        header("Location: profile.php");
    } else {
        echo "<div class='alert alert-danger'>Invalid credentials!</div>";
    }
}
?>
