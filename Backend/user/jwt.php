<?php
require 'vendor/autoload.php'; // avec firebase/php-jwt via Composer

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secretKey = 'your_secret_key';

function generateJWT($userId) {
    global $secretKey;
    $payload = [
        'sub' => $userId,
        'exp' => time() + 3600
    ];
    return JWT::encode($payload, $secretKey, 'HS256');
}

function verifyJWT($token) {
    global $secretKey;
    try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
        return $decoded->sub;
    } catch (Exception $e) {
        return false;
    }
}
?>
