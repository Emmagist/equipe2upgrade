$(document).on('change', '#page-form #profileImage', function() {
	$("#image-required").empty(); // To remove the previous error message
	var file = this.files[0];
	var imagefile = file.type;
	var match= ["image/jpeg","image/png","image/jpg", "image/gif"];
	if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
		$('#previewing').attr('src',getURL()+'/images/placeholder.png');
		$("#image-required").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
		return false;
	}else {
		var filesize = ($("#profileImage")[0].files[0].size)/ 1024;
		if(filesize > 500){
			swal("Allowed file size exceeded. (Max. 500 KB)", "", "error");
		}
		else{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		}
	}
});
	

function imageIsLoaded(e) {
	$("#profileImage").css("color","green");
	//$('#image_preview').css("display", "block");
	$('#previewing').attr('src', e.target.result);
	$('#previewing').attr('width', '250px');
	$('#previewing').attr('height', '230px');
	$('#webcampPic').val(e.target.result); // set the hidden value to the base 64 encoding of the string
};
