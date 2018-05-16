<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$login = $_POST['login'];
$password = $_POST['password'];

// echo json_encode($password);

if ($login != NULL && $password != NULL)
{
	$password = hash('whirlpool', htmlspecialchars($password));

	$membre = new Membre($conn);
	$membre->getLogin($login);
	$membre->getPassword($password);

	if (($membre->authentification()) === TRUE)
	{
		if (($membre->status()) === TRUE)
		{
			$conn->query( 'USE db_camagru' );
			$requete = $conn->query("SELECT `id_user` FROM `users` WHERE `username` = '$login'"); 
			$data = $requete->fetch(PDO::FETCH_ASSOC);
		
			$_SESSION['id_user'] = $data['id_user'];
			echo json_encode("Vous etes connectes");
			// header('Location: index.php');
			$_SESSION['login'] = $login;
			$_SESSION['auth'] = TRUE;
		}
		else
		{
			// echo "Votre mail n'est pas actif";
			// header('Location: index.php');
			$_SESSION['status'] = FALSE;
		}
	}
	else
	{
		// echo "Vous avez entre un mauvais login ou mdp";
		// header('Location: index.php');
		$_SESSION['auth'] = FALSE;
	}
}
?>