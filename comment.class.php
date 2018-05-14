<?php

class Comment
{
	private $db;

	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getIdComment($id_comment)
	{
		$this->id_comment = $id_comment;
		return $this->id_comment;
	}

	public function getIdUser($id_user)
	{
		$this->id_user = $id_user;
		return $this->id_user;
	}

	public function getComment($comment)
	{
		$this->comment = $comment;
		return $this->comment;
	}

	public function getCreationDate($creation_date)
	{
		$this->creation_date = $creation_date;
		return $this->creation_date;
	}

	public function addComment()
	{
		if(!empty($this->id_user) && !empty($this->comment) && !empty($this->creation_date))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `Comments` (`id_user`, `comment`, `creation_date`) 
			VALUES(:id_user, :comment, :creation_date)");
			$requete->bindparam(':id_user', $this->id_user);
			$requete->bindparam(':comment', $this->comment);
			$requete->bindparam(':creation_date', $this->creation_date);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function findIdComment()
	{
		if(!empty($this->id_user) && !empty($this->comment))
		{     
			$id_user = $this->id_user;
			$comment = $this->comment;
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->query("SELECT `id_comment` FROM `comments` WHERE `id_user` = '$id_user' AND `comment` = '$comment'");
			$data = $requete->fetch(PDO::FETCH_ASSOC);
			return $data['id_comment'];
		}
		else
		{
			return NULL;
			echo "Error";
		}
	}
}
?>