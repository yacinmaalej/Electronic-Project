<?php
require_once('../verify_session.php');
require_once('user.class.php');
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}

$utilisateur = new Utilisateur();

if (isset($_GET['id'])) {
    $utilisateur->id = $_GET['id'];
    $userCount = $utilisateur->recherche_user(); 

    if ($userCount == 0) {
        echo "User  not found!";
        exit();
    }
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $utilisateur->id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "User ID not provided!";
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $utilisateur->id = $_POST['id'];
    $utilisateur->nom = $_POST['name'];
    $utilisateur->email = $_POST['email'];
    
    $utilisateur->role = $_POST['role'] ?? $user['role'];
    if (!empty($_POST['password'])) {
        $utilisateur->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $utilisateur->password = $user['password']; 
    }    
    $utilisateur->address = $_POST['address'] ?? $user['address'];
    $utilisateur->city = $_POST['city'] ?? $user['city'];
    $utilisateur->country = $_POST['country'] ?? $user['country'];
    $utilisateur->zip_code = $_POST['zip_code'] ?? $user['zip_code'];
    $utilisateur->phone = $_POST['phone'] ?? $user['phone'];
    $utilisateur->modify_user($utilisateur->id);
    header("Location: ../../frontend/views/index.php");
    exit();
}
?>

<?php require_once('../../frontend/public/header.php'); ?>
<div class="section">
<div class="container mt-5">
    <h2>Modify User</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
         <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
         </div>
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
        </div>
         <div class="form-group">
            <label for="country">Country</label>
            <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($user['country'] ?? '') ?>">
         </div>
        <div class="form-group">
            <label for="zip_code">Zip Code</label>
            <input type="number" name="zip_code" class="form-control" value="<?= htmlspecialchars($user['zip_code'] ?? '') ?>">
            </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
         </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User </option>
                <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>
</div>
<?php require_once('../../frontend/public/footer.php'); ?>