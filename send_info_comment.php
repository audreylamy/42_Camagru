<?php
session_start();

include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$email = $_POST['email'];
$activation_comment = $_POST['activation_comment'];
$login_user_picture = $_POST['login_user_picture'];
$comment = $_POST['comment'];

//email 
if ($activation_comment == '1')
{
	echo json_encode("here");
	$to = $email;
	$subject = 'New comment Camagru';
	$message = 'Bonjour '.$login_user_picture.',

	Vous avez un nouveau commentaire : '.$comment.'

	Pour voir votre nouveau commentaire : http://localhost:8080/index.php';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	mail($to, $subject, $message, $headers);
}

?>