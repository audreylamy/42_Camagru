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
					<div id="take_picture">
						<button id="activation">Start Camera</button>
						<div id="camera_space">
							<video id="video"></video>
						</div>
						<div id="button_picture">
							<button id="startbutton">Take a picture</button>
						</div>
					</div>
					<div id="choose_object">

					</div>
				</div>
				<div id="view_pictures">
					<canvas id="canvas"></canvas>
				</div>
			</div>
		<footer>
			<p id="text_footer">Camagru with love</p>
		</footer>
	</body>
	<script language="javascript">
	var element_start = document.getElementById('activation');

	element_start.addEventListener('click', function()
	{
	(function() {

  	var streaming = false,
      	video        = document.querySelector('#video'),
      	cover        = document.querySelector('#cover'),
      	canvas       = document.querySelector('#canvas'),
      	startbutton  = document.querySelector('#startbutton');

 	 navigator.getMedia = (navigator.getUserMedia ||
                    	navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia);

  	navigator.getMedia(
	{
     		video: true,
      		audio: false
    },
    function(stream) 
	{
      if (navigator.mozGetUserMedia) 
	  {
        	video.mozSrcObject = stream;
      } 
	  else 
	  {
        	var vendorURL = window.URL || window.webkitURL;
        	video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) 
	{
      	console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) 
	{
		var width_camera = 810;
      	height = video.videoHeight / (video.videoWidth/width_camera);
      	video.setAttribute('width', width_camera);
      	video.setAttribute('height', height);
      	canvas.setAttribute('width',width_camera);
      	canvas.setAttribute('height', height);
      	streaming = true;
    }
  }, false);

  function takepicture() 
  {
	  	var height_picture = 300;
	  	var width_picture = 420;
    	canvas.width = width_picture;
    	canvas.height = height_picture;
    	canvas.getContext('2d').drawImage(video, 0, 0, width_picture, height_picture);
    	var data = canvas.toDataURL('uploads');
    	photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev)
  {
      	takepicture();
    	ev.preventDefault();
  }, false);

})();
});
	</script>
</html>