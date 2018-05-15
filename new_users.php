<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($first_name != NULL && $last_name != NULL && $email != NULL && $login != NULL && $password != NULL && $confirm_password != NULL)
{
	$password = hash('whirlpool',htmlspecialchars($password));
	$confirm_password = hash('whirlpool',htmlspecialchars($confirm_password));
	$token = bin2hex(random_bytes(16));

	// echo json_encode($confirm_password);

	$membre = new Membre($conn);
	$membre->getFirstName($first_name);
	$membre->getLastName($last_name);
	$membre->getEmail($email);
	$membre->getLogin($login);
	$membre->getPassword($password);
	$membre->getConfirmPassword($confirm_password);
	$membre->getConfirmToken($token);

	if (($membre->verif_bdd_login()) === FALSE && ($membre->verif_bdd_email()) === FALSE)
	{
		if (($membre->verif_password()) === TRUE)
		{
			$_SESSION['connect'] = TRUE;
			$_SESSION['verif_password'] = TRUE;

			$membre->ajouterMembre();
			header('Location: index.php');

			$to = $email;
			$subject = 'Confirmer votre inscription';
			$message = 'Bienvenue sur Camagru,
			
			Bonjour '.$first_name.',
		  	Pour activer votre compte, veuillez cliquer sur le lien ci dessous.
			
		  	http://localhost:8080/activation.php?login='.urlencode($login).'&token='.urlencode($token).'
		   	---------------
		   	Ceci est un mail automatique, Merci de ne pas y répondre.';

		   	$headers  = 'MIME-Version: 1.0' . "\r\n";
		   	$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
		   	$headers .='Content-Transfer-Encoding: 8bit';
			mail($to, $subject, $message, $headers);
		}
		else
		{
			// echo "password isn't correct";
			header('Location: index.php');
			$_SESSION['verif_password'] = FALSE;
		}
	}
	else
	{
		// echo "This users already exist";
		header('Location: index.php');
		$_SESSION['connect'] = FALSE;
	}
}
else
{
	// echo 'donnees manquantes';
}

?>