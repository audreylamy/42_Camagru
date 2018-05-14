function send_comment(id_user) 
{
	var comment = document.getElementById("text_comments").value;
	var image_path = document.getElementById("image_final").src;

	var login = document.getElementById("hello").innerHTML;
	login = login.split(" ");
	login = login[1];
	var profile_pic = document.getElementById("img_profile1").src;

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
				// console.log(httpRequest.responseText);
				var comment = JSON.parse(httpRequest.responseText);
				add_comment_inside(login, profile_pic, comment);

				var login_user_picture = document.getElementById("username").innerHTML;
				console.log(login);
				console.log(login_user_picture);

				if (login != login_user_picture)
				{
					send_email(image_path, login_user_picture, comment);
				}
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

var i = -1;
function add_comment_inside(login, profile_pic, comment)
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
	i--;
}

function send_email(image_path, login_user_picture, comment)
{
	var formData = new FormData();
	formData.append('comment', comment);
	formData.append('login_user_picture', login_user_picture);
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
				// console.log(httpRequest.responseText);
				var email = JSON.parse(httpRequest.responseText);
				console.log(email);
			} 
			else 
			{
				console.log('Error: ' + httpRequest.status);
			}
		}
	};

	httpRequest.open('POST', 'send_email_comment.php', true);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send(json);
}