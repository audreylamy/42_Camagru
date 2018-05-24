<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

$id_user = $_SESSION['id_user'];
$conn->query( 'USE db_camagru' );
$requete = $conn->prepare("SELECT `password` FROM `users` WHERE `id_user` = :id_user");
$requete->bindparam(':id_user', $id_user);
$requete->execute();
$data = $requete->fetch(PDO::FETCH_ASSOC);

$current_password = hash('whirlpool',htmlspecialchars($_POST['password']));

if ($_POST['first_name'] != NULL && $_POST['last_name'] != NULL && $_POST['email'] != NULL 
&& $_POST['login'] != NULL && $_POST['password'] != NULL && $_POST['confirm_password'] != NULL)
{
	if ($data['password'] === $current_password)
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

		if ($_POST['first_name'] != $_SESSION['first_name'] || $_POST['last_name'] != $_SESSION['last_name'] 
		|| $_POST['email'] != $_SESSION['email'] || $_POST['login'] != $_SESSION['login'])
		{
			if ($actual_user->verif_password() === TRUE)
			{
				$actual_user->updateUser();
				echo "modification done";
				$_SESSION['modification'] = TRUE;
				header('Location: profile.php');
			}
			else
			{
				echo "mauvaise confirmation de mot de passe";
				$_SESSION['wrong_confirm'] = TRUE;
				header('Location: profile.php');
			}
		}
		else
		{
			echo "aucune modification";
			$_SESSION['modification'] = FALSE;
			header('Location: profile.php');
		}
	}
	else
	{
		echo "mauvais mot de passe";
		$_SESSION['wrong_password'] = TRUE;
		header('Location: profile.php');
	}

}
?>