var FILTER_VALS = {};
var el = document.getElementById('img');
var el_video = document.getElementById('video');
function set(filter, value) 
{
    FILTER_VALS[filter] = typeof value == 'number' ? Math.round(value * 10) / 10 : value;
    if (value == 0 || (typeof value == 'string' && value.indexOf('0') == 0)) 
  {
    delete FILTER_VALS[filter];
   }
    render();
}

function render() 
{
    var vals = [];
  Object.keys(FILTER_VALS).sort().forEach(function(key, i) 
  {
    vals.push(key + '(' + FILTER_VALS[key] + ')');
   });
    var val = vals.join(' ');
   
    el.style.filter = val;
    el_video.style.filter = val;
}

var invert = document.getElementById('invert');
invert.addEventListener('click', function()
{
  el.style.WebkitFilter = "invert(100%)";
  el_video.style.WebkitFilter = "invert(100%)";
});

var no_filter = document.getElementById('no_filter');
no_filter.addEventListener('click', function()
{
  var grayscale = document.getElementById('grayscale');
  grayscale.value = 0;
  var sepia = document.getElementById('sepia');
  sepia.value = 0;
  var blur = document.getElementById('blur');
  blur.value = 0;
  var saturate = document.getElementById('saturate');
  saturate.value = 0;
  var contrast = document.getElementById('contrast');
  contrast.value = 0;
  var brightness = document.getElementById('brightness');
  brightness.value = 0;
  var hue_rotate = document.getElementById('hue_rotate');
  hue_rotate.value = 0;
  el.style.WebkitFilter = "none";
  el_video.style.WebkitFilter = "none";
  location.reload();
});