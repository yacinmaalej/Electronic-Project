<?php

require_once('user.class.php');
$us = new Utilisateur();
$res= $us->listUsers();

?>
<table border="1">
    <tr>
        <td>Nom</td>
        <td>email</td>
        <td>password</td>
        <td>modifier</td>
        <td>supprimer</td>
    </tr>
</table>

<?php 
foreach($res as $row)
{
    echo "<tr>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['password']."</td>";
    echo "<td><a href='modifier.php?id=".$row['id']."'>Modifier</a></td>";
    echo "<td><a href='supprimer.php?id=".$row['id']."'>Supprimer</a></td>";
}




?>
















?>