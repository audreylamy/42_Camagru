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
  el.style.filter = "invert(100%)";
  el_video.style.filter = "invert(100%)";
});