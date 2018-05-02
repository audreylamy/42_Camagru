<?php

$img = $_POST['img1'];
$filter = $_POST['img2'];

$part = explode(',', $img);
// echo $part[1];
$data = base64_decode($part[1]);
echo $data;
file_put_contents('image.png', $data);

 
// Traitement de l'image source
$source = imagecreatefrompng($data);
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
echo $source;
imagealphablending($source, true);
imagesavealpha($source, true);
 
// Traitement de l'image destination
$destination = imagecreatefrompng($img);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
  
// Calcul des coordonnées pour placer l'image source dans l'image de destination
$destination_x = ($largeur_destination - $largeur_source)/2;
$destination_y =  ($hauteur_destination - $hauteur_source)/2;
  
// On place l'image source dans l'image de destination
//imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 100);
imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
 
// On affiche l'image de destination
$hello = imagepng($destination);
echo $hello;
imagedestroy($source);
imagedestroy($destination);
 
?>