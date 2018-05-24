<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

if($_POST['email_reset'] != NULL )
{
	$email = $_POST['email_reset'];
	$conn->query( 'USE db_camagru' );
	$requete = $conn->prepare("SELECT `username` FROM `users` WHERE `email` = :email");
	$requete->bindparam(':email', $email);
	$requete->execute();
	$data = $requete->fetch(PDO::FETCH_ASSOC);
	$login = $data['username'];

	$membre = new Membre($conn);
	$membre->getEmail($email);

	if ($membre->emailBdd() === TRUE)
	{
		$token_reset = bin2hex(random_bytes(16));

		//insertion du token dans l'utilisateur qui contient le mail envoye pour reset le password
		$update_status = $conn->prepare("UPDATE `users` SET `token_reset` = :token_reset WHERE `email` = :email");
		$update_status->bindparam(':token_reset', $token_reset);
		$update_status->bindparam(':email', $email);
		$update_status->execute();

		$to = $email;
		$subject = 'Reset your password';
		$message = 'Bonjour '.$login.',

		Pour reset votre mot de passe, veuillez cliquer sur le lien ci dessous.
		
		http://localhost:8080/reset_password.php?login='.urlencode($login).'&token='.urlencode($token_reset).'
		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
		$headers .='Content-Transfer-Encoding: 8bit';
		mail($to, $subject, $message, $headers);
		header('Location: index.php');
		$_SESSION['transfert_email'] = TRUE;
		echo "email envoyé";
	}
	else
	{
		echo "error / email pas dans la bdd";
	}
}
?>