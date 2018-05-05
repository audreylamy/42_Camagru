<?php
// header('Content-Type: image/png');

$data = $_POST['img1'];
$filter = $_POST['img2'];

$type = getimagesizefromstring(explode(',', base64_decode($data)[1], 2));

if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) 
{
    $data = substr($data, strpos($data, ',') + 1);
    $type = strtolower($type[1]);

	if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) 
	{
        $error[] = "invalid image type";
    }

	if($data = base64_decode($data)) 
	{
		$success[] = "base64_decode succeeded";
    }
    else
        $error[] = "base64_decode failed";
} else 
{
    $error[] = "did not match data URI with image data";
}

$target_dir = "uploads/tmp/";

if (!(file_exists($target_dir)))
{
	mkdir('uploads/tmp', 0777, TRUE);
}

$name = date("Y-m-d H:i:s");
$image_path = $target_dir.$name.".".$type;
file_put_contents($image_path, $data);

// Traitement de l'image source (filtre)
$source = imagecreatefrompng($filter);
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);

imagealphablending($source, true);
imagesavealpha($source, true);
 
// Traitement de l'image destination (image de la video)
$destination = imagecreatefrompng($image_path);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
  
// Calcul des coordonnées pour placer l'image source dans l'image de destination
$destination_x = ($largeur_destination - $largeur_source)/2;
$destination_y =  ($hauteur_destination - $hauteur_source)/2;
  
// On place l'image source dans l'image de destination
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
 
// On affiche l'image de destination
$target_dir_final = "uploads/image_final/";

if (!(file_exists($target_dir_final)))
{
	mkdir('uploads/image_final', 0777, TRUE);
}

$name = date("Y-m-d H:i:s");
$filename = $target_dir_final.$name.".png";
imagepng($destination, $filename);
echo $filename;

// On detruit les deux images $source et $destination
imagedestroy($source);
imagedestroy($destination);
 
?>