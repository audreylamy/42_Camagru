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
				<canvas id="canvas"></canvas>
				<div id="message_confirm">Do you want to save this picture ?</div>
				<br></br>
					<div id="yes_no">
						<button id="yes">Yes</button>
						<button id="cancel">Cancel</button>
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
					<p class="button_profil"><a href=#>YOUR GALLERY</a></p>
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
							<video id="video">
								<img id="filter_image_video" src="" alt="avatar">
							</video>
							<div id="upload">
								<?php
								if ($_SESSION['upload'] === TRUE)
								{
									echo "<style> #upload { visibility: visible; }</style>";
									echo "<style> #startbuttonUpload { visibility: visible; }</style>"; 
									echo '<img id="img" src="'. $_SESSION['target'] . '"alt="avatar">';
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
								<input class="range" type="range" oninput="set('grayscale', this.valueAsNumber);" value="0" step="0.1" min="0" max="1">
								<button class="filter_button" id="sepia">Sepia</button>
								<input class="range" type="range" oninput="set('sepia', this.valueAsNumber);" value="0" step="0.1" min="0" max="1">
								<button class="filter_button" id="blur">Blur</button>
								<input class="range" type="range" oninput="set('blur', this.value + 'px');" value="0" step="1" min="0" max="10">
								<button class="filter_button" id="saturate">Saturate</button>
								<input class="range" type="range" oninput="set('saturate', this.valueAsNumber);" value="0" step="0.1" min="0" max="10">
								<button class="filter_button" id="contrast">Contrast</button>
								<input class="range" type="range" oninput="set('contrast', this.valueAsNumber);" value="0" step="0.1" min="0" max="10">
								<button class="filter_button" id="brightness">brightness</button>
								<input class="range" type="range" oninput="set('brightness', this.valueAsNumber);" value="0" step="0.1" min="0" max="10">
								<button class="filter_button" id="hue-rotate">hue-rotate</button>
								<input class="range" type="range" oninput="set('hue-rotate', this.value + 'deg');" value="0" step="30" min="0" max="360">
								<button class="filter_button" id="invert">invert</button>
								<button class="filter_button" id="no_filter">no filter</button>
							</section>
						</div>
					<div id="view_pictures">

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

	<script>
		var element_yes = document.getElementById('yes');
		element_yes.addEventListener('click', function()
		{
			// récupération du contenue du canvas sous la forme d'une string
			var data = canvas.toDataURL('image/png', 0)
			data = data.replace("data:image/png base64;", "");

			// création d'un formulaire pour l'envois en POST
			var formul = document.createElement('form');
			formul.setAttribute('method', 'POST');
			formul.setAttribute('action', "save.php");

			// création du input pour l’envoie de la string
			var champCache = document.createElement('input');
			champCache.setAttribute('type', 'hidden');
			champCache.setAttribute('name', 'image');
			champCache.setAttribute('value', data);
			formul.appendChild(champCache);

			// envois du formulaire
			document.body.appendChild(formul);
			formul.submit();
		});
	</script>

	<script>
		var element_upload = document.getElementById('submit_picture');
		var element_take_picture = document.getElementById('startbutton');
		element_upload.addEventListener('click', function()
		{
			element_take_picture.style.visibility = "visible";
		});
	</script>

	<script>
		var take_picture = document.getElementById('startbuttonUpload');
		take_picture.addEventListener('click', function()
		{
			var element_pop_up = document.getElementById('pop_up');
			element_pop_up.style.visibility = "visible";
		});
	</script>

	<script>
	
				
	</script>

	<script>
		var image1 = document.getElementById('image1');
		var element_filter = document.getElementById('filter_image');
		image1.addEventListener('click', function()
		{
			element_filter.src= "filter/corne1.png";
			element_filter.style.width= "25%";
			element_filter.style.visibility= "visible";
			element_filter.style.margin= "auto";
			element_filter.style.top= 15;
			element_filter.style.bottom= 100;
			element_filter.style.right= 100;
			element_filter.style.left= 100;
		});

		var image2 = document.getElementById('image2');
		image2.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn1.png";
			element_filter.style.width= "25%";
			element_filter.style.visibility= "visible";
			element_filter.style.margin= "none";
			element_filter.style.top= 100;
			element_filter.style.bottom= 0;
			element_filter.style.right= 0;
			element_filter.style.left= 400;
		});

		var image3 = document.getElementById('image3');
		image3.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn22.png";
			element_filter.style.width= "25%";
			element_filter.style.visibility= "visible";
			element_filter.style.margin= "none";
			element_filter.style.top= 100;
			element_filter.style.bottom= 0;
			element_filter.style.right= 400;
			element_filter.style.left= 0;
		});

		var image4 = document.getElementById('image4');
		image4.addEventListener('click', function()
		{
			element_filter.src= "filter/caticorn33.png";
			element_filter.style.width= "25%";
			element_filter.style.visibility= "visible";
			element_filter.style.margin= "none";
			element_filter.style.top= 100;
			element_filter.style.bottom= 0;
			element_filter.style.right= 400;
			element_filter.style.left= 0;
		});
	</script>

<script>
		var image1 = document.getElementById('image1');
		var element_filter_video = document.getElementById('filter_image_video');
		image1.addEventListener('click', function()
		{
			element_filter_video.src= "filter/corne1.png";
			element_filter_video.style.width= "25%";
			element_filter_video.style.visibility= "visible";
			element_filter_video.style.margin= "auto";
			element_filter_video.style.top= 15;
			element_filter_video.style.bottom= 100;
			element_filter_video.style.right= 100;
			element_filter_video.style.left= 100;
		});

		var image2 = document.getElementById('image2');
		image2.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn1.png";
			element_filter_video.style.width= "25%";
			element_filter_video.style.visibility= "visible";
			element_filter_video.style.margin= "none";
			element_filter_video.style.top= 100;
			element_filter_video.style.bottom= 0;
			element_filter_video.style.right= 0;
			element_filter_video.style.left= 400;
		});

		var image3 = document.getElementById('image3');
		image3.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn22.png";
			element_filter_video.style.width= "25%";
			element_filter_video.style.visibility= "visible";
			element_filter_video.style.margin= "none";
			element_filter_video.style.top= 100;
			element_filter_video.style.bottom= 0;
			element_filter_video.style.right= 400;
			element_filter_video.style.left= 0;
		});

		var image4 = document.getElementById('image4');
		image4.addEventListener('click', function()
		{
			element_filter_video.src= "filter/caticorn33.png";
			element_filter_video.style.width= "25%";
			element_filter_video.style.visibility= "visible";
			element_filter_video.style.margin= "none";
			element_filter_video.style.top= 100;
			element_filter_video.style.bottom= 0;
			element_filter_video.style.right= 400;
			element_filter_video.style.left= 0;
		});
	</script>


</html>