<?php
session_start();
include('config/database.php');
require('new_users.class.php');

// Récupération des variables nécessaires à l'activation
$login = $_GET['login'];
$cle = $_GET['token'];
//  echo $cle;
// Récupération de la clé correspondant au $login dans la base de données
$conn->query( 'USE db_camagru' );
$requete = $conn->query("SELECT `token`, `status` FROM `users` WHERE `username` = '$login'");
$data = $requete->fetch(PDO::FETCH_ASSOC);
$clebdd = $data['token'];	// Récupération de la clé
$status = $data['status']; // $actif contiendra alors 0 ou 1
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($status == '1') // Si le compte est déjà actif on prévient
{
    echo "Votre compte est déjà actif !";
    $_SESSION['activate_already'] = TRUE;
    header('Location: activation_page.php');
}
else // Si ce n'est pas le cas on passe aux comparaisons
{
    if($cle == $clebdd) // On compare nos deux clés	
    {
        // Si elles correspondent on active le compte !	
        echo "Votre compte a bien été activé !";
        $_SESSION['activate_account'] = TRUE;
        header('Location: activation_page.php');
 
        // La requête qui va passer notre champ actif de 0 à 1
		$update_status = $conn->prepare("UPDATE `users` SET `status` = 1 WHERE `username` like :login ");
        $update_status->bindParam(':login', $login);
		$update_status->execute();
    }
    else // Si les deux clés sont différentes on provoque une erreur...
    {
        echo "Erreur ! Votre compte ne peut être activé...";
        $_SESSION['activate_account'] = FALSE;
        header('Location: activation_page.php');
    }
}
?>