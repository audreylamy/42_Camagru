<?php
session_start();
require('new_users.class.php');
include('config/database.php');

$image = $_POST['image'];
$image_bis = explode(',', $image);

$id_user = $_SESSION['id_user'];

$date = date("d-m-Y H:i");

$name = "hello.png";

base64_decode($image);

$actual_picture = new Picture;

$actual_picture->getIdUser($id_user);
$actual_picture->getName($name);
$actual_picture->getName($date);
?>