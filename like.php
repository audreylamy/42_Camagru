<?php
session_start();

require('like.class.php');
require('image.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$image_path = $_POST['image_path'];
$image_path = explode("/", $image_path);
$image_path = $image_path[3].'/'.$image_path[4].'/'.urldecode($image_path[5]);

//FIND ID_PHOTO dans BDD PHOTOS
$id_photo = new Picture($conn);
$id_photo->getImagePath($image_path);
$id_photo = $id_photo->findIdPhoto();

//ADD le like dans BDD LIKES
$like = new Like($conn);
$like->getIdPhoto($id_photo);
$like->addLikeBDD();

//COUNT nb_like en fonction de l'ID_PHOTO
$nb_like = $like->countNbLike();

echo json_encode($nb_like);

?>