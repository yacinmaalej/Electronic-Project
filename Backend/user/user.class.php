<?php
class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $password;
    public $role;
    public $address;
    public $city;
    public $country;
    public $zip_code;
    public $phone;

    // Function to insert a user into the database
    public function insertUser () {
    require_once('../config.php'); // Include database connection class
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    // Hash the password before storing it
    $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

    // Use a prepared statement with placeholders
    $sql = "INSERT INTO users (nom, email, password, address, city, country, zip_code, phone)
        VALUES (:nom, :email, :password, :address, :city, :country, :zip_code, :phone)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':country', $this->country);
    $stmt->bindParam(':zip_code', $this->zip_code);
    $stmt->bindParam(':phone', $this->phone);


    if ($stmt->execute()) {
    } else {
        print_r($stmt->errorInfo());
    }
}


    // Function to search for a user by ID
    public function recherche_user() {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        // Corrected SQL Query
        $sql = "SELECT count(*) FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    
        $count = $stmt->fetchColumn(); // Fetch the count value
        return $count;
    }

    // Function to list all users
    public function listUsers() {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        $req = "SELECT * FROM users";
    
        try {
            $res = $pdo->query($req);
            return $res;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    // Function to delete a user by ID
    public function delete_user($id) {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            echo "User  deleted successfully!";
        } else {
            print_r($stmt->errorInfo());
        }
    }

    // Function to modify a user's details
    public function modify_user($id) {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        // Prepare the SQL statement
        $sql = "UPDATE users SET nom = :nom, email = :email, password = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        
        // Hash the password if it's being updated
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':zip_code', $this->zip_code);
        $stmt->bindParam(':phone', $this->phone);
        if ($stmt->execute()) {
            echo "User  modified successfully!";
        } else {
            print_r($stmt->errorInfo());
        }
    }
}
?>
