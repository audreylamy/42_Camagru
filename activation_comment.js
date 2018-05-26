function notification_activate(id_user)
{
	var formData = new FormData();
	formData.append('id_user', id_user);

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
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'activation_comment.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

function notification_desactivate(id_user)
{
	console.log(id_user);
	var formData = new FormData();
	formData.append('id_user', id_user);

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
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'desactivation_comment.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}