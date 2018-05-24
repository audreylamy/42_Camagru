<?php
session_start();

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

require('like.class.php');
include('config/database.php');

$_POST = json_decode(file_get_contents('php://input'), true);
$id_photo = $_POST['id_photo'];

//COUNT NB_LIKE
$like = new Like($conn);
$like->getIdPhoto($id_photo);
$nb_like = $like->countNbLike();

echo json_encode($nb_like);

?>