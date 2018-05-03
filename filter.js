var FILTER_VALS = {};
var el = document.getElementById('upload');
var el_video = document.getElementById('video_space');
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
    el.style.webkitFilter = val;
  el_video.style.webkitFilter = val;
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
  el.style.WebkitFilter = "none";
  el_video.style.WebkitFilter = "none";
});