// (function() {
	
// 		var upload = document.getElementById('submit_picture');
// 		upload.addEventListener('click', function() 
// 		{
// 			var file = document.getElementById('download_picture').files[0];
			
// 			var formData = new FormData();
// 			formData.append('file', file);
// 			alert(formData);
// 			var httpRequest = new XMLHttpRequest();
	
// 			httpRequest.onreadystatechange = function(data) 
// 			{
// 				if (httpRequest.readyState === XMLHttpRequest.DONE) 
// 				{
// 					if (httpRequest.status === 200) 
// 					{
// 						console.log(httpRequest.responseText); 
// 						readURL(httpRequest.responseText);
// 					} 
// 					else 
// 					{
// 						console.log('Error: ' + httpRequest.status);
// 					}
// 				}
// 			};
	
// 			httpRequest.open('POST', 'upload_picture.php', true);
// 			httpRequest.send(formData);
// 		});
// 	})();
	
// 	function readURL(src) 
// 	{  
// 		image = document.getElementById('img');
// 		image.removeAttribute('src'); 
// 		image.src = src;

// 		div_upload = document.getElementById('upload');
// 		div_upload.visibility = "visible";
// 		startbuttonUpload = document.getElementById('startbuttonUpload');
// 		startbuttonUpload.visibility = "visible";
// 	}