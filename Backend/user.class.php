<?php
class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $password;

    // Function to insert a user into the database
    public function insertUser() {
        require_once('Config.php'); // Include database connection class
        $cnx = new Connexion();
        $pdo = $cnx->CNXpdo();
    
        // Use a prepared statement with placeholders
        $sql = "INSERT INTO users (id, nom, email, password) VALUES (:id, :nom, :email, :password)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
    
        if ($stmt->execute()) {
            echo "User inserted successfully!";
        } else {
            print_r($stmt->errorInfo());
        }
    }

    // Recherche User function
    function recherche_user() {
        require_once('config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXpdo();
    
        // Corrected SQL Query
        $sql = "SELECT count(*) FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    
        $count = $stmt->fetchColumn(); // Fetch the count value
        return $count;
    }

    // List Users
    function listUsers() {
        require_once('config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXpdo();
    
        $req = "SELECT * FROM users";
    
        try {
            $res = $pdo->query($req);
            return $res;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
?>
