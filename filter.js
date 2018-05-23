
var grayscale = document.getElementById('grayscale');
grayscale.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "grayscale(1)";
  }
  else
  {
    el.style.filter = "grayscale(1)";
  }
});

var sepia = document.getElementById('sepia');
sepia.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "sepia(1)";
  }
  else
  {
    el.style.filter = "sepia(1)";
  }
});

var saturate = document.getElementById('saturate');
saturate.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "saturate(8)";
  }
  else
  {
    el.style.filter = "saturate(8)";
  }
});

var contrast = document.getElementById('contrast');
contrast.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "contrast(4)";
  }
  else
  {
    el.style.filter = "contrast(4)";
  }
});

var hue_rotate_green = document.getElementById('hue-rotate1');
hue_rotate_green.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "hue-rotate(90deg)";
  }
  else
  {
    el.style.filter = "hue-rotate(90deg)";
  }
});

var hue_rotate_blue = document.getElementById('hue-rotate2');
hue_rotate_blue.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "hue-rotate(230deg)";
  }
  else
  {
    el.style.filter = "hue-rotate(230deg)";
  }
});

var hue_rotate_pink = document.getElementById('hue-rotate3');
hue_rotate_pink.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "hue-rotate(300deg)";
  }
  else
  {
    el.style.filter = "hue-rotate(300deg)";
  }
});

var invert = document.getElementById('invert');
invert.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "invert(100%)";
  }
  else
  {
    el.style.filter = "invert(100%)";
  }
});

var no_filter = document.getElementById('no_filter');
no_filter.addEventListener('click', function()
{
  var el = document.getElementById('img');
  var el_video = document.getElementById('video');
  var element_video = document.getElementById('video_space');
  if (element_video.style.visibility === "visible")
  {
    el_video.style.filter = "none";
  }
  else
  {
    el.style.filter = "none";
  }
});