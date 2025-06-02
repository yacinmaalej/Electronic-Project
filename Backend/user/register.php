<?php
require_once '../config.php';
require_once 'user.class.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new Utilisateur();
    $user->nom = $_POST['nom'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $cnx = new Connexion();
    $pdo = $cnx->CNXpdo();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$user->email]);

    if ($stmt->rowCount() > 0) {
        echo "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        $user->address = null;
        $user->city = null;
        $user->country = null;
        $user->zip_code = null;
        $user->phone = null;
        $user->insertUser();
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: url('../../frontend/img/background.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            background: rgba(0, 51, 102, 0.95);
            padding: 40px 60px;
            border-radius: 10px;
            width: 40%;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn-register {
            width: 100%;
            background-color: #00BFFF;
            border: none;
            padding: 12px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            box-sizing: border-box;
        }

        .btn-register:hover {
            background-color: #009acd;
        }

        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #00BFFF;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>REGISTER</h2>
    <form method="POST" action="">
        <input type="text" name="nom" placeholder="Name" class="form-control" required>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <button type="submit" class="btn-register">REGISTER</button>
    </form>
    <div class="link">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

</body>
</html>
