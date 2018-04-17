<?php
session_start();
$_SESSION['auth'] = "";
session_destroy();
header('Location: index.php');
?>