<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if ($_POST['first_name'] != NULL && $_POST['last_name'] != NULL && $_POST['email'] != NULL 
&& $_POST['login'] != NULL && $_POST['password'] != NULL && $_POST['confirm_password'] != NULL)
{
	$actual_user = new Membre($conn);

	$actual_user->getProfilPic($_POST['avatar']);
	$actual_user->getIdUser($_SESSION['id_user']);
	$actual_user->getFirstName(htmlspecialchars($_POST['first_name']));
	$actual_user->getLastName(htmlspecialchars($_POST['last_name']));
	$actual_user->getEmail(htmlspecialchars($_POST['email']));
	$actual_user->getLogin(htmlspecialchars($_POST['login']));
	$actual_user->getPassword(hash('whirlpool',htmlspecialchars($_POST['password'])));
	$actual_user->getConfirmPassword(hash('whirlpool',htmlspecialchars($_POST['confirm_password'])));


	if (($_POST['first_name'] != $_SESSION['first_name'] || $_POST['last_name'] != $_SESSION['last_name'] 
	|| $_POST['email'] != $_SESSION['email'] || $_POST['login'] != $_SESSION['login']) 
	&& $_POST['password'] == $_SESSION['password'])
	{
		if ($actual_user->verif_password() === TRUE)
		{
			$actual_user->updateUser();
			$_SESSION['modification'] = TRUE;
			echo "modif done";
		}
		else
		{
			$_SESSION['modification'] = FALSE;
			echo "mauvaise confirmation de mot de passe";
		}
	}
	else if ($_POST['password'] != $_SESSION['password'])
	{
		if ($actual_user->verif_password() === TRUE)
		{
			$actual_user->updateUser();
			echo "modif done";
			$_SESSION['modification'] = TRUE;
			header('Location: profile.php');
		}
		else
		{
			$_SESSION['modification'] = FALSE;
			echo "mauvaise confirmation de mot de passe";
			header('Location: profile.php');
		}
	}
	else
	{
		echo "aucune modification";
		header('Location: profile.php');
	}

}
?>