function open_delete(id_photo)
{
	var delete_window = document.getElementById(id_photo);
	delete_window.style.visibility = "visible";
}

function close_delete(id_photo)
{
	var delete_window = document.getElementById(id_photo);
	delete_window.style.visibility = "hidden";
}

function delete_picture(id_photo)
{
	console.log(id_photo);
	var formData = new FormData();
	formData.append('id_photo', id_photo);

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
				// suppr_picture(id_photo);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'delete_picture.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

// function suppr_picture(id_photo)
// {
// 	// var parent = document.getElementById("view_pictures");
// 	var child = document.getElementsByClassName(id_photo);
// 	child.style.visibility ="hidden";
// 	// var throwawayNode = parent.removeChild(child);
// }
