<?php
session_start();

require('new_users.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_user = $_POST['id_user'];

//desactivate notification
$activate = new Membre($conn);
$activate->getIdUser($id_user);
$activate->OFF();

?>