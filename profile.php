<?php
session_start();
include('config/database.php');

if ($_SESSION['id_user'] != NULL)
{
	$id_user = $_SESSION['id_user'];
	$conn->query( 'USE db_camagru' );
	$requete = $conn->query("SELECT * FROM `users` WHERE `id_user` = '$id_user'"); 
	$data = $requete->fetch(PDO::FETCH_ASSOC);
	$_SESSION['login'] = $data['username'];
	$_SESSION['first_name'] = $data['first_name'];
	$_SESSION['last_name'] = $data['last_name'];
	$_SESSION['email'] = $data['email'];
	$_SESSION['password'] = $data['password'];
	$_SESSION['confirm_password'] = $data['confirm_password'];
	$_SESSION['profile_pic'] = $data['profile_pic'];
}
?>

<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Camagru</title>   
		<link href="profile.css" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Bungee+Hairline" rel="stylesheet">
 	</head>
	<body>
			<header>
				<div>
					<h1>CAMAGRU</h1>
				</div>
				</div>
				<div id="button">
					<p class="button_profil"><a href='index.php'>HOME</a></p>
					<p class="button_profil"><a href=#>YOUR GALLERY</a></p>
					<p class="button_profil"><a href='logout.php'>LOG OUT</a></p>
				</div>
			</header>
			<div id="title">
			<h3> Here you can change informations about your profile </h3>
			</div>
			<div id="bloc_profile">
				<div id='profile_picture'>
					<div id='bloc_picture'>
					<?php
					if ($_SESSION['upload_picture'] === "hello")
					{
						echo '<img src="'. $_SESSION['name_picture'] . '"alt="avatar" width="100%">';
					}
					else if ($_SESSION['profile_pic'] === NULL)
					{
						echo "<img id='avatar' src='uploads/photo.png' alt='avatar' width='100%'>";
					}
					else if ($_SESSION['profile_pic'] != NULL)
					{
						echo '<img src="'. $_SESSION['profile_pic'] . '"alt="avatar" width="100%">';
					}
					?>	
					</div>
					<form method="post" action="add_picture_profile.php" enctype="multipart/form-data">
					<input id="download_picture" type="file" name="avatar">
					<br></br>
					<div class="row">
						<div class="col-25">
						</div>
						<div class="col-75">
						<input class="valider" type="submit" name="submit" value="Upload Image"/>
						</div> 
					</div>
					</form>
				</div>
				<div id='form_modif'>
				<form method="post" action="modif.php">
					<div class="row">
						<div class="col-25">
						<label class="label" for="first_name">First-name :</label>
						</div>
						<div class="col-75">
						<input class="input" type="text" name="first_name" value="<?php echo $data['first_name'];?>" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="last_name">Last-name :</label>
						</div>
						<div class="col-75">
						<input class="input" type="text" name="last_name" value="<?php echo $data['last_name'];?>" required/>	
						</div>
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="email">Email :</label>
						</div>
						<div class="col-75">
						<input class="input" type="email" name="email" value="<?php echo $data['email']; ?>" required/>
						</div>
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="login">Username :</label>
						</div>
						<div class="col-75">
						<input class="input" type="text" name="login" value="<?php echo $data['username']; ?>" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="password">Password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="password" value="<?php $_POST['password']; ?>" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="confirm_password">Confirm password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="confirm_password" value="<?php $_POST['confirm_password']; ?>" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						</div>
						<div class="col-75">
						<input class="valider" type="submit" name="valider" value="validation"/>
						</div> 
					</div>
					<div id='problem'>
						<?php
						if ($_SESSION['modification'] === TRUE)
						{
							echo "Modifications have been made";
						}
						else if ($_SESSION['modification'] === FALSE)
						{
							echo "Password error";
						}
						?>
					</div>
				</form>
				</div>			
			</div>
		<footer>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
</html>