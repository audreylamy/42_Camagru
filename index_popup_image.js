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
				addCommentsPhoto(id_photo);
				show_nbLike(id_photo);
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

	console.log(id_user);
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
				console.log(login);
				console.log(profile_pic);
				// var login = login.replace('"', "");
				// var profile_pic = profile_pic.replace('"', "");
				if (profile_pic == undefined)
				{
					profile_pic = "img/photo2.png";
				}
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

function addCommentsPhoto(id_photo) 
{  
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
			if (httpRequest.status === 200) 
			{
				// console.log(httpRequest.responseText);
				// console.log(JSON.parse(httpRequest.responseText));
				var array = JSON.parse(httpRequest.responseText);
				var i = 0;
				while (array[i])
				{
					var login = array[i]['username'];
					var comment = array[i]['comment'];
					var profile_pic = array[i]['profile_pic'];
					console.log(login);
					console.log(comment);
					console.log(profile_pic);
						addComment(login, comment, profile_pic, i)
					i++;
				}
				// var login = login.replace('"', "");
				// var profile_pic = profile_pic.replace('"', "");
				// readURL2(profile_pic);
				// readInfo(login);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'find_all_comments.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}

function addComment(login, comment, profile_pic, i)
{
	var newDiv = document.createElement("div"); 
	newDiv.setAttribute("id", i);

	document.getElementById("profile_by_comments").appendChild(newDiv);   

	var newDiv1 = document.createElement("img"); 
	newDiv1.setAttribute("id", "profile_pic_comment_user");
	newDiv1.setAttribute("src", profile_pic);

	document.getElementById(i).appendChild(newDiv1);

	var newDiv2 = document.createElement("div"); 
	newDiv2.setAttribute("id", "name_comment_user");
	var newContent2 = document.createTextNode(login); 
	newDiv2.appendChild(newContent2);

	document.getElementById(i).appendChild(newDiv2);

	var newDiv3 = document.createElement("div"); 
	newDiv3.setAttribute("id", "comment_user");
	var newContent3 = document.createTextNode(comment); 
	newDiv3.appendChild(newContent3);

	document.getElementById(i).appendChild(newDiv3);   

	style_i = document.getElementById(i);
	style_i.style.display = "flex";
	style_i.style.margin = "3%";
}

function show_nbLike(id_photo)
{
	console.log("here");
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
			if (httpRequest.status === 200) 
			{
				var nb_like = JSON.parse(httpRequest.responseText);
				add_nbLike_DOM(nb_like);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'count_nblike.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}