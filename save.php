<?php
session_start();
require('image.class.php');
include('config/database.php');

$picture_save = 0;

$data = $_POST['image'];
$image_bis = explode(',', $data);

$id_user = $_SESSION['id_user'];

$target_dir = "uploads/gallery/";

if (!(file_exists($target_dir)))
{
	mkdir('uploads/gallery', 0777, TRUE);
	echo "create 'gallery'";
}
else
{
	echo "existe";
}

$date = date("Y-m-d H:i:s");
$name = date("Y-m-d H:i:s");
$pos  = strpos($data, ';');
$type = explode(':', substr($data, 0, $pos))[1];
$type = explode('/', $type)[1];

if (isset($date) && isset($name) && isset($type))
{
	if($type != "jpg" && $type != "png" && $type != "jpeg"
	&& $type != "gif" ) 
	{
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$picture_save = 0;
	}
	else
	{
		$image_path = $target_dir.$name.".".$type;
		$image_decode = base64_decode($image_bis[1]);
		file_put_contents($image_path, $image_decode);
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