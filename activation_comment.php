<?php
session_start();

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_user = $_POST['id_user'];

//activate notification
$activate = new Membre($conn);
$activate->getIdUser($id_user);
$activate->ON();

?>