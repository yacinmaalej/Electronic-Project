<?php
class Cart {
    public function getCartItems($userId) {
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();

        $sql = "SELECT p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return cart items as an associative array
    }
}
?>
