<?php
session_start();
require('new_users.class.php');
include('config/database.php');

if($_POST['first_name'] != NULL && $_POST['last_name'] != NULL && $_POST['email'] != NULL && $_POST['login'] != NULL && $_POST['password'] != NULL && $_POST['confirm_password'] != NULL)
{
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	$membre = new Membre($conn);
	$membre->getFirstName($first_name);
	$membre->getLastName($last_name);
	$membre->getEmail($email);
	$membre->getLogin($login);
	$membre->getPassword($password);
	$membre->getConfirmPassword($confirm_password);

	if (($membre->verif_bdd_login()) === FALSE && ($membre->verif_bdd_email()) === FALSE)
	{
		echo "new_user";
		$membre->ajouterMembre();
	}
	else
	{
		echo "This users already exist";
	}
}
else
{
	echo 'donnees manquantes';
}

?>