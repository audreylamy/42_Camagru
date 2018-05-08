//envoie photo camera dans gallery puis sauvegarde dans la BDD

var element_pop_up = document.getElementById('pop_up');
var element_yes = document.getElementById('yes');

element_yes.addEventListener('click', function()
{
	var div = document.getElementById("image_final");
	var target = div.getAttribute("src");

	var get = new XMLHttpRequest();
	get.open("POST", "save.php", true);
	get.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	get.send('target=' + target);
	get.onreadystatechange = function () 
	{
		  if (get.readyState != 4 || get.status != 200) return;
		  {
			  alert(get.responseText);
			  location.reload();
		  }
	};
	element_pop_up.style.visibility = "hidden";
});

var element_cancel = document.getElementById('cancel');
element_cancel.addEventListener('click', function()
{
	element_pop_up.style.visibility = "hidden";
});