<?php
session_start();
include('config/database.php');
require('new_users.class.php');

$login = $_POST['login'];
$password = hash('whirlpool',htmlspecialchars($_POST['password']));
$confirm_password = hash('whirlpool',htmlspecialchars($_POST['confirm_password']));

if ($password != NULL && $confirm_password != NULL)
{
	$membre = new Membre($conn);
	$membre->getPassword($password);
	$membre->getConfirmPassword($confirm_password);
	$membre->getLogin($login);

	if ($membre->verif_password() === TRUE)
	{
		$membre->resetPassword();

		echo "mdp modifie";
		header('Location: index.php');
		$_SESSION['mdp_reset'] = TRUE;
	}
	else
	{
		echo "mdp pas modifie";
	}
}
?>