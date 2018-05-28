<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$login = $_POST['login'];
$password = $_POST['password'];

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
			$requete = $conn->prepare("SELECT `id_user` FROM `users` WHERE `username` = :login"); 
			$requete->bindparam(':login', $login);
			$requete->execute();
			$data = $requete->fetch(PDO::FETCH_ASSOC);
		
			$_SESSION['id_user'] = $data['id_user'];
			$_SESSION['login'] = $login;
			$_SESSION['auth'] = TRUE;
			$auth_true = "true";
		}
		else
		{
			$status = "Please activate your email";
		}
	}
	else
	{
		$auth = "Wrong login or password";
	}
}


$array = array('status' => $status, 'auth' => $auth, 'auth_true' => $auth_true);
echo json_encode($array);
?>