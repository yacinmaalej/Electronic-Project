<?php
require '../../vendor/autoload.php'; // avec firebase/php-jwt via Composer

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

 $secretKey = bin2hex(random_bytes(32)); // Générer une clé secrète aléatoire pour signer les JWT

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
