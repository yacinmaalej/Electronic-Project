<?php        
class Produit
{
    // Attributs de la classe Produit
    public $id;
    public $nom;
    public $marque;
    public $Description;
    public $prix;
    public $categorie;
    public $photo;
    public $stock;


    // Méthode pour insérer un produit
    public function insertproduct()
{
    require_once('../config.php');
    $cnx = new connexion();
    $pdo = $cnx->CNXbase();

    $req = "INSERT INTO products (id, name, brand, description, price, image, category, stock) 
            VALUES (:id, :nom, :marque, :description, :prix, :photo, :categorie, :stock)"; // Notez la casse ici
    
    $stmt = $pdo->prepare($req);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':marque', $this->marque);
    $stmt->bindParam(':description', $this->Description); // Assurez-vous que c'est :description
    $stmt->bindParam(':prix', $this->prix);
    $stmt->bindParam(':categorie', $this->categorie);
    $stmt->bindParam(':photo', $this->photo);
    $stmt->bindParam(':stock', $this->stock);

    if (!$stmt->execute()) {
        print_r($stmt->errorInfo());
        print_r($stmt->debugDumpParams());
    }
}
    // Méthode pour lister les produits
    public function listproducts()
    {
        require_once('../config.php');
        $cnx = new connexion();
        $pdo = $cnx->CNXbase();

        $req = "SELECT * FROM products";
        $res = $pdo->query($req);
        if (!$res) {
            print_r($pdo->errorInfo());
        }
        return $res; 
    }
public function supprimerProduct($id) {
    require_once('../config.php');
    
    $cnx = new Connexion();
    $pdo = $cnx->CNXbase(); // Get the database connection
    
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql); // Use the local $pdo variable here

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}

    // Méthode pour supprimer un produit
   
}
?>
