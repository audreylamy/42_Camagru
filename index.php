<?php
session_start();
include('config/database.php');
require('like.class.php');
require('comment.class.php');

$like = new Like($conn);
$nb_like_total = $like->countNbLikeTotal();

$comment1 = new Comment($conn);
$nb_comment_total = $comment1->countNbCommentTotal();

if (isset($_SESSION['id_user']))
{
	$id_user = $_SESSION['id_user'];
	$conn->query( 'USE db_camagru' );
	$requete = $conn->query("SELECT `profile_pic`, `username`  FROM `users` WHERE `id_user` = '$id_user'"); 
	$data = $requete->fetch(PDO::FETCH_ASSOC);
	$_SESSION['login'] = $data['username'];
	$_SESSION['profile_pic'] = $data['profile_pic'];
}
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

			<div id="pop_up">
				<div id="bloc_pop_up">
					<div id="bloc_profile_comments">
						<div id="like">
						</div>
						<div id="bloc_login_picture">
							<p id="username"></p>
							<div id="img_profile2">
								<img id="avatar" src="" alt="avatar1">
							</div>
						</div>
						<div id="bloc_cross">
							<img id="cross" src="img/cross.png" alt="cross">
						</div>
					</div>
					<div id="bloc_info_pop_up">
						<canvas id="canvas"></canvas>
						<div id="login_picture"></div>
						<div id="image_clic" ondblclick="like()">
							<img id="image_final" alt="image_final">
							<img id="image_coeur" alt="coeur" src="img/coeur.png">
						</div>
						<?php
							if (!isset($_SESSION['login']))
							{
								echo '<p id="info_log">Please create an account or log in if you want to comment/like this picture</p>';
								echo '<style> #bloc_comments { visibility: hidden; }</style>';
								echo '<button id="open_connect">New account or log in</button>';
							}
							?>
						<div id="bloc_comments">
							<div id="profile_by_comments"></div>
							<div id="input_comments">
								<input id="text_comments" type="text" name="name" value="" placeholder="add comment...">
								<input id="add" name="add" type="submit" value="add" onClick="send_comment(<?php echo $_SESSION['id_user'];?>);"/>
							</div>
						</div>
					</div>
				</div>
			</div>

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
					<?php
						$conn->query('USE db_camagru');
						$id_user = $_SESSION['id_user'];
						$limite = 12;
						$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
						(int)$debut = ($page - 1) * $limite;
						$requete = $conn->prepare("SELECT `id_photo`, `image_path` FROM `photos` LIMIT :limite OFFSET :debut");
						$requete->bindValue('limite', $limite, PDO::PARAM_INT);
						$requete->bindValue('debut', $debut, PDO::PARAM_INT);
						$requete->execute();

						while ($data = $requete->fetch(PDO::FETCH_ASSOC)):?>

							<div id="div_picture">
								<img onclick="create_popup(<?php echo $data['id_photo'];?>)" id="img_user" src="<?php echo $data['image_path'];?>" alt="picture_user">
							</div>
							
						<?php endwhile; ?>
						<div id="previous_next">
							<a id="button_previous" href="?page=<?php echo $page - 1; ?>">Previous</a>
							<a id="button_next" href="?page=<?php echo $page + 1; ?>">Next</a>
						</div>
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
									echo "<div id='bloc_message'>Confirm your email</div>";
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
										</div>
									</form>
										<button id="forgot_password">Forgot password ?</button>
											<?php
											if ($_SESSION['transfert_email'] === TRUE)
											{
												echo "<div id='bloc_message'>Check your email</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
											}
											if ($_SESSION['mdp_reset'] === TRUE)
											{
												echo "<div id='bloc_message'>Password updated</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
											}
											?>
											<?php
											if ($_SESSION['auth'] === FALSE)
											{
												echo "<div id='bloc_message'>Wrong login or password</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
											}
											if ($_SESSION['status'] === FALSE)
											{
												echo "<div id='bloc_message'>Please activate your email</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
											}
											else if ($_SESSION['auth'] === TRUE)
											{
												echo "<style> #se_connecter { visibility: hidden; }</style>";
											}
											?>
											<div id="forgot">
											<form method="post" action="forgot_password.php">
											<div class="row">
												<p id="enter_email" >Enter your email :</p>
												<div class="col-75">
												<input class="input" type="email" name="email_reset" value="" id="password" required/>
												</div>
											<div class="row">
												<div class="col-25">
												</div>
												<div class="col-75">
												<input class="valider" type="submit" name="reset" value="Reset"/>
												</div> 
											</div>
											</form>
											</div>
										</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<footer>
			<p id="text_footer">
				<?php
				echo $nb_like_total;
				?>
				likes
			</p>
			<p id="text_footer">
				<?php
				echo $nb_comment_total;
				?>
				Comments
			</p>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
	<script type="text/javascript" src="index_popup_image.js"></script>
	<script type="text/javascript" src="index.js"></script>
	<script type="text/javascript" src="add_comments.js"></script>
	<script type="text/javascript" src="like.js"></script>
</html>