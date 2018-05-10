function send_comment(id_user) 
{
	var comment = document.getElementById("text_comments").value;
	var image_path = document.getElementById("image_final").src;

	var formData = new FormData();
	formData.append('id_user', id_user);
	formData.append('comment', comment);
	formData.append('image_path', image_path);

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
			if (httpRequest.status === 200) 
			{
				console.log(httpRequest.responseText);
				// console.log(JSON.parse(httpRequest.responseText));
				// var array = JSON.parse(httpRequest.responseText);
				// var id_user = array[0];
				// var image_path = array[1];
				// var id_user = id_user.replace('"', "");
				// var image_path = image_path.replace('"', "");
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'add_comment.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}
