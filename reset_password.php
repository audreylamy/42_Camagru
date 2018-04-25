<?php
session_start();
include('config/database.php');
require('new_users.class.php');

// Récupération des variables nécessaires à l'activation
$login = $_GET['login'];
$cle = $_GET['token'];
echo $cle;

$conn->query( 'USE db_camagru' );
$requete = $conn->query("SELECT `token_reset` FROM `users` WHERE `username` = '$login'");
$data = $requete->fetch(PDO::FETCH_ASSOC);
$clebdd = $data['token_reset'];	// Récupération de la clé

echo $clebdd;

if($cle == $clebdd) // On compare nos deux clés	
{
	
	header('Location: page_reset.php?login='.urlencode($login));
}
else 
{
	echo "Erreur ! token sont differents";
}
?>