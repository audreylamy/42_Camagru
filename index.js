
var element_connect = document.getElementById('button_connexion');
var bloc_connexion = document.getElementById('se_connecter');
element_connect.addEventListener('click', function()
{
	if (bloc_connexion.style.visibility == "visible")
	{
		bloc_connexion.style.visibility = "hidden";
	}
	else
	{
		bloc_connexion.style.visibility = "visible";
	}
});

element_connect.addEventListener('mouseover', function()
{
	element_connect.style.background = "#62bcfa";
});
element_connect.addEventListener('mouseout', function()
{
	element_connect.style.background = "#bbc4ef";
});

var element_forgot = document.getElementById('forgot_password');
var element_email = document.getElementById('forgot');
element_forgot.addEventListener('click', function()
{
	if (element_email.style.visibility == "visible")
	{
		element_email.style.visibility = "hidden";
	}
	else
	{
		element_email.style.visibility = "visible";
	}
});

var element_cross = document.getElementById('cross');
var element_pop_up = document.getElementById('pop_up');
element_cross.addEventListener('click', function()
{
	console.log("here");
	element_pop_up.style.visibility = "hidden";
});