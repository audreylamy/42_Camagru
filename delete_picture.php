<?php
session_start();

require('image.class.php');
require('comment.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_photo = $_POST['id_photo'];

//FIND IMAGE_PATH de id_photo
$conn->query( 'USE db_camagru' );
$requete = $conn->query("SELECT `image_path` FROM `photos` WHERE `id_photo` = '$id_photo'");
$data = $requete->fetch(PDO::FETCH_ASSOC);
$image_path = $data['image_path'];

//DELETE PHOTO de la BDD
$delete_image = new Picture($conn);
$delete_image->getImagePath($image_path);
$delete_image->getIdPhoto($id_photo);
$delete_image->deletePhotoBDD();

//DELETE COMMENTS de la BDD
// $conn->query('USE db_camagru');
// $sql = "DELETE * FROM `comments` 
// INNER JOIN photos_comments ON photos_comments.id_photo = comment.id_photo
// INNER JOIN comments ON photos_comments.id_comment = comments.id_comment
// WHERE photo_comments = :id_photo";

// $requete = $conn->prepare($sql);
// $requete->bindparam(':id_photo', $id_photo);
// $requete->execute();

echo json_encode($image_path);

?>