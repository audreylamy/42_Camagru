<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);

if (strlen($_POST['first_name']) < 15 && strlen($_POST['first_name']) >= 1) 
{
	$first_name = $_POST['first_name'];
}
else
{
	$error_first_name = "Your first-name is incorrect";
}

if (strlen($_POST['last_name']) < 15 && strlen($_POST['last_name']) >= 1)
{
	$last_name = $_POST['last_name'];
}
else
{
	$error_last_name = "Your last-name is incorrect";
}

if (strlen($_POST['login']) < 15 && strlen($_POST['login']) >= 1)
{
	$login = $_POST['login'];
}
else
{
	$error_login = "Your login is incorrect";
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
	$email = $_POST['email'];
}
else
{
	$error_email = "Your email is incorrect";
}

/* minimum 1 lettre minuscule, minimum 1 lettre majuscule, minimum un chiffre, minimum 6 caracteres */
if (preg_match("#(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#", $_POST['password']))
{
	$password = htmlspecialchars($_POST['password']);
}
else
{
	$error_password = "Your password is not secure";
}

if (preg_match("#(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#", $_POST['confirm_password']))
{
	$confirm_password = htmlspecialchars($_POST['confirm_password']);
}
else
{
	$error_confirm_password = "Your password not match";
}

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
			$true_connect = "Confirm your email";

			$membre->ajouterMembre();

			$to = $email;
			$subject = 'Confirmer votre inscription';
			$message = 'Welcome to Camagru,
			
			Hello '.$first_name.',
		  	To activate your account, please click on the link below.
			
		  	http://localhost:8080/activation.php?login='.urlencode($login).'&token='.urlencode($token).'
		   	---------------
		   	This is an automatic mail, Please do not reply.';

		   	$headers  = 'MIME-Version: 1.0' . "\r\n";
		   	$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
		   	$headers .='Content-Transfer-Encoding: 8bit';
			mail($to, $subject, $message, $headers);
		}
		else
		{
			$error_verif_password = "Your password not match";
		}
	}
	else
	{
		$error_connect = "login or email already exists";
	}
}
else
{
	// echo 'donnees manquantes';
}

$array = array('error_first_name' => $error_first_name, 'error_last_name' => $error_last_name, 'error_login' => $error_login,
'error_email' => $error_email, 'error_password' => $error_password, 'error_confirm_password' => $error_confirm_password,
'true_connect' => $true_connect, 'error_verif_password', $error_verif_password, 'error_connect' => $error_connect);
echo json_encode($array);
?>