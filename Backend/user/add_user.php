<?php
require_once('../verify_session.php');
require_once('user.class.php');
// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}

$utilisateur = new Utilisateur();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur->nom = $_POST['nom'] ?? '';
    $utilisateur->email = $_POST['email'] ?? '';
    $utilisateur->role = $_POST['role'] ?? 'user'; // Valeur par défaut
    $utilisateur->password = $_POST['password'] ?? '';
    $utilisateur->address = $_POST['address'] ?? null;
    $utilisateur->city = $_POST['city'] ?? null;
    $utilisateur->country = $_POST['country'] ?? null;
    $utilisateur->zip_code = $_POST['zip_code'] ?? null;
    $utilisateur->phone = $_POST['phone'] ?? null;

    $utilisateur->insertUser ();

    header("Location: list_users.php"); 
    exit();
}
?>
<?php require_once('../../frontend/public/header.php'); ?>
<div class="section">
<div class="container mt-5">
    <h2>Add User</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nom">Name</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="address">City</label>
            <input type="text" name="city" class="form-control" placeholder="City">
        </div>
        <div class="form-group">
            <label for="address">Country</label>
            <input type="text" name="country" class="form-control" placeholder="Country">
        </div>
        <div class="form-group">
            <label for="address">Zip Code</label>
            <input type="number" name="zip_code" class="form-control" placeholder="Zip Code">
        </div>
        <div class="form-group">
            <label for="address">Phone</label>
            <input type="number" name="phone" class="form-control" placeholder="Phone">
        </div>

        <div class="form-group">
            <label for="role">Rôle</label>
            <select name="role" id="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>
</div>
<?php require_once('../../frontend/public/footer.php'); ?>