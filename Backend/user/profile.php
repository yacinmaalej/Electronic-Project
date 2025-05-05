<?php
include 'jwt.php';
session_start();

if (!isset($_SESSION['token']) || !verifyJWT($_SESSION['token'])) {
    header("Location: login.php");
    exit;
}

echo "<div class='container mt-5'><h3>Welcome to your profile!</h3><a href='logout.php' class='btn btn-danger'>Logout</a></div>";
?>
