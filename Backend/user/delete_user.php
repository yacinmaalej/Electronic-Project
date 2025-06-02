<?php
require_once('../verify_session.php');
require_once('user.class.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $utilisateur = new Utilisateur();
    $utilisateur->delete_user($userId);
    
    $_SESSION['success'] = "User deleted successfully!";
    header("Location: list_users.php");
    exit();
} else {
    header("Location: list_users.php");
    exit();
}
?>
