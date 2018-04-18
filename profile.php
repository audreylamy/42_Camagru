<?php
session_start();
include('config/database.php');

if($_SESSION['login'] != NULL)
{
	$login = $_SESSION['login'];
	$conn->query( 'USE db_camagru' );
	$requete = $conn->query("SELECT * FROM `users` WHERE `username` = '$login'"); 
	$data = $requete->fetch(PDO::FETCH_ASSOC);
	$_SESSION['first_name'] = $data['first_name'];
	$_SESSION['last_name'] = $data['last_name'];
	$_SESSION['email'] = $data['email'];
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
			<div id="bloc_profile">
				<div id='form_modif'>
				<h3> Here you can change informations about your profile </h3>
				<form method="post" action="new_users.php">
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
						<input class="input" type="text" name="login" value="<?php echo $_SESSION['login']; ?>" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="password">Password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="password" value="" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="confirm_password">Confirm password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="confirm_password" value="" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						</div>
						<div class="col-75">
						<input class="valider" type="submit" name="valider" value="validation"/>
						</div> 
					</div>
				</form>
				</div>			
			</div>
		<footer>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
</html>