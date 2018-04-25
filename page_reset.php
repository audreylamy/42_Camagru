<?php
 $_POST['login'] = $_GET['login'];
?>
<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Camagru</title>   
		<link href="page_reset.css" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Bungee+Hairline" rel="stylesheet">
 	</head>
	<body>
	<header>
		<div>
			<h1>CAMAGRU</h1>
		</div>
	</header>
	<div id="bloc_new_password">
		<form method="post" action="modif_password_bdd.php">
			<input name="login" type="hidden" value="<?php echo $_POST['login'];?>">
			<div class="row">
				<div class="col-25">
				<label class="label" for="password">New password :</label>
				</div>
				<div class="col-75">
				<input class="input" type="password" name="password" value="" required/>
				</div> 
			</div>
			<div class="row">
				<div class="col-25">
				<label class="label" for="confirm_password">Confirm new password :</label>
				</div>
				<div class="col-75">
				<input class="input" type="password" name="confirm_password" value="" required/>
				</div> 
			</div>
			<div class="row">
				<div class="col-25">
				</div>
				<div class="col-75">
				<input class="valider" type="submit" name="valider" value="Reset your password"/>
				</div> 
				</div>
		</form>		
	</div>										
	</body>
</html>