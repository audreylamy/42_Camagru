<?php

class Picture
{
	private $db;
	
	function __construct($conn)
	{
		$this->db = $conn;
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