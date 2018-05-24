<?php
	session_start();

	if ($_SESSION['login'] === NULL)
	{
		header('Location: index.php');
	}

	include('config/database.php');

	$_POST = json_decode(file_get_contents('php://input'), true);
	$id_photo = $_POST['id_photo'];

	// on recupere les infos de toutes les tables cités ci-dessous en fonction de id_photo que l'on souhaite
	$conn->query('USE db_camagru');
	$sql = "SELECT * FROM photos 
    RIGHT JOIN photos_comments ON photos_comments.id_photo = photos.id_photo
    INNER JOIN comments ON photos_comments.id_comment = comments.id_comment
    INNER JOIN users ON users.id_user = comments.id_user
	WHERE photos.id_photo = :id_photo
	ORDER BY comments.creation_date ASC";
	
	$requete = $conn->prepare($sql);
	$requete->bindparam(':id_photo', $id_photo);
	$requete->execute();
	if ($comments = $requete->fetchAll(PDO::FETCH_ASSOC)) 
	{
		$success = "data retrieve";
	}
	else
	{
		$error = "failed to retrieve data";
	}

$array = $comments;
echo json_encode($array);

?>