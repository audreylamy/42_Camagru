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
				<div>
					<h1>CAMAGRU</h1>
				</div>
				</div>
				<div id="button">
					<p class="button_profil"><a href='index.php'>HOME</a></p>
					<p class="button_profil"><a href='profile.php'>YOUR PROFILE</a></p>
					<p class="button_profil"><a href='logout.php'>LOG OUT</a></p>
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
						$requete = $conn->prepare("SELECT `image_path` FROM `photos` WHERE id_user = '$id_user' LIMIT :limite OFFSET :debut");
						$requete->bindValue('limite', $limite, PDO::PARAM_INT);
						$requete->bindValue('debut', $debut, PDO::PARAM_INT);
						$requete->execute();
						
						while ($data = $requete->fetch(PDO::FETCH_ASSOC)):?>
							<div id="div_picture">
								<img id="img_user" src="<?php echo $data['image_path'];?>" alt="picture_user">
							</div>
							
						<?php endwhile; ?>
						<div id="previous_next">
							<a id="button_previous" href="?page=<?php echo $page - 1; ?>">Previous</a>
							<a id="button_next" href="?page=<?php echo $page + 1; ?>">Next</a>
						</div>
					</div>

				</div>
				<div id="choose_object">
					<img id="image1" src="filter/corne11.png"alt="avatar">
					<img id="image2" src="filter/caticorn1.png"alt="avatar">
					<img id="image3" src="filter/caticorn22.png"alt="avatar">
					<img id="image4" src="filter/caticorn33.png"alt="avatar">
				</div>
			</div>
		<footer>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
	<script type="text/javascript" src="camera.js"></script>
	<script type="text/javascript" src="filter.js"></script>
	<script type="text/javascript" src="upload_filter.js"></script>
	<script type="text/javascript" src="save_and_cancel.js"></script>

	<script>
		var element_upload = document.getElementById('submit_picture');
		var element_take_picture = document.getElementById('startbutton');
		element_upload.addEventListener('click', function()
		{
			element_take_picture.style.visibility = "visible";
		});
	</script>

	<script>
	if (document.getElementById("upload"))
	{
		var image1 = document.getElementById('image1');
		var element_filter = document.getElementById('filter_image');
		var img_camera = document.getElementById('filter_image_video');
		image1.addEventListener('click', function()
		{
			element_filter.src= "filter/corne11.png";
			element_filter.style.visibility= "visible";
		});

		var image2 = document.getElementById('image2');
		image2.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn1.png";
			element_filter.style.visibility= "visible";
		});

		var image3 = document.getElementById('image3');
		image3.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn22.png";
			element_filter.style.visibility= "visible";
		});

		var image4 = document.getElementById('image4');
		image4.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn33.png";
			element_filter.style.visibility= "visible";
		});
	}
	</script>

<script>
	var element_start = document.getElementById('activation');
	var element_filter_video = document.getElementById('filter_image_video');
	element_start.addEventListener('click', function()
	{
		var image1 = document.getElementById('image1');
		image1.addEventListener('click', function()
		{
			element_filter_video.src= "filter/corne11.png";
			element_filter_video.style.visibility= "visible";
		});

		var image2 = document.getElementById('image2');
		image2.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn1.png";
			element_filter_video.style.visibility= "visible";
		});

		var image3 = document.getElementById('image3');
		image3.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn22.png";
			element_filter_video.style.visibility= "visible";
		});

		var image4 = document.getElementById('image4');
		image4.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn33.png";
			element_filter_video.style.visibility= "visible";
		});
	});
	</script>

	

</html>