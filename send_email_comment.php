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
$requete = $conn->query("SELECT `email`, `activation_comment` FROM `users` WHERE `username` = '$login_user_picture'");
$data = $requete->fetch(PDO::FETCH_ASSOC);
$email = $data['email'];
$activation_comment = $data['activation_comment'];

$array = array('email' => $email, 'activation_comment' => $activation_comment);

echo json_encode($array);


?>