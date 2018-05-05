
function takepicture() 
{
	function getBase64Image(img) 
	{
		var canvas = document.createElement("canvas");
		canvas.width = img.naturalWidth;
		canvas.height = img.naturalHeight;
		var ctx = canvas.getContext("2d");
		ctx.drawImage(img, 0, 0);
		var dataURL = canvas.toDataURL("image/png");
		return dataURL;
	}

	var img_filter = document.getElementById('filter_image');
	var filter = img_filter.src;
	var src_img = document.getElementById('img');
	var img = getBase64Image(src_img);

	var formData = new FormData();
	formData.append('img1', img);
	formData.append('img2', filter);

	var get = new XMLHttpRequest();
	get.open("POST", "superposition_filter_upload.php", true);
	get.send(formData);
	get.onreadystatechange = function () 
	{
		if (get.readyState != 4 || get.status != 200)
	  	{
			readURL(get.responseText);
		}
	};
}

function readURL(img_final) 
{  
	var image = document.getElementById('image_final');
	// Clear image container
	image.removeAttribute('src'); 
	// Put image in created image tags
	image.src = img_final;
}

var startbuttonUpload = document.getElementById('startbuttonUpload');
startbuttonUpload.addEventListener('click', function(ev)
{
  var element_pop_up = document.getElementById('pop_up');
  element_pop_up.style.visibility = "visible";

  takepicture();
  ev.preventDefault();
}, false);
