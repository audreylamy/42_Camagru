<?php
session_start();

require('photos_comments.class.php');
require('comment.class.php');
require('image.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_user = $_POST['id_user'];
$comment = $_POST['comment'];
$image_path = $_POST['image_path'];
$image_path = explode("/", $image_path);
$image_path = $image_path[3].'/'.$image_path[4].'/'.urldecode($image_path[5]);


//FIND ID_PHOTO dans BDD PHOTOS
$id_photo = new Picture($conn);
$id_photo->getIdUser($id_user);
$id_photo->getImagePath($image_path);
$id_photo = $id_photo->findIdPhoto();
echo $id_photo;

//ADD COMMENT + ID_USER dans BDD COMMENT
$new_comment = new Comment($conn);
$new_comment->getComment($comment);
$new_comment->getIdUser($id_user);
$new_comment->addComment();

//FIND ID_COMMENT dans BDD COMMENT
$id_comment = $new_comment->findIdComment();
echo $id_comment;

//ADD ID_COMMENT + ID_PHOTO dans BDD PHOTOS_COMMENTS
$intermediate = new PhotosComments($conn);
$intermediate->getIdComment($id_comment);
$intermediate->getIdPhoto($id_photo);
$intermediate->addIntermediateTable();

?>