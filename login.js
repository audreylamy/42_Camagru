function logIn()
{
	var login = document.getElementById("login1").value;
	var password = document.getElementById("password").value;
	logIn_user(login, password);
	suppr_value_login();
};

function suppr_value_login()
{
	document.getElementById("login1").value = "";
	document.getElementById("password").value = "";
}

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
				// console.log(JSON.parse(httpRequest.responseText));
				var array = JSON.parse(httpRequest.responseText);
				var status = array['status'];
				var auth = array['auth'];
				var auth_true = array['auth_true'];

				if (status != null)
				{
					document.getElementById("status").innerHTML = status;
				}
				else 
				{
					document.getElementById("status").innerHTML = "";
				}
				if (auth != null)
				{
					document.getElementById("auth").innerHTML = auth;
				}
				else 
				{
					document.getElementById("auth").innerHTML = "";
				}
				if (auth_true == "true")
				{
					location.reload();
				}
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
