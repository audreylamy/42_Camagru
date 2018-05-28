<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if($_POST['email_reset'] != NULL )
{
	$email = $_POST['email_reset'];
	$conn->query( 'USE db_camagru' );
	$requete = $conn->prepare("SELECT `username`, `status` FROM `users` WHERE `email` = :email");
	$requete->bindparam(':email', $email);
	$requete->execute();
	$data = $requete->fetch(PDO::FETCH_ASSOC);
	$login = $data['username'];
	$status = $data['status'];

	$membre = new Membre($conn);
	$membre->getEmail($email);

	if ($membre->emailBdd() === TRUE)
	{
		if ($status === "1")
		{
			$token_reset = bin2hex(random_bytes(16));

			//insertion du token dans l'utilisateur qui contient le mail envoye pour reset le password
			$update_status = $conn->prepare("UPDATE `users` SET `token_reset` = :token_reset WHERE `email` = :email");
			$update_status->bindparam(':token_reset', $token_reset);
			$update_status->bindparam(':email', $email);
			$update_status->execute();

			$to = $email;
			$subject = 'Reset your password';
			$message = 'Hello '.$login.',

			To reset your password, please click on the link below.
		
			http://localhost:8080/reset_password.php?login='.urlencode($login).'&token='.urlencode($token_reset).'
			---------------
			This is an automatic mail, please do not reply.';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
			$headers .='Content-Transfer-Encoding: 8bit';
			mail($to, $subject, $message, $headers);
			header('Location: index.php');
			$_SESSION['transfert_email'] = TRUE;
		}
		else
		{
			$_SESSION['status_forgot'] = FALSE;
			header('Location: index.php');
		}				
	}
	else
	{
		$_SESSION['email_bdd'] = FALSE;
		header('Location: index.php');
	}
}
?>