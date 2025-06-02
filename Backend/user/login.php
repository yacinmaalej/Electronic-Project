<?php
require_once '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

     
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_address'] = $user['address'] ?? null; 
        $_SESSION['user_city'] = $user['city'] ?? null; 
        $_SESSION['user_country'] = $user['country'] ?? null; 
        $_SESSION['user_zip_code'] = $user['zip_code'] ?? null; 
        $_SESSION['user_phone'] = $user['phone'] ?? null; 

        header("Location: ../../frontend/views/index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Invalid credentials!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

        .login-box {
            background: rgba(0, 51, 102, 0.95);
            padding: 40px 60px;
            border-radius: 10px;
            width: 60%;
            color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
        }

        .login-box h2 {
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

        .btn-login {
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

        .btn-login:hover {
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

<div class="login-box">
    <h2>LOGIN</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" class="form-control" required>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
        <button type="submit" class="btn-login">LOGIN</button>
    </form>
    <div class="link">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><a href="#">Forgot Password?</a></p>
    </div>
</div>

</body>
</html>
