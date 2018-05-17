var open_camera = document.getElementById("activation");

open_camera.addEventListener('click', function()
{
	var show_filter = document.getElementById("show_filter");
	show_filter.style.visibility = "visible";
});

var element_upload = document.getElementById('submit_picture');
var element_take_picture = document.getElementById('startbutton');
element_upload.addEventListener('click', function()
{
	element_take_picture.style.visibility = "visible";
});

if (document.getElementById("upload"))
{
var image1 = document.getElementById('image1');
var element_filter = document.getElementById('filter_image');
var img_camera = document.getElementById('filter_image_video');
image1.addEventListener('click', function()
{
	element_filter.src= "filter/rainbow.png";
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

var element_start = document.getElementById('activation');
var element_filter_video = document.getElementById('filter_image_video');
element_start.addEventListener('click', function()
{
var image1 = document.getElementById('image1');
image1.addEventListener('click', function()
{
	element_filter_video.src= "filter/rainbow.png";
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
