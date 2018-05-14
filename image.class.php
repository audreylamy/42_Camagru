<?php

class Picture
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getIdPhoto($id_photo)
	{
		$this->id_photo = $id_photo;
		return $this->id_photo;
	}

	public function getIdUser($id_user)
	{
		$this->id_user = $id_user;
		return $this->id_user;
	}

	public function getDate($creation_date)
	{
		$this->creation_date = $creation_date;
		return $this->creation_date;
	}

	public function getImagePath($image_path)
	{
		$this->image_path = $image_path;
		return $this->image_path;
	}

	public function findImagePath_idUser()
	{
		if(!empty($this->id_photo))
		{     
			$id_photo = $this->id_photo;
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->query("SELECT `id_user`, `image_path` FROM `photos` WHERE `id_photo` = '$id_photo'");
			$data = $requete->fetch(PDO::FETCH_ASSOC);
			return array($data['id_user'], $data['image_path']);
		}
		else
		{
			return NULL;
			echo "Error";
		}
	}

	public function findIdPhoto()
	{
		if(!empty($this->image_path))
		{     
			$image_path = $this->image_path;
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->query("SELECT `id_photo` FROM `photos` WHERE `image_path` = '$image_path'");
			$data = $requete->fetch(PDO::FETCH_ASSOC);
			return $data['id_photo'];
		}
		else
		{
			return NULL;
			echo "Error";
		}
	}

	public function addPicture()
	{
		if(!empty($this->id_user) && !empty($this->creation_date) && !empty($this->image_path))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `photos` (`id_user`, `creation_date`, `image_path`) 
			VALUES(:id_user, :creation_date, :image_path)");
			$requete->bindparam(':id_user', $this->id_user);
			$requete->bindparam(':creation_date', $this->creation_date);
			$requete->bindparam(':image_path', $this->image_path);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	
}
?>