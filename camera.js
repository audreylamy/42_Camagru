var element_start = document.getElementById('activation');

	element_start.addEventListener('click', function()
	{
		var element_video = document.getElementById('video_space');
		var element_take_picture = document.getElementById('startbutton');
		var element_upload = document.getElementById('upload');
		var img_camera = document.getElementById('filter_image_video');
		element_take_picture.style.visibility = "visible";
		element_video.style.visibility = "visible";
		img_camera.style.visibility = "hidden";

		// supprime div 'upload'
		element_upload.remove();

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
		var width_camera = 500;
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
	var element_pop_up = document.getElementById('pop_up');
	element_pop_up.style.visibility = "visible";

    takepicture();
    ev.preventDefault();
  }, false);

})();
});