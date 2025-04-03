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
    
        // Use a prepared statement
        $sql = "INSERT INTO utilisateur (user_nom, user_email, user_password) VALUES ($this->id,$this->nom, $this->email, $this->password)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters to prevent SQL injection
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
    function recherche_user(){
        require_once('config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXpdo();
    
        $sql = "SELECT count(*) FROM utilisateur WHERE user_nom ='$this->id'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->id);
        $stmt->execute();
    
        $count = $stmt->fetchColumn(); // Fetch the count value
        return $count;
    }
    function listUsers() {
        require_once('config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXpdo();
    
        $req = "SELECT * FROM utilisateur";
    
        try {
            $res = $pdo->query($req);
            return $res;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
}

?>
