<?php
session_start();

require('new_users.class.php');
include('config/database.php');

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

$target_file = $target_dir . basename($_FILES["avatar"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

echo $imageFileType;
// Check if image file is a actual image or fake image
if (isset($_POST["submit_picture"])) 
{
	$check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) 
    {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
	} 
	else 
	{
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) 
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else 
{
	$name = date("Y-m-d H:i:s");
    $target_file = $target_dir.$name.".".$imageFileType;
	if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) 
	{
		echo "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.";
		$_SESSION['upload'] = TRUE;
		$_SESSION['target'] = $target_file;
        header("Location: users.php?upload=TRUE&target=$target_file");
	} 
	else 
	{
        echo "Sorry, there was an error uploading your file.";
    }
}
?>