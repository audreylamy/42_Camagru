<?php
session_start();
include('config/database.php');
require('new_users.class.php');

if ($_GET['login'] === NULL)
{
	header('Location: index.php');
}

// Récupération des variables nécessaires à l'activation
$login = $_GET['login'];
$cle = $_GET['token'];

$conn->query( 'USE db_camagru' );
$requete = $conn->prepare("SELECT `token_reset` FROM `users` WHERE `username` = :login");
$requete->bindparam(':login', $login);
$requete->execute();
$data = $requete->fetch(PDO::FETCH_ASSOC);
$clebdd = $data['token_reset'];	// Récupération de la clé

if($cle == $clebdd) // On compare nos deux clés	
{
	header('Location: page_reset.php?login='.urlencode($login));
}
else 
{
	echo "Erreur ! token sont differents";
}
?>