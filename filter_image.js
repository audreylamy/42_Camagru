var open_camera = document.getElementById("activation");

open_camera.addEventListener('click', function()
{
	var show_filter = document.getElementById("show_filter");
	show_filter.style.visibility = "visible";
});

// var element_upload = document.getElementById('submit_picture');

// element_upload.addEventListener('click', function()
// {
// 	element_take_picture.style.visibility = "visible";
// });

var element_take_picture = document.getElementById('startbutton');
var element_take_picture_upload = document.getElementById('startbuttonUpload');

if (document.getElementById("upload"))
{
var image1 = document.getElementById('image1');
var element_filter = document.getElementById('filter_image');
var img_camera = document.getElementById('filter_image_video');
image1.addEventListener('click', function()
{
	element_filter.src= "filter/rainbow.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
});

var image2 = document.getElementById('image2');
image2.addEventListener('click', function()
{
	element_filter.src= "filter/coeur_coeur.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
});

var image3 = document.getElementById('image3');
image3.addEventListener('click', function()
{
	element_filter.src= "filter/caticorn.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
});

var image4 = document.getElementById('image4');
image4.addEventListener('click', function()
{
	element_filter.src= "filter/cat.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
});

var image5 = document.getElementById('image5');
image5.addEventListener('click', function()
{
	element_filter.src= "filter/licorne.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
});

var image6 = document.getElementById('image6');
image6.addEventListener('click', function()
{
	element_filter.src= "filter/omg.png";
	element_filter.style.visibility= "visible";
	element_take_picture.style.visibility = "hidden";
	element_take_picture_upload.style.visibility = "visible";
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
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";

});

var image2 = document.getElementById('image2');
image2.addEventListener('click', function()
{
	element_filter_video.src= "filter/coeur_coeur.png";
	element_filter_video.style.visibility= "visible";
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";
});

var image3 = document.getElementById('image3');
image3.addEventListener('click', function()
{
	element_filter_video.src= "filter/caticorn.png";
	element_filter_video.style.visibility= "visible";
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";
});

var image4 = document.getElementById('image4');
image4.addEventListener('click', function()
{
	element_filter_video.src= "filter/cat.png";
	element_filter_video.style.visibility= "visible";
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";
});

var image5 = document.getElementById('image5');
image5.addEventListener('click', function()
{
	element_filter_video.src= "filter/licorne.png";
	element_filter_video.style.visibility= "visible";
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";
});

var image6 = document.getElementById('image6');
image6.addEventListener('click', function()
{
	element_filter_video.src= "filter/omg.png";
	element_filter_video.style.visibility= "visible";
	element_take_picture_upload.style.visibility = "hidden";
	element_take_picture.style.visibility = "visible";
});
});
