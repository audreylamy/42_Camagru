<?php

class Like
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getIdLike($id_like)
	{
		$this->id_like = $id_like;
		return $this->id_like;
	}

	public function getIdUser($id_user)
	{
		$this->id_user = $id_user;
		return $this->id_user;
	}

	public function getIdPhoto($id_photo)
	{
		$this->id_photo = $id_photo;
		return $this->id_photo;
	}

	public function addLikeBDD()
	{
		if(!empty($this->id_photo))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `likes` (`id_user`, `id_photo`) 
			VALUES(:id_user, :id_photo)");
			$requete->bindparam(':id_user', $this->id_user);
			$requete->bindparam(':id_photo', $this->id_photo);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function countNbLike()
	{
		if(!empty($this->id_photo))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("SELECT count(`id_like`) from `likes` WHERE `id_photo` = :id_photo");
			$requete->bindparam(':id_photo', $this->id_photo);
			$requete->execute();
			$data = $requete->fetchColumn();
			return $data;
		}
		else
		{
			echo "Error";
		}
	}

	public function countNbLikeTotal()
	{
		$this->db->query( 'USE db_camagru' );
		$requete = $this->db->prepare("SELECT count(`id_like`) from `likes`");
		$requete->execute();
		$data = $requete->fetchColumn();
		return $data;
	}

	public function deleteLikesBDD()
	{
		$this->db->query('USE db_camagru');
		$requete = $this->db->prepare("DELETE FROM `likes` WHERE `id_photo` = :id_photo");
		$requete->bindparam(':id_photo', $this->id_photo);
		$requete->execute();
	}
}
?>