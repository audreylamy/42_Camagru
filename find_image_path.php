<?php
session_start();

require('image.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_photo = $_POST['id'];

$picture = new Picture($conn);
$picture->getIdPhoto($id_photo);
$array = $picture->findImagePath_idUser();
echo json_encode($array);
?>