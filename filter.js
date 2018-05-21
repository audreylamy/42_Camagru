var el = document.getElementById('img');
var el_video = document.getElementById('video');
var filter_upload = document.getElementById('filter_image');
// var filter_video = document.getElementById('filter_image_video');

var grayscale = document.getElementById('grayscale');
grayscale.addEventListener('click', function()
{
  el_video.style.filter = "grayscale(1)";
  // filter_video.style.filter = "grayscale(1)";
  el.style.filter = "grayscale(1)";
  // filter_upload.style.filter = "grayscale(1)";
});

var sepia = document.getElementById('sepia');
sepia.addEventListener('click', function()
{
  el_video.style.filter = "sepia(1)";
  // filter_video.style.filter = "sepia(1)";
  el.style.filter = "sepia(1)";
  // filter_upload.style.filter = "sepia(1)";
});

var saturate = document.getElementById('saturate');
saturate.addEventListener('click', function()
{
  el_video.style.filter = "saturate(8)";
  // filter_video.style.filter = "saturate(8)";
  el.style.filter = "saturate(8)";
  // filter_upload.style.filter = "saturate(8)";
});

var contrast = document.getElementById('contrast');
contrast.addEventListener('click', function()
{
  el_video.style.filter = "contrast(4)";
  // filter_video.style.filter = "contrast(4)";
  el.style.filter = "contrast(4)";
  // filter_upload.style.filter = "contrast(4)";
});

var hue_rotate_green = document.getElementById('hue-rotate1');
hue_rotate_green.addEventListener('click', function()
{
  el_video.style.filter = "hue-rotate(90deg)";
  // filter_video.style.filter = "hue-rotate(90deg)";
  el.style.filter = "hue-rotate(90deg)";
  // filter_upload.style.filter = "hue-rotate(90deg)";
});

var hue_rotate_blue = document.getElementById('hue-rotate2');
hue_rotate_blue.addEventListener('click', function()
{
  el_video.style.filter = "hue-rotate(230deg)";
  // filter_video.style.filter = "hue-rotate(230deg)";
  el.style.filter = "hue-rotate(230deg)";
  // filter_upload.style.filter = "hue-rotate(230deg)";
});

var hue_rotate_pink = document.getElementById('hue-rotate3');
hue_rotate_pink.addEventListener('click', function()
{
  el_video.style.filter = "hue-rotate(300deg)";
  // filter_video.style.filter = "hue-rotate(300deg)";
  el.style.filter = "hue-rotate(300deg)";
  // filter_upload.style.filter = "hue-rotate(300deg)";
});

var invert = document.getElementById('invert');
invert.addEventListener('click', function()
{
  el_video.style.filter = "invert(100%)";
  // filter_video.style.filter = "invert(100%)";
  el.style.filter = "invert(100%)";
  // filter_upload.style.filter = "invert(100%)";
});

var no_filter = document.getElementById('no_filter');
no_filter.addEventListener('click', function()
{
  el_video.style.filter = "none";
  el.style.filter = "none";
});