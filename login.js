var log_in = document.getElementById("log_in");

log_in.addEventListener('click', function()
{
	var login = document.getElementById("login1").value;
	var password = document.getElementById("password").value;
	logIn_user(login, password)
});

function logIn_user(login, password) 
{
	var formData = new FormData();
	formData.append('login', login);
	formData.append('password', password);

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
				// alert(httpRequest.responseText);
				location.reload();
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'login.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}
