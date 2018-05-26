
<?php
session_start();

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

require('new_users.class.php');
require('like.class.php');
require('image.class.php');
require('comment.class.php');
include('config/database.php');

$id_user = $_SESSION['id_user'];

//DELETE l'UTILISATEUR
$actual_user = new Membre($conn);
$actual_user->getIdUser($id_user);
$actual_user->deleteProfile();

// //DELETE LIKES de la BDD lors suppression profile
$conn->query('USE db_camagru');
$sql = "DELETE FROM `likes` WHERE likes.id_photo IN 
(SELECT `id_photo` FROM `photos` WHERE photos.id_user = :id_user)";
$delete_likes = $conn->prepare($sql);
$delete_likes->bindparam(':id_user', $id_user);
$delete_likes->execute();

// DELETE COMMENTS de la BDD lors suppression profile
$conn->query('USE db_camagru');
$sql = "DELETE FROM `comments` WHERE id_user = :id_user"; 
$requete = $conn->prepare($sql);
$requete->bindparam(':id_user', $id_user);
$requete->execute();

//DELETE PHOTOS user delete lors suppression profile
$photos_delete = new Picture($conn);
$photos_delete->getIdUser($id_user);
$photos_delete->deletePhotosUser();

header('Location: index.php');
session_destroy();
?>