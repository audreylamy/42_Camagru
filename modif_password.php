<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$id_user = $_SESSION['id_user'];
$conn->query( 'USE db_camagru' );
$requete = $conn->query("SELECT `password` FROM `users` WHERE `id_user` = '$id_user'");
$data = $requete->fetch(PDO::FETCH_ASSOC);

$current_password = hash('whirlpool',htmlspecialchars($_POST['password']));
$new_password = hash('whirlpool',htmlspecialchars($_POST['new_password']));
$confirm_new_password = hash('whirlpool',htmlspecialchars($_POST['confirm_new_password']));

if ($current_password != NULL && $new_password != NULL && $confirm_new_password != NULL)
{
	if ($data['password'] === $current_password)
	{
		$actual_user = new Membre($conn);

		$actual_user->getIdUser($id_user);
		$actual_user->getPassword($current_password);
		$actual_user->getNewPassword($new_password);
		$actual_user->getConfirmNewPassword($confirm_new_password);

		if ($actual_user->verif_new_password() === TRUE)
		{
			$actual_user->updatePassword();
			echo "password_modifier";
			$_SESSION['password_modif'] = TRUE;
			header('Location: profile.php');
		}
		else
		{
			echo "error / mauvaise modif";
			$_SESSION['password_modif'] = FALSE;
			header('Location: profile.php');
		}
	}
	else
	{
		echo "error pas le current password";
		$_SESSION['password_error'] = TRUE;
		header('Location: profile.php');
	}
}
?>