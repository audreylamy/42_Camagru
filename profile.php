<?php
session_start();
include('config/database.php');

// code ci-dessous regles les problemes de warning avec display_errors
if (isset($_SESSION['modification'])) 
{
   $modification = $_SESSION['modification'];
}

if (isset($_SESSION['wrong_confirm'])) 
{
   $wrong_confirm = $_SESSION['wrong_confirm'];
}

if (isset($_SESSION['wrong_password'])) 
{
   $wrong_password = $_SESSION['wrong_password'];
}

if (isset($_SESSION['password_modif'])) 
{
   $password_modif = $_SESSION['password_modif'];
}

if (isset($_SESSION['password_error'])) 
{
   $password_error = $_SESSION['password_error'];
}

if (isset($_SESSION['id_user']))
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

			<div id="header_part1">
				<div id="camagru">
					<h1>CAMAGRU</h1>
				</div>
				<div id="user_name">
						<?php
							if ($_SESSION['login'] != NULL)
							{
								echo "<div id='hello'>";
								echo Hello." ".$_SESSION['login'];
								echo "</div>";
								if ($_SESSION['profile_pic'] === NULL)
								{
									echo '<div id="img_profile"><img src="img/photo2.png"alt="avatar"></div>';
								}
								else
								{
									echo '<div id="img_profile"><img id="img_profile1" src="'.$_SESSION['profile_pic'].'"alt="avatar1"></div>';
								}
							}
						?>
				</div>
			</div>
			<div id="header_part2">
				<div id="button">
					<p class="button_profil"><a href='index.php'>HOME</a></p>
					<p class="button_profil"><a href='users.php'>TAKE A SNAP</a></p>
					<p class="button_profil"><a href='logout.php'>LOG OUT</a></p>
				</div>
			</div>
			</header>
			<div id="title">
			<h3> Here you can change informations about your profile </h3>
			</div>
			<div id="bloc_profile">
				<div id='profile_picture'>
					<div id='bloc_picture'>
					<?php
					if (isset($_SESSION['upload_picture']) && $_SESSION['upload_picture'] === "hello")
					{
						echo '<img src="'. $_SESSION['name_picture'] . '"alt="avatar" width="100%">';
					}
					else if ($_SESSION['profile_pic'] === NULL)
					{
						echo "<img id='avatar' src='img/photo2.png' alt='avatar' width='100%'>";
					}
					else if ($_SESSION['profile_pic'] != NULL)
					{
						echo '<img src="'. $_SESSION['profile_pic'] . '"alt="avatar" width="100%">';
					}
					?>	
					</div>
					<div>
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
					<div id="notification_comment">
						<p id="message_confirm">Notifications comments</p>
						<button onclick="notification_activate(<?php echo $_SESSION['id_user'];?>)" id="notification_yes">yes</button>
						<button	onclick="notification_desactivate(<?php echo $_SESSION['id_user'];?>)" id="notification_no">No</button>
					</div>
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
						<label class="label" for="password">Current password :</label>
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
					<div id='problem'>
						<?php
						if (isset($modification))
						{
							if ($modification === TRUE)
							{
								echo "Modifications have been made";
							}
							else if ($modification === FALSE)
							{
								echo "Password error";
							}
						}
						if (isset($wrong_confirm))
						{
							if ($wrong_confirm === TRUE)
							{
								echo "wrong confirmation";
							}
						}
						if (isset($wrong_password))
						{
							if ($wrong_password === TRUE)
							{
								echo "wrong password";
							}
						}
						?>
					</div>
				</form>
					<button id="delete" class="valider">Delete your profile</button>
					<div id="confirm">
					<br></br>
						<p id="message_confirm">Do you want to delete your profile ?</p>
						<div id="yes_no">
							<form method="post" action="delete.php">
								<input class="valider" type="submit" name="valider" value="Yes"/>
							</form>
							<button id="cancel">Cancel</button>
						</div>
					</div> 
				</div>
				<div id='modif_password'>
					<form method="post" action="modif_password.php">
					<div class="row">
						<div class="col-25">
						<label class="label" for="password">Current password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="password" value="" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="new_password">New password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="new_password" value="" placeholder="*****" required/>
						</div> 
					</div>
					<div class="row">
						<div class="col-25">
						<label class="label" for="confirm_new_password">Confirm new password :</label>
						</div>
						<div class="col-75">
						<input class="input" type="password" name="confirm_new_password" value="" placeholder="*****" required/>
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
						if (isset($password_modif))
						{
							if ($password_modif === TRUE)
							{
								echo "Password updated";
							}
							else if ($password_modif === FALSE)
							{
								echo "Password not updated";
							}
						}
						else if (isset($password_error))
						{
							if ($password_error === TRUE)
							{
								echo "Not the current password";
							}
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
	<script type="text/javascript" src="activation_comment.js"></script>
	<script language="javascript">
		var element_delete = document.getElementById('delete');
		var element_confirm = document.getElementById('confirm');
		element_delete.addEventListener('click', function()
		{
			if (element_confirm.style.visibility == "visible")
			{
				element_confirm.style.visibility = "hidden";
			}
			else
			{
				element_confirm.style.visibility = "visible";
			}
		});
	</script>
	<script>
		var element_cancel = document.getElementById('cancel');
		var element_confirm = document.getElementById('confirm');
		element_cancel.addEventListener('click', function()
		{
			element_confirm.style.visibility = "hidden";
		});
	</script>
</html>