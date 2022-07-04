$(document).ready(function(){
	$(".dropzone").dropzone({
	  url: 'file_upload.php',
	  width: 300,
	  height: 300, 
	  progressBarWidth: '100%',
	  maxFileSize: '5MB'
	})
});