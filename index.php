<?php
session_start();
?>

<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Camagru</title>   
		<link href="index.css" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Bungee+Hairline" rel="stylesheet">
 	</head>
	<body>
			<header>
				<div>
					<h1>CAMAGRU</h1>
				</div>
				<div id="connexion">
				<?php
				if ($_SESSION['auth'] === TRUE)
				{
					echo "<p class='button_private'><a href='users.php'>TAKE A SNAP</a></p>";
					echo "<p class='button_private'><a href='profile.php'>YOUR PROFILE</a></p>";
					echo "<p class='button_private'><a href='logout.php'>LOG OUT</a></p>";
				}
				else
					echo "<p id='button_connexion'>CONNECT</p>";
				?>
				</div>
			</header>
			<div id="bloc_principal">
			<div id="gallery_photo">
				<div id="gallery">
					<!-- <div id="new_photo">
						<img id="picture" src="" title="image" alt="image" />
						<p></p>
						<form method="GET" action="index.php" name="index.php" >
							<textarea name="commentaire" rows="1" cols="20"></textarea>
							<input type="submit" name="action" value="like">
						</form>
					</div> -->
				</div>
				<div id="se_connecter">
					<div id="bloc_connexion">
						<div id="nouveau">
							<h3>Join us</h3>
								<form method="post" action="new_users.php">
									<div class="row">
										<div class="col-25">
										<label class="label" for="first_name">First-name :</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="first_name" value="<?php htmlspecialchars($_POST['first_name']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="last_name">Last-name :</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="last_name" value="<?php htmlspecialchars($_POST['last_name']); ?>" required/>	
										</div>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="email">Email :</label>
										</div>
										<div class="col-75">
										<input class="input" type="email" name="email" value="<?php htmlspecialchars($_POST['email']); ?>" required/>
										</div>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="login">Username :</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="login" value="<?php htmlspecialchars($_POST['login']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="password">Password :</label>
										</div>
										<div class="col-75">
										<input class="input" type="password" name="password" value="<?php htmlspecialchars($_POST['password']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="confirm_password">Confirm password :</label>
										</div>
										<div class="col-75">
										<input class="input" type="password" name="confirm_password" value="<?php htmlspecialchars($_POST['confirm_password']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										</div>
										<div class="col-75">
										<input class="valider" type="submit" name="valider" value="Sign up"/>
										</div> 
									</div>
								</form>
								<?php
								if ($_SESSION['connect'] === FALSE)
								{
									echo "<div id='bloc_message'>login or email already exists</div>";
									echo "<style> #se_connecter { visibility: visible; }</style>";
								}
								else if ($_SESSION['verif_password'] === FALSE)
								{
									echo "<div id='bloc_message'>Password is not correct</div>";
									echo "<style> #se_connecter { visibility: visible; }</style>";
								}
								else if ($_SESSION['connect'] === TRUE && $_SESSION['verif_password'] === TRUE)
								{
									echo "<div id='bloc_message'>You can log in</div>";
									echo "<style> #se_connecter { visibility: visible; }</style>";
								}
								?>
							</div>
						<div id="ancien">
								<h3>Log in</h3>
								<form method="post" action="login.php">
										<div class="row">
												<div class="col-25">
												<label class="label" for="login">Username :</label>
												</div>
												<div class="col-75">
												<input class="input" type="text" name="login" value="<?php htmlspecialchars($_POST['login']); ?>" id="login" required/>
												</div> 
										</div>
										<div class="row">
												<div class="col-25">
												<label class="label" for="password">Password :</label>
												</div>
												<div class="col-75">
												<input class="input" type="password" name="password" value="<?php htmlspecialchars($_POST['password']); ?>" id="password" required/>
												</div> 
										</div>
											<div class="row">
												<div class="col-25">
												</div>
												<div class="col-75">
											<input class="valider" type="submit" name="modif" value="Log in"/>
											</div> 
											<a id="forgot_password" href="#">Forgot password ?</a>
										</div>
									</form>
									<?php
									if ($_SESSION['status'] === FALSE)
									{
										echo "<div id='bloc_message'>Please activate your email</div>";
										echo "<style> #se_connecter { visibility: visible; }</style>";
									}
									if ($_SESSION['auth'] === FALSE)
									{
										echo "<div id='bloc_message'>Wrong login or password</div>";
										echo "<style> #se_connecter { visibility: visible; }</style>";
									}
									else if ($_SESSION['auth'] === TRUE)
									{
										echo "<style> #se_connecter { visibility: hidden; }</style>";
									}
									?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<footer>
			<p id="text_footer">likes</p>
			<p id="text_footer">Comments</p>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
	<script language="javascript">
		var element_connect = document.getElementById('button_connexion');
		var bloc_connexion = document.getElementById('se_connecter');
		element_connect.addEventListener('click', function()
		{
			if (bloc_connexion.style.visibility == "visible")
			{
				bloc_connexion.style.visibility = "hidden";
			}
			else
			{
				bloc_connexion.style.visibility = "visible";
			}
		});

	</script>
	<script>
		var element = document.getElementById('button_connexion');
		element.addEventListener('mouseover', function()
		{
			element.style.background = "#62bcfa";
		});
		element.addEventListener('mouseout', function()
		{
			element.style.background = "#bbc4ef";
		});
	</script>
</html>