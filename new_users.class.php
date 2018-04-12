<?php
	
class Membre
{
	private $db;
	
	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getFirstName($first_name)
	{
		$this->first_name = $first_name;
		return $this->first_name;
	}

	public function getLastName($last_name)
	{
		$this->last_name = $last_name;
		return $this->last_name;
	}

	public function getEmail($email)
	{
		$this->email = $email;
		return $this->email;
	}

	public function getLogin($login)
	{
		$this->login = $login;
		return $this->login;
	}

	public function getPassword($password)
	{
		$this->password = $password;
		return $this->password;
	}

	public function getConfirmPassword($confirm_password)
	{
		$this->confirm_password = $confirm_password;
		return $this->confirm_password;
	}

	public function verif_bdd_login()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_login = $this->db->query("SELECT `username` FROM `users`"); 
		while ($data = $requete_login->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['username'] === $this->login)
			{
				return TRUE;
			}
		}
		return FALSE;
	}
	
	public function verif_bdd_email()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_email = $this->db->query("SELECT `email` FROM `users`");
		while ($data = $requete_email->fetch(PDO::FETCH_ASSOC))
		{
			echo "hello";
			if ($data['email'] === $this->email)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function ajouterMembre()
	{
		if(!empty($this->first_name) && !empty($this->last_name) && !empty($this->email) && !empty($this->login) 
		&& !empty($this->password) && !empty($this->confirm_password))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `users` (`username`, `first_name`, `last_name`, `password`, `email`) 
			VALUES(:login, :first_name, :last_name, :password, :email)");
			$requete->bindparam(':login', $this->login);
			$requete->bindparam(':first_name', $this->first_name);
			$requete->bindparam(':last_name', $this->last_name);
			$requete->bindparam(':password', $this->password);
			$requete->bindparam(':email', $this->email);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}
}
?>