<?php
session_start();

require('image.class.php');
require('comment.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_photo = $_POST['id_photo'];

//FIND IMAGE_PATH de id_photo
$conn->query( 'USE db_camagru' );
$requete = $conn->prepare("SELECT `image_path` FROM `photos` WHERE `id_photo` = :id_photo");
$requete->bindparam(':id_photo', $id_photo);
$requete->execute();
$data = $requete->fetch(PDO::FETCH_ASSOC);
$image_path = $data['image_path'];

//DELETE PHOTO de la BDD
$delete_image = new Picture($conn);
$delete_image->getImagePath($image_path);
$delete_image->getIdPhoto($id_photo);
$delete_image->deletePhotoBDD();

//DELETE COMMENTS de la BDD
// $conn->query('USE db_camagru');
// $sql = "DELETE `comments`, `photos_comments` FROM `comments` 
// INNER JOIN `photos_comments` ON comments.id_photo = photos_comments.id_photo
// WHERE photo_comments.id_photo = :id_photo";


// "DELETE * FROM `comments` 
// WHERE comments.id_photo IN
// 	(SELECT id_photo FROM `photo_comments` WHERE photo_comments.id_photo = :id_photo)";

// $requete = $conn->prepare($sql);
// $requete->bindparam(':id_photo', $id_photo);
// $requete->execute();
// if ($comments = $requete->fetchAll(PDO::FETCH_ASSOC)) 
// {
// 	$success = "data retrieve";
// }
// else
// {
// 	$error = "failed to retrieve data";
// }

echo json_encode($error);

?>