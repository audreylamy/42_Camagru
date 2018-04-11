<?php
session_start();
include('config/setup.php');

if(isset($_POST ['first_name']) && isset($_POST ['last_name']) && isset($_POST ['email']) && isset($_POST ['login']) && isset($_POST ['password']) && isset($_POST ['confirm_password']))
{
	$first_name = $_POST ['first_name'];
	$last_name = $_POST ['last_name'];
	$email = $_POST ['email'];
	$login = $_POST ['login'];
	$password = $_POST ['password'];
	$confirm_password = $_POST ['confirm_password'];

	$membre = new Membre;
	$membre->setPseudo($first_name);
	$membre->setMail($last_name);
	$membre->setMdp($email);
	$membre->setNom($login);
	$membre->setPrenom($password);
	$membre->setAge($confirm_password);

	$membre->ajouterMembre();
}
else
{
	echo 'donnees manquantes';
}

class Membre
{
	private $first_name;
	private $last_name;
	private $email;
	private $login;
	private $password;
	private $confirm_password;

	public function getFirstName()
	{
		$this->first_name = $first_name;
		return $this->first_name;
	}

	public function getLastName()
	{
		$this->last_name = $last_name;
		return $this->last_name;
	}

	public function getEmail()
	{
		$this->email = $email;
		return $this->email;
	}

	public function getLogin()
	{
		$this->login = $login;
		return $this->login;
	}

	public function getPassword()
	{
		$this->password = $password;
		return $this->password;
	}

	public function getConfirmPassword()
	{
		$this->confirm_password = $confirm_password;
		return $this->confirm_password;
	}


	public function ajouterMembre()
	{
		if(!empty($this->pseudo) && !empty($this->mail) && !empty($this->mdp) && !empty($this->nom) && !empty($this->prenom) && !empty($this->age))
		{
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=tests', 'root', '') or die (print_r($bdd->errorInfo()));
			}
			catch(Exception $e)
			{
				die('Erreur: '.$e->getMessage());
			}
			$reponse = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
			$reponse->execute(array($this->pseudo));
			$donnees = $reponse->fetch();
			if($donnees ['pseudo'] == $this->pseudo)
			{
				echo 'Erreur pseudo deja existant';
			}
			else
			{              
				$requete = $bdd->prepare('INSERT INTO membres(pseudo, mail, mdp, nom, prenom, age) VALUES(:pseudo, :mail, :mdp, :nom, :prenom, :age)');
				$requete->execute(array('pseudo' => $this->pseudo,
								'mail' => $this->mail,
								'mdp' => $this->mdp,
								'nom' => $this->nom,
								'prenom' => $this->prenom,
								'age' => $this->age));
			}
		}
	}
}
$insert_bdd = "INSERT INTO users (username, first_name, last_name, password, email)
VALUE ('$prenom', '$nom', '$login', '$hashed_password', '$email')";

?>