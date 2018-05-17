<?php
include('database.php');

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE db_camagru";
    $conn->exec($sql);
	echo "Database created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql. $e->getMessage();
	echo "\n";
}

$conn->exec( 'use db_camagru' );

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_users = "CREATE TABLE IF NOT EXISTS users(
    id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
	password VARCHAR(300) NOT NULL,
    email VARCHAR(50),
	profile_pic VARCHAR(100) DEFAULT '../img/photo2.png',
	fb_id INT,
	twitter_id INT,
	validation_email BOOLEAN DEFAULT 0,
	token VARCHAR(300) NOT NULL,
	status INT DEFAULT 0 NOT NULL,
	token_reset VARCHAR(300)
	) ";

    $conn->exec($sql_users);
	echo "Table users created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql_users . "<br>" . $e->getMessage();
	echo "\n";
}

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_photos = "CREATE TABLE IF NOT EXISTS photos(
    id_photo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_user INT NOT NULL,
    creation_date DATETIME NOT NULL,
	image_path VARCHAR(300) NOT NULL
	) ";

    $conn->exec($sql_photos);
	echo "Table photos created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql_photos . "<br>" . $e->getMessage();
	echo "\n";
}

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_comments = "CREATE TABLE IF NOT EXISTS comments(
    id_comment INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_user INT NOT NULL,
	comment VARCHAR(300),
	creation_date DATETIME NOT NULL
	) ";

    $conn->exec($sql_comments);
	echo "Table comments created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql_comments . "<br>" . $e->getMessage();
	echo "\n";
}

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_photos_comments = "CREATE TABLE IF NOT EXISTS photos_comments(
    id_comment INT NOT NULL,
	id_photo INT NOT NULL
	) ";

    $conn->exec($sql_photos_comments);
	echo "Table photos_comments created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql_photos_comments . "<br>" . $e->getMessage();
	echo "\n";
}

try 
{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_likes = "CREATE TABLE IF NOT EXISTS likes(
    id_like INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_photo INT NOT NULL
	) ";

    $conn->exec($sql_likes);
	echo "Table likes created successfully";
	echo "\n";
}
catch(PDOException $e)
{
	echo $sql_likes . "<br>" . $e->getMessage();
	echo "\n";
}

?>