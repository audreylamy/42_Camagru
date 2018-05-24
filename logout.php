<?php
session_start();

if ($_SESSION['login'] === NULL)
{
	header('Location: index.php');
}

$_SESSION['auth'] = "";
session_destroy();
header('Location: index.php');
?>