
<?php
session_start();

require('new_users.class.php');
include('config/database.php');

$actual_user = new Membre($conn);

$actual_user->getIdUser($_SESSION['id_user']);
$actual_user->deleteProfile();
header('Location: index.php');
session_destroy();
?>