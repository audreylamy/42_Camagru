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
	$requete = $conn->prepare("SELECT `profile_pic`, `username`  FROM `users` WHERE `id_user` = :id_user"); 
	$requete->bindparam(':id_user', $id_user);
	$requete->execute();
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
						<?php
						if (isset($_SESSION['login']))
						{
							echo '<style> #like { visibility: visible; }</style>';
						}
						?>
						<div id="like"></div>
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
						<?php
							if (isset($_SESSION['login']))
							{
								echo '<div id="image_clic" ondblclick="like(';
								echo $_SESSION['id_user'];
								echo ')">';
								echo '<img id="image_final" alt="image_final">';
								echo '<img id="image_coeur" alt="coeur" src="img/coeur.png">';
								echo '</div>';
							}
							else
							{
								echo '<div id="image_clic">';
								echo '<img id="image_final" alt="image_final">';
								echo '</div>';
							}
						?>
						<?php
							if (!isset($_SESSION['login']))
							{
								echo '<p id="info_log">Please create an account or log in if you want to comment/like this picture</p>';
								echo '<style> #bloc_comments { visibility: hidden; }</style>';
								echo '<button onclick="open_connect()" id="open_connect">New account or log in</button>';
								echo '<style> #image_coeur { visibility: hidden; }</style>';
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
						echo "<style> #se_connecter { visibility: hidden; }</style>";
					}
					else
					{
						echo "<p onclick='open_se_connecter()' id='button_connexion'>CONNECT</p>";
					}
					?>
				</div>
			</header>
			<div id="bloc_principal">
			<div id="gallery_photo">
				<div id="gallery">
					<?php
						$id_user = $_SESSION['id_user'];
						$limite = 12;
						$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
						(int)$debut = ($page - 1) * $limite;
						
						$conn->query('USE db_camagru');
						$requete_nb_page = $conn->prepare("SELECT count(`id_photo`) from `photos`");
						$requete_nb_page->execute();
						$totalPictures = $requete_nb_page->fetchColumn();

						$nombreDePages  = ceil($totalPictures / $limite);

						if ($page == $nombreDePages)
						{
							echo "<style> #button_next { visibility: hidden; }</style>";
						}
						if ($totalPictures === '0')
						{
							echo "<style> #button_previous { visibility: hidden; }</style>";
							echo "<style> #button_next { visibility: hidden; }</style>";
						}

						if($totalPictures <= $limite)
						{
							echo "<style> #button_previous { visibility: hidden; }</style>";
						}
						else
						{
							echo "<style> #button_previous { visibility: visible; }</style>";
						}

						$conn->query('USE db_camagru');
						$requete = $conn->prepare("SELECT `id_photo`, `image_path` 
						FROM `photos`
						ORDER BY creation_date ASC 
						LIMIT :limite OFFSET :debut");
						$requete->bindValue('limite', $limite, PDO::PARAM_INT);
						$requete->bindValue('debut', $debut, PDO::PARAM_INT);
						$requete->execute();

						while ($data = $requete->fetch(PDO::FETCH_ASSOC)):?>

							<div id="div_picture">
								<img onclick="create_popup(<?php echo $data['id_photo'];?>)" id="img_user" src="<?php echo $data['image_path'];?>" alt="picture_user">
							</div>
							
						<?php endwhile; ?>

						<div id="previous_next">
							<a id="button_previous" href="?page=<?php echo $page - 1;?>">Previous</a>
							<a id="button_next" href="?page=<?php 
							if ($page < 100)
							{
								echo $page + 1;
							}
							else
							{
								echo 1;
								header('Location: index.php?page=1');
							}
							?>">Next</a>
					</div>
				</div>
				<div id="se_connecter">
					<div id="bloc_connexion">
						<div id="nouveau">
							<div id="join_us">
							<h3>Join us</h3>
								<form>
									<div class="row">
										<div class="col-25">
										<label class="label">First-name :</label>
										</div>
										<div class="col-75">
										<input id="first_name" class="input" type="text" value="<?php htmlspecialchars($_POST['first_name']); ?>" required/>
										</div> 
										<p class="bloc_message" id="error_first_name"></p>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label">Last-name :</label>
										</div>
										<div class="col-75">
										<input id="last_name" class="input" type="text" value="<?php htmlspecialchars($_POST['last_name']); ?>" required/>	
										</div>
										<p class="bloc_message" id="error_last_name"></p>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label">Email :</label>
										</div>
										<div class="col-75">
										<input id="email" class="input" type="email" value="<?php htmlspecialchars($_POST['email']); ?>" required/>
										</div>
										<p class="bloc_message" id="error_email"></p>
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label" >Username :</label>
										</div>
										<div class="col-75">
										<input id="login" class="input" type="text" value="<?php htmlspecialchars($_POST['login']); ?>" required/>
										</div> 
										<p class="bloc_message" id="error_login"></p>
									</div>
									<p id="message_password" class='bloc_message3'>At list one lowercase one number<p>
									<div class="row">
										<div class="col-25">
										<label class="label">Password :</label>
										</div>
										<div class="col-75">
										<input id="password1" class="input" type="password" value="<?php htmlspecialchars($_POST['password']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										<label class="label">Confirm password :</label>
										</div>
										<div class="col-75">
										<input id="confirm_password" class="input" type="password" value="<?php htmlspecialchars($_POST['confirm_password']); ?>" required/>
										</div> 
									</div>
									<div class="row">
										<div class="col-25">
										</div>
										<div class="col-75">
										<input onclick=signUp() id="sign_up" class="valider" type="button" name="submit" value="Sign up"/>
										</div> 
									</div>
								</form>
									<p class="bloc_message" id="error_password"></p>
									<p class="bloc_message" id="error_confirm_password"></p>
									<p class="bloc_message" id="true_connect"></p>
									<p class="bloc_message" id="error_verif_password"></p>
									<p class="bloc_message" id="error_connect"></p>
								</div>
							</div>
						<div id="ancien">
								<h3>Log in</h3>
								<form>
										<div class="row">
											<div class="col-25">
											<label class="label">Username :</label>
											</div>
											<div class="col-75">
											<input id="login1" class="input" type="text" value="<?php htmlspecialchars($_POST['login']); ?>" id="login1" required/>
											</div> 
										</div>
										<div class="row">
											<div class="col-25">
											<label class="label">Password :</label>
											</div>
											<div class="col-75">
											<input id="password" class="input" type="password" value="<?php htmlspecialchars($_POST['password']); ?>" required/>
											</div> 
										</div>
										<div class="row">
											<div class="col-25">
											</div>
											<div class="col-75">
											<input onclick=logIn() id="log_in" class="valider" type="button" name="submit" value="Log in"/>
											</div> 
										</div>
									</form>
									<p class="bloc_message" id="status"><p>
									<p class="bloc_message" id="auth"><p>
										<?php
										if ($_SESSION['auth'] === TRUE)
										{
											echo "<style> #se_connecter {display:none; }</style>";
										}
										?>
										<button id="forgot_password">Forgot password ?</button>
											<div id="forgot">
											<form method="post" action="forgot_password.php">
											<div class="row">
												<p id="enter_email" >Enter your email :</p>
												<div class="col-75">
												<input class="input" type="email" name="email_reset" value="" id="password2" required/>
												</div>
											<div class="row">
												<div class="col-25">
												</div>
												<div class="col-75">
												<input class="valider" type="submit" name="reset" value="Reset"/>
												</div> 
											</div>
											</form>
											<?php
											if ($_SESSION['email_bdd'] === FALSE)
											{
												echo "<div class='bloc_message2'>Email doesn't exist</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
												echo "<style> #forgot { visibility: visible; }</style>";
											}
											if ($_SESSION['status_forgot'] === FALSE)
											{
												echo "<div class='bloc_message2'>Please activate your email</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
												echo "<style> #forgot { visibility: visible; }</style>";
											}
											if ($_SESSION['transfert_email'] === TRUE)
											{
												echo "<div class='bloc_message1'>Check your email</div>";
												echo "<style> #se_connecter { visibility: visible; }</style>";
												echo "<style> #forgot { visibility: visible; }</style>";
											}
											?>
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
	<script type="text/javascript" src="new_users.js"></script>
	<script type="text/javascript" src="login.js"></script>
	<script type="text/javascript" src="index_popup_image.js"></script>
	<script type="text/javascript" src="index.js"></script>
	<script type="text/javascript" src="add_comments.js"></script>
	<script type="text/javascript" src="like.js"></script>
</html>