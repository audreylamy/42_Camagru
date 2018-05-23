
var bool=true;
function open_se_connecter()
{
	var bloc_connexion = document.getElementById('se_connecter');
	var forgot = document.getElementById('forgot');
	if(bool == true)
	{
		bloc_connexion.style.visibility = "visible";
		bool = false;
	}
	else
	{
		bloc_connexion.style.visibility = "hidden";
		forgot.style.visibility = "hidden";
		bool = true;
	}
}

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
	location.reload();
});

// var button_connect = document.getElementById('open_connect');
// button_connect.addEventListener('click', function()
// {
// 	element_pop_up.style.visibility = "hidden";
// 	bloc_connexion.style.visibility = "visible";
// });

function open_connect()
{
	var element_pop_up = document.getElementById('pop_up');
	var bloc_connexion = document.getElementById('se_connecter');
	element_pop_up.style.visibility = "hidden";
	bloc_connexion.style.visibility = "visible";
}