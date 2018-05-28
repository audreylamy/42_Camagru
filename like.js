function like(id_user) 
{
	var image_coeur = document.getElementById("image_coeur");
	image_coeur.style.visibility = "visible";

	var image_path = document.getElementById("image_final").src;

	var formData = new FormData();
	formData.append('image_path', image_path);
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
			if (httpRequest.status === 200) 
			{
				// console.log(httpRequest.responseText);
				var nb_like = JSON.parse(httpRequest.responseText);
				add_nbLike_DOM(nb_like);
				var image_coeur = document.getElementById("image_coeur");
				image_coeur.style.visibility = "hidden";
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'like.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

function add_nbLike_DOM(nb_like)
{
	var bloc_like = document.getElementById('like');
	bloc_like.innerHTML= nb_like;
}