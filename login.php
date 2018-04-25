<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if($_POST['login'] != NULL && $_POST['password'] != NULL)
{
	$login = htmlspecialchars($_POST['login']);
	$password = hash('whirlpool',htmlspecialchars($_POST['password']));

	$conn->query( 'USE db_camagru' );
	$requete = $conn->query("SELECT `id_user` FROM `users` WHERE `username` = '$login'"); 
	$data = $requete->fetch(PDO::FETCH_ASSOC);

	$_SESSION['id_user'] = $data['id_user'];

	$membre = new Membre($conn);
	$membre->getLogin($login);
	$membre->getPassword($password);

	if (($membre->status()) === TRUE)
	{
		if (($membre->authentification()) === TRUE)
		{
			echo "Vous etes connectes";
			header('Location: index.php');
			$_SESSION['login'] = $login;
			$_SESSION['auth'] = TRUE;
		}
		else
		{
			echo "Vous avez entre un mauvais login ou mdp";
			header('Location: index.php');
			$_SESSION['auth'] = FALSE;
		}
	}
	else
	{
		echo "Votre mail n'est pas actif";
		header('Location: index.php');
		$_SESSION['status'] = FALSE;
	}
}
?>