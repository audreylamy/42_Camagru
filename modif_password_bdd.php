<?php
session_start();
include('config/database.php');
require('new_users.class.php');

$login = $_POST['login'];

if (preg_match("#(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*#", htmlspecialchars($_POST['password'])))
{
	$password = hash('whirlpool', $_POST['password']);
}
else
{
	$_SESSION['regex_new'] = FALSE;
	header('Location: page_reset.php');
}

if (preg_match("#(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*#", htmlspecialchars($_POST['confirm_password'])))
{
	$confirm_password = hash('whirlpool', $_POST['confirm_password']);
}
else
{
	$_SESSION['regex_new'] = FALSE;
	header('Location: page_reset.php');
}

if ($password != NULL && $confirm_password != NULL)
{
	$membre = new Membre($conn);

	$membre->getPassword($password);
	$membre->getConfirmPassword($confirm_password);
	$membre->getLogin($login);

	if ($membre->verif_password() === TRUE)
	{
		$membre->resetPassword();
		header('Location: index.php');
		echo "mdp modifie";
		$_SESSION['mdp_reset'] = TRUE;
	}
	else
	{
		echo "mdp pas modifie";
	}
}
?>