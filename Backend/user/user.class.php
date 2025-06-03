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

    public function insertUser () {
    require_once('../config.php'); 
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

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


    public function recherche_user() {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        $sql = "SELECT count(*) FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    
        $count = $stmt->fetchColumn(); 
        return $count;
    }

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

    public function delete_user($id) {
        require_once('../config.php');
        $cnx = new Connexion();
        $pdo = $cnx->CNXbase();
    
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        
            $stmt->execute();
        }
            

    public function modify_user($id) {
    require_once('../config.php');
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();

    $sql = "UPDATE users 
        SET nom = :nom, 
            email = :email, 
            role = :role, 
            address = :address, 
            city = :city, 
            country = :country, 
            zip_code = :zip_code, 
            phone = :phone";

    if (!empty($this->password)) {
        $sql .= ", password = :password"; 
    }

    $sql .= " WHERE id = :id"; 

    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':role', $this->role);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':country', $this->country);
    $stmt->bindParam(':zip_code', $this->zip_code);
    $stmt->bindParam(':phone', $this->phone);

    if (!empty($this->password)) {
        $stmt->bindParam(':password', $this->password);
    }

    $stmt->execute();
}

public function getUserById($id) {
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase();
    $sql = "SELECT nom, email, address, city, country, zip_code, phone FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}


    

}
?>
