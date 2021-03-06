<?php
	
class Membre
{
	private $db;
	
	function __construct($conn)
	{
		$this->db = $conn;
	}

	public function getProfilPic($profile_pic)
	{
		$this->profile_pic = $profile_pic;
		echo $this->profile_pic;
		return $this->profile_pic;
	}

	public function getIdUser($id_user)
	{
		$this->id_user = $id_user;
		return $this->id_user;
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

	public function getNewPassword($new_password)
	{
		$this->new_password = $new_password;
		return $this->new_password;
	}

	public function getConfirmNewPassword($confirm_new_password)
	{
		$this->confirm_new_password = $confirm_new_password;
		return $this->confirm_new_password;
	}

	public function getConfirmToken($token)
	{
		$this->token = $token;
		return $this->token;
	}

	public function verif_bdd_login()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_login = $this->db->prepare("SELECT `username` FROM `users`"); 
		$requete_login->execute();
		while ($data = $requete_login->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['username'] === $this->login)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function verif_bdd_login2()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_login = $this->db->prepare("SELECT `username` FROM `users`
		WHERE id_user != :id_user"); 
		$requete_login->bindparam(':id_user', $this->id_user);
		$requete_login->execute();
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
		$requete_email = $this->db->prepare("SELECT `email` FROM `users`");
		$requete_email->execute();
		while ($data = $requete_email->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['email'] === $this->email)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function verif_bdd_email2()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_email = $this->db->prepare("SELECT `email` FROM `users`
		WHERE id_user != :id_user");
		$requete_email->bindparam(':id_user', $this->id_user);
		$requete_email->execute();
		while ($data = $requete_email->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['email'] === $this->email)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function status()
	{
		$this->db->query( 'USE db_camagru' );
		$login = $this->login;
		$requete_status = $this->db->prepare("SELECT `status` FROM `users` WHERE `username` = :login");
		$requete_status->bindparam(':login', $login);
		$requete_status->execute();
		$data = $requete_status->fetch(PDO::FETCH_ASSOC);
		if ($data['status'] === '1')
		{
			return TRUE;
		}
		else if ($data['status'] === '0')
		{
			return FALSE;
		}
	}

	public function authentification()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_auth = $this->db->prepare("SELECT `username`, `password` FROM `users`");
		$requete_auth->execute();
		while ($data = $requete_auth->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['password'] === $this->password && $data['username'] === $this->login)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function emailBdd()
	{
		$this->db->query( 'USE db_camagru' );
		$requete_email = $this->db->prepare("SELECT `email` FROM `users`");
		$requete_email->execute();
		while ($data = $requete_email->fetch(PDO::FETCH_ASSOC))
		{
			if ($data['email'] === $this->email)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function verif_password()
	{
		if ($this->password == $this->confirm_password)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function verif_new_password()
	{
		echo "here";
		if ($this->new_password == $this->confirm_new_password)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function ajouterMembre()
	{
		if(!empty($this->first_name) && !empty($this->last_name) && !empty($this->email) && !empty($this->login) 
		&& !empty($this->password) && !empty($this->confirm_password) && !empty($this->token))
		{     
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("INSERT INTO `users` (`username`, `first_name`, `last_name`, `password`, `email`, `profile_pic`, `token`) 
			VALUES(:login, :first_name, :last_name, :password, :email, :profile_pic, :token)");
			$requete->bindparam(':login', $this->login);
			$requete->bindparam(':first_name', $this->first_name);
			$requete->bindparam(':last_name', $this->last_name);
			$requete->bindparam(':password', $this->password);
			$requete->bindparam(':email', $this->email);
			$requete->bindValue(':profile_pic', "img/photo2.png");
			$requete->bindparam(':token', $this->token);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function updateUser()
	{
		if(!empty($this->first_name) && !empty($this->last_name) && !empty($this->email) && !empty($this->login) 
		&& !empty($this->password) && !empty($this->confirm_password))
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET username = :login, first_name = :first_name, last_name = :last_name, email = :email
			WHERE `id_user` = :id_user");
			echo ($this->profile_pic);
			$requete->bindparam(':login', $this->login);
			$requete->bindparam(':first_name', $this->first_name);
			$requete->bindparam(':last_name', $this->last_name);
			$requete->bindparam(':email', $this->email);
			$requete->bindparam(':id_user', $this->id_user);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function updateProfilePicture()
	{
		if ($this->profile_pic != NULL)
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET profile_pic = :avatar
			WHERE `id_user` = :id_user");
			$requete->bindparam(':avatar', $this->profile_pic);
			$requete->bindparam(':id_user', $this->id_user);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function updatePassword()
	{
		if ($this->new_password != NULL && $this->confirm_new_password != NULL)
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET `password` = :password
			WHERE `id_user` = :id_user");
			$requete->bindparam(':password', $this->new_password);
			$requete->bindparam(':id_user', $this->id_user);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function ResetPassword()
	{
		if ($this->password != NULL && $this->confirm_password != NULL)
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET `password` = :password
			WHERE `username` = :login");
			$requete->bindparam(':password', $this->password);
			$requete->bindparam(':login', $this->login);
			$requete->execute();
		}
		else
		{
			echo "Error";
		}
	}

	public function deleteProfile()
	{
		$this->db->query( 'USE db_camagru' );
		$requete = $this->db->prepare("DELETE FROM `users` WHERE `id_user` = :id_user");
		$requete->bindparam(':id_user', $this->id_user);
		$requete->execute();
		echo "profile suppr";
	}

	public function findInfoUser()
	{
		if(!empty($this->id_user))
		{     
			$id_user = $this->id_user;
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("SELECT `username`, `profile_pic` FROM `users` WHERE `id_user` = :id_user");
			$requete->bindparam(':id_user', $id_user);
			$requete->execute();
			$data = $requete->fetch(PDO::FETCH_ASSOC);
			return array($data['username'], $data['profile_pic']);
		}
		else
		{
			return NULL;
			echo "Error";
		}
		
	}

	public function ON()
	{
		if ($this->id_user != NULL)
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET `activation_comment` = :activation_comment
			WHERE `id_user` = :id_user");
			$requete->bindValue(':activation_comment', 1);
			$requete->bindparam(':id_user', $this->id_user);
			$requete->execute();
		}
	}

	public function OFF()
	{
		if ($this->id_user != NULL)
		{    
			$this->db->query( 'USE db_camagru' );
			$requete = $this->db->prepare("UPDATE `users` 
			SET `activation_comment` = :activation_comment
			WHERE `id_user` = :id_user");
			$requete->bindValue(':activation_comment', 0);
			$requete->bindparam(':id_user', $this->id_user);
			$requete->execute();
		}
	}
	
}
?>