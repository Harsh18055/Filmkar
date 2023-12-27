$(document).ready(function(){
	$("#image").change(function(e){
		var img = e.target.files[0];
		if(!iEdit.open(img, true, function(res){
			$("#result").attr("src", res);
			$("#base_profile_img").html(res);
		})){
			alert("Whoops! That is not an image!");
		}

	});
});