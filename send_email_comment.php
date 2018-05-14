<?php
session_start();

require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$comment = $_POST['comment'];
$login_user_picture = $_POST['login_user_picture'];
$image_path = $_POST['image_path'];

//FIND email de la personne a qui appartient la photo
$conn->query( 'USE db_camagru' );
$requete = $conn->query("SELECT `email` FROM `users` WHERE `username` = '$login_user_picture'");
$data = $requete->fetch(PDO::FETCH_ASSOC);
$email = $data['email'];

echo json_encode($email);

//email 
$to = $email;
$subject = 'New comment Camagru';
$message = 'Bonjour '.$login_user_picture.',

Vous avez un nouveau commentaire : '.$comment.'

Pour voir votre nouveau commentaire : http://localhost:8080/index.php';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';
mail($to, $subject, $message, $headers);
header('Location: index.php');

?>