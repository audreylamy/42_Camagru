<?php

class PhotosComments
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getIdComment($id_comment)
	{
		$this->id_comment = $id_comment;
		echo $this->getIdComment;
		return $this->id_comment;
	}

	public function getIdPhoto($id_photo)
	{
		$this->id_photo = $id_photo;
		echo $this->getIdPhoto;
		return $this->id_photo;
	}

	public function addIntermediateTable()
	{
		if(!empty($this->id_comment) && !empty($this->id_photo))
		{    
			// echo $this->id_comment;
			// echo $this->id_photo;
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `photos_comments` (`id_comment`, `id_photo`) 
			VALUES(:id_comment, :id_photo)");
			$requete->bindparam(':id_comment', $this->id_comment);
			$requete->bindparam(':id_photo', $this->id_photo);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function deletePhotoUser()
	{
		$this->db->query( 'USE db_camagru' );
		$requete = $this->db->prepare("DELETE FROM `photos` WHERE `id_user` = '$this->id_user'");
		$requete->execute();
	}
}
?>