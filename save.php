<?php
session_start();
require('image.class.php');
include('config/database.php');

// envoie photo camera dans gallery puis sauvegarde dans la BDD

$picture_save = 0;

$data = $_POST['target'];

$id_user = $_SESSION['id_user'];
echo $id_user;

$target_dir = "uploads/gallery/";

if (!(file_exists($target_dir)))
{
	mkdir('uploads/gallery', 0777, TRUE);
}

$date = date("Y-m-d H:i:s");
$name = date("Y-m-d H:i:s");
$image_bis = explode('/', $data);
$type = explode('.', $image_bis[2]);

if (isset($date) && isset($name) && isset($type[1]))
{
	if($type[1] != "jpg" && $type[1] != "png" && $type[1] != "jpeg"
	&& $type[1] != "gif" ) 
	{
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$picture_save = 0;
	}
	else
	{
		$image_path = $target_dir.$name.".".$type[1];
		copy($data, $image_path);
		$picture_save = 1;
	}
}

if ($picture_save === 1)
{
	$actual_picture = new Picture($conn);

	$actual_picture->getIdUser($id_user);
	$actual_picture->getDate($date);
	$actual_picture->getImagePath($image_path);

	$actual_picture->addPicture();
	header('Location: users.php');
	echo "ajouter dans la BDD";
}
else
{
	echo "cette image n'a pas pu etre sauvegardée dans la BDD";
}
?>