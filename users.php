<?php
session_start();
require('new_users.class.php');
include('config/database.php');
?>

<html lang="fr">
  	<head>
    	<meta charset="utf-8">
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Camagru</title>   
		<link href="users.css" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta+Stencil|Bungee+Hairline" rel="stylesheet">
 	</head>
	<body>
		<div id="pop_up">
			<div id="save_picture">
				
				<br></br>
					<div id="yes_no">
						<canvas id="canvas"></canvas>
						<div id="message_confirm">Do you want to save this picture ?</div>
						<div id="image_final_div">
							<img id="image_final" src="" alt="image_final">
						</div>
						<div id="button_yes_no">
							<button id="yes">Yes</button>
							<button id="cancel">Cancel</button>
						</div>
					</div>
			</div>
		</div>
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
				<p class="button_profil"><a href='profile.php'>YOUR PROFILE</a></p>
				<p class="button_profil"><a href='logout.php'>LOG OUT</a></p>
			</div>
		</div>
			</header>
			<div id="camera">
				<div id="part1">
					<div id="take_picture_filter">
						<div id="take_picture">
							<button id="activation">Start Camera</button>
							<div id="add_picture">
								<form method="post" action="upload_picture.php" enctype="multipart/form-data">
									<input id="download_picture" type="file" name="avatar">
									<input id="submit_picture" type="submit" name="submit_picture" value="Upload Image"/>
								</form>
							</div>
							<div id="camera_space">
								<div id="video_space">
									<img id="filter_image_video" src="" alt="avatar">
									<video id="video"></video>
								</div>
								<div id="upload">
									<?php
									if ($_SESSION['upload'] === TRUE)
									{
										echo "<style> #upload { visibility: visible; }</style>";
										echo "<style> #startbuttonUpload { visibility: visible; }</style>"; 
										echo '<img id="img" src="'. $_SESSION['target'] . '"alt="avatar" >';
										echo '<img id="img_bis" src="" alt="avatar2">';
									}
									?>
									<img id="filter_image" src="" alt="avatar">
								</div>
								<div id="button_picture">
									<button id="startbutton">Take a picture</button>
								</div>
								<div id="button_picture_upload">
									<button id="startbuttonUpload">Take a picture</button>
								</div>
							</div>
						</div>
							<section id="filter">
								<button class="filter_button" id="grayscale">Grayscale</button>
								<button class="filter_button" id="sepia">Sepia</button>
								<button class="filter_button" id="saturate">Saturate</button>
								<button class="filter_button" id="contrast">Contrast</button>
								<button class="filter_button" id="hue-rotate1">hue-rotate green</button>
								<button class="filter_button" id="hue-rotate2">hue-rotate blue</button>
								<button class="filter_button" id="hue-rotate3">hue-rotate pink</button>
								<button class="filter_button" id="invert">invert</button>
								<button class="filter_button" id="no_filter">no filter</button>
							</section>
						</div>
					<div id="view_pictures">
						<?php
						$conn->query('USE db_camagru');
						$id_user = $_SESSION['id_user'];
						$limite = 3;
						$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
						(int)$debut = ($page - 1) * $limite;
						$requete = $conn->prepare("SELECT `id_photo`, `image_path` FROM `photos` WHERE id_user = '$id_user' LIMIT :limite OFFSET :debut");
						$requete->bindValue('limite', $limite, PDO::PARAM_INT);
						$requete->bindValue('debut', $debut, PDO::PARAM_INT);
						$requete->execute();
						
						while ($data = $requete->fetch(PDO::FETCH_ASSOC)):?>
							<div id="div_picture" class="<?php echo $data['id_photo'];?>">
								<input type="hidden" name="id_photo" value="<?php echo $data['id_photo'];?>">
								<img class="img_user" id="<?php echo "picture".$data['id_photo'];?> open_delete" onclick="open_delete(<?php echo $data['id_photo'];?>)" src="<?php echo $data['image_path'];?>" alt="picture_user">
								<div class="delete_picture" id="<?php echo $data['id_photo'];?>">
									<button id="delete_yes" onclick="delete_picture(<?php echo $data['id_photo'];?>)">YES</button>
									<button id="delete_no" onclick="close_delete(<?php echo $data['id_photo'];?>)">NO</button>
								</div>
							</div>
							
						<?php endwhile; ?>
						<div id="previous_next">
							<a id="button_previous" href="?page=<?php echo $page - 1; ?>">Previous</a>
							<a id="button_next" href="?page=<?php echo $page + 1; ?>">Next</a>
						</div>
					</div>

				</div>
				<div id="choose_object">
					<?php
						if ($_SESSION['upload'] === TRUE)
						{
							echo "<style> #show_filter { visibility: visible; }</style>";
						}
					?>
					<div id="show_filter">
						<img class="img_div" id="image1" src="filter/rainbow.png"alt="avatar">
						<img class="img_div" id="image2" src="filter/caticorn1.png"alt="avatar">
						<img class="img_div" id="image3" src="filter/caticorn22.png"alt="avatar">
						<img class="img_div" id="image4" src="filter/caticorn33.png"alt="avatar">
					</div>
				</div>
			</div>
		<footer>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
	<script type="text/javascript" src="camera.js"></script>
	<script type="text/javascript" src="filter.js"></script>
	<script type="text/javascript" src="filter_image.js"></script>
	<script type="text/javascript" src="upload_filter.js"></script>
	<script type="text/javascript" src="save_and_cancel.js"></script>
	<script type="text/javascript" src="delete_picture.js"></script>
</html>