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
	
	public function getName($name)
	{
		$this->name = $name;
		return $this->name;
	}

	public function getDate($date)
	{
		$this->date = $date;
		return $this->date;
	}
}
?>