function create_popup(id_photo) 
{
	var pop_up = document.getElementById("pop_up");
	pop_up.style.visibility = "visible";

	var formData = new FormData();
	formData.append('id', id_photo);

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
				// console.log(JSON.parse(httpRequest.responseText));
				var array = JSON.parse(httpRequest.responseText);
				var id_user = array[0];
				var image_path = array[1];
				var id_user = id_user.replace('"', "");
				var image_path = image_path.replace('"', "");
				readURL(image_path);
				findInfoProfile(id_user);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'find_image_path.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

function readURL(img_final) 
{  

	var image = document.getElementById('image_final');
	image.removeAttribute('src'); 
	image.src = img_final;
}


function findInfoProfile(id_user) 
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
			if (httpRequest.status === 200) 
			{
				// console.log(httpRequest.responseText);
				// console.log(JSON.parse(httpRequest.responseText));
				var array = JSON.parse(httpRequest.responseText);
				var login = array[0];
				var profile_pic = array[1];
				var login = login.replace('"', "");
				var profile_pic = profile_pic.replace('"', "");
				readURL2(profile_pic);
				readInfo(login);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'find_info_profile.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

function readURL2(img_final) 
{  
	var image = document.getElementById('avatar');
	image.removeAttribute('src'); 
	image.src = img_final;
}

function readInfo(login) 
{  
	var username = document.getElementById('username');
	username.innerHTML= login;
}