

<?php 


require_once('user.class.php');
$us= new Utilisateur();

$us->id = $_POST['id'];
$us->nom = $_POST['nom'];
$us->email = $_POST['email'];
$us->password = $_POST['password'];

$n=$us->recherche_user();
if ($n == 0){
    $us->insertUser();
    header('location:liste.php');
}else{
    header('inscription.php');
}
















?>















?>