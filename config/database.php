<?php
$DB_DSN = 'mysql:host=localhost;unix_socket=/Users/alamy/goinfre/mamp/mysql/tmp/mysql.sock';
$DB_USER = 'root';
$DB_PASSWORD = 'audrey';

// Create connection
try 
{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "connection success";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
	echo "\n";
}

?>