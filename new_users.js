function signUp()
{
	var first_name = document.getElementById("first_name").value;
	var last_name = document.getElementById("last_name").value;
	var login = document.getElementById("login").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password1").value;
	var confirm_password = document.getElementById("confirm_password").value;
	create_profile(first_name, last_name, login, email, password, confirm_password)
	suppr_value();
};

function suppr_value()
{
	document.getElementById("first_name").value = "";
	document.getElementById("last_name").value = "";
	document.getElementById("login").value = "";
	document.getElementById("email").value = "";
	document.getElementById("password1").value = "";
	document.getElementById("confirm_password").value = "";
}

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
				// console.log(JSON.parse(httpRequest.responseText));
				var array = JSON.parse(httpRequest.responseText);
				var error_first_name = array['error_first_name'];
				var error_last_name = array['error_last_name'];
				var error_login = array['error_login'];
				var error_email = array['error_email'];
				var error_password = array['error_password'];
				var error_confirm_password = array['error_confirm_password'];
				var true_connect = array['true_connect'];
				var error_verif_password = array['error_verif_password'];
				var error_connect = array['error_connect'];

				if (error_first_name != null)
				{
					document.getElementById("error_first_name").innerHTML = error_first_name;
				}
				else 
				{
					document.getElementById("error_first_name").innerHTML = "";
				}
				if (error_last_name !=null)
				{
					document.getElementById("error_last_name").innerHTML = error_last_name;
				}
				else 
				{
					document.getElementById("error_last_name").innerHTML = "";
				}
				if (error_login !=null)
				{
					document.getElementById("error_login").innerHTML = error_login;
				}
				else 
				{
					document.getElementById("error_login").innerHTML = "";
				}
				if (error_email !=null)
				{
					document.getElementById("error_email").innerHTML = error_email;
				}
				else 
				{
					document.getElementById("error_email").innerHTML = "";
				}
				if (error_password !=null)
				{
					document.getElementById("error_password").innerHTML = error_password;
				}
				else 
				{
					document.getElementById("error_password").innerHTML = "";
				}
				if (error_confirm_password !=null)
				{
					document.getElementById("error_confirm_password").innerHTML = error_confirm_password;
				}
				else 
				{
					document.getElementById("error_confirm_password").innerHTML = "";
				}
				if (true_connect !=null)
				{
					document.getElementById("true_connect").innerHTML = true_connect;
				}
				else 
				{
					document.getElementById("true_connect").innerHTML = "";
				}
				if (error_verif_password !=null)
				{
					document.getElementById("error_verif_password").innerHTML = error_verif_password;
				}
				else 
				{
					document.getElementById("error_verif_password").innerHTML = "";
				}
				if (error_connect !=null)
				{
					document.getElementById("error_connect").innerHTML = error_connect;
				}
				else 
				{
					document.getElementById("error_connect").innerHTML = "";
				}
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'new_users.php', true);
	httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	httpRequest.send(json);
}