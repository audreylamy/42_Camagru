

var sign_up = document.getElementById("sign_up");

sign_up.addEventListener('click', function()
{
	var first_name = document.getElementById("first_name").value;
	var last_name = document.getElementById("last_name").value;
	var login = document.getElementById("login").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password1").value;
	var confirm_password = document.getElementById("confirm_password").value;
	create_profile(first_name, last_name, login, email, password, confirm_password)
});

function create_profile(first_name, last_name, login, email, password, confirm_password) 
{
	var formData = new FormData();
	formData.append('first_name', first_name);
	formData.append('last_name', last_name);
	formData.append('login', login);
	formData.append('email', email);
	formData.append('password', password);
	formData.append('confirm_password', confirm_password);

	var object = {};
	formData.forEach(function(value, key)
	{
	  object[key] = value;
	});
	var json = JSON.stringify(object);

	var httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = function(data) 
	{
		if (httpRequest.readyState === XMLHttpRequest.DONE) 
		{
			if (httpRequest.status === 200 || httpRequest.status === 0) 
			{
				console.log(httpRequest.responseText);
				location.reload();
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'new_users.php', true, 'toto', 'tata');
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send(json);
}