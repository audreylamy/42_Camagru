<?php
session_start();

require('like.class.php');
require('image.class.php');
require('comment.class.php');
include('config/database.php');

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

$_POST = json_decode(file_get_contents('php://input'), true);
$id_photo = $_POST['id_photo'];
$id_user = $_SESSION['id_user'];

//FIND IMAGE_PATH de id_photo
$conn->query( 'USE db_camagru' );
$requete = $conn->prepare("SELECT `image_path` FROM `photos` WHERE `id_photo` = :id_photo");
$requete->bindparam(':id_photo', $id_photo);
$requete->execute();
$data = $requete->fetch(PDO::FETCH_ASSOC);
$image_path = $data['image_path'];

//DELETE LIKES de la BDD
$delete_likes = new Like($conn);
$delete_likes->getIdPhoto($id_photo);
$delete_likes->deleteLikesBDD();

//DELETE PHOTO de la BDD
$delete_image = new Picture($conn);
$delete_image->getImagePath($image_path);
$delete_image->getIdPhoto($id_photo);
$delete_image->deletePhotoBDD();

// DELETE COMMENTS de la BDD
$conn->query('USE db_camagru');
$sql = "DELETE FROM `comments` WHERE comments.id_comment IN 
(SELECT `id_comment` FROM `photos_comments` WHERE photos_comments.id_photo = :id_photo)";
$requete = $conn->prepare($sql);
$requete->bindparam(':id_photo', $id_photo);
$requete->execute();

echo json_encode($id_user);

?>