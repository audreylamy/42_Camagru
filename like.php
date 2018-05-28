<?php
session_start();

require('like.class.php');
require('image.class.php');
include('config/database.php');

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

$_POST = json_decode(file_get_contents('php://input'), true);
$image_path = $_POST['image_path'];
$image_path = explode("/", $image_path);
$image_path = $image_path[3].'/'.$image_path[4].'/'.urldecode($image_path[5]);
$id_user = $_POST['id_user'];

//FIND ID_PHOTO dans BDD PHOTOS
$id_photo = new Picture($conn);
$id_photo->getImagePath($image_path);
$id_photo = $id_photo->findIdPhoto();

// count nb_like par photo en fonction utilisateur
$conn->query('USE db_camagru');
$sql = "SELECT count(*) FROM `likes` 
WHERE id_user = :id_user AND id_photo = :id_photo";
$requete = $conn->prepare($sql);
$requete->bindparam(':id_user', $id_user);
$requete->bindparam(':id_photo', $id_photo);
$requete->execute();
$count= $requete->fetchColumn();

// ADD le like dans BDD LIKES
if ($count === '0')
{
	$like = new Like($conn);
	$like->getIdUser($id_user);
	$like->getIdPhoto($id_photo);
	$like->addLikeBDD();
}

//COUNT nb_like en fonction de l'ID_PHOTO
$like = new Like($conn);
$like->getIdPhoto($id_photo);
$nb_like = $like->countNbLike();

echo json_encode($nb_like);


?>