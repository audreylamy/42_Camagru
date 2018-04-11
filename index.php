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
					<p id="button_connexion">CONNECT</p>
				</div>
			</header>
			<div id="bloc_principal">
			<div id="gallery_photo">
				<div id="gallery">
					<div id="new_photo">
						<img id="picture" src="" title="image" alt="image" />
						<p></p>
						<form method="GET" action="index.php" name="index.php" >
							<textarea name="commentaire" rows="1" cols="20"></textarea>
							<input type="submit" name="action" value="like">
						</form>
					</div>
				</div>
				<div id="se_connecter">
					<div id="bloc_connexion">
						<div id="nouveau">
							<h3>Join us</h3>
								<form method="post" action="new_users.php">
									<div class="row">
										<div class="col-25">
										<label class="label" for="prenom">First-name :</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="prenom" value="<?php $_POST['first_name']; ?>" id="prenom" autofocus required/>
										</div>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="nom">Last-name:</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="nom" value="<?php $_POST['last_name']; ?>" id="nom" required/>	
										</div>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="email">Email :</label>
										</div>
										<div class="col-75">
										<input class="input" type="email" name="email" value="<?php $_POST['email']; ?>" id="email" required/>
										</div>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="login">Login :</label>
										</div>
										<div class="col-75">
										<input class="input" type="text" name="login" value="<?php $_POST['login']; ?>" id="login" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="password">Password :</label>
										</div>
										<div class="col-75">
										<input class="input" type="password" name="password" value="<?php $_POST['password']; ?>" id="password" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" for="password2">Confirm password :</label>
										</div>
										<div class="col-75">
										<input class="input" type="password" name="password2" value="<?php $_POST['confirm_password']; ?>" id="password2" required/>
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
							</div>
						<div id="ancien">
								<h3>Log in</h3>
								<form method="post" action="login.php">
										<div class="row">
												<div class="col-25">
												<label class="label" for="login">Username :</label>
												</div>
												<div class="col-75">
												<input class="input" type="text" name="login" value="" id="login" required/>
												</div> 
										</div>
										<div class="row">
												<div class="col-25">
												<label class="label" for="password">Password :</label>
												</div>
												<div class="col-75">
												<input class="input" type="password" name="password" value="" id="password" required/>
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
		var element = document.getElementById('button_connexion');
		element.addEventListener('click', function()
		{
			var bloc_connexion = document.getElementById('se_connecter');
			bloc_connexion.style.visibility = "visible";
		});
		element.addEventListener('mouseover', function()
		{
			element.style.background = "#62bcfa";
			element.style.margin = "70px";
		});
		element.addEventListener('mouseout', function()
		{
			element.style.background = "#bbc4ef";
			element.style.margin = "65px";
		});
	</script>
</html>