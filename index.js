
var element_connect = document.getElementById('button_connexion');
var bloc_connexion = document.getElementById('se_connecter');

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
	element_pop_up.style.visibility = "hidden";
	element.style.visibility = "hidden";
});

var button_connect = document.getElementById('open_connect');
button_connect.addEventListener('click', function()
{
	element_pop_up.style.visibility = "hidden";
	bloc_connexion.style.visibility = "visible";
});