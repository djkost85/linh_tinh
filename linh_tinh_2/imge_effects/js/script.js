$(document).ready(function(){
	$("#new_uploaded_image").val("");
	$("#filter").fadeTo("fast","0.9");
	$("#upload_file").click(function(){
		$("#filter").fadeIn("slow",function(){
			$("#editor").fadeOut("slow");
			$(".dialog").fadeIn("slow");
		});
	});
	$("#d_close").click(function(){
		$(".dialog").fadeOut("slow",function(){
			$("#filter").fadeOut("slow",function(){
				set_image('original');
			});
		});
	});
	$("#original").click(function(){
		new_uploaded_image = $("#new_uploaded_image").val();
		$("#editor").fadeOut("slow",function(){
			$("#editor").fadeIn("slow").html('<img src="original/'+new_uploaded_image+'">');
			$("#active_image").val(new_uploaded_image);
		});
	});
	$(".img_action").click(function(){
		new_uploaded_image = $("#new_uploaded_image").val();
		active_image = $("#active_image").val();
		act = $(this).attr("id");
		if(new_uploaded_image != "")
		{	
			if(act == "rot")
			{
				angle = $("#angle").val();
				extra_params = "&angle="+angle;
			}
			else
				extra_params = "";
			if(active_image == "")
				$("#active_image").val(new_uploaded_image);
			$("#loading").fadeIn("slow");
			$("#editor").fadeOut("slow",function(){
				$.ajax({
				   type: "POST",
				   url: "processImage.php",
				   data: "act="+act+"&img="+active_image+extra_params,
				   success: function(file_name){
					 //alert(file_name);
					 $("#editor").html('<img src="original/'+file_name+'">').fadeIn("slow");
					 $("#active_image").val(file_name); 
				   }
				 });
				 $("#loading").fadeOut("slow");
			});
		}
	})
});
function set_name(name)
{
	window.parent.document.getElementById("new_uploaded_image").value = name;
	window.parent.document.getElementById("active_image").value = name;
}
function set_image(path)
{
	new_uploaded_image = $("#new_uploaded_image").val();
	$("#editor").html('<img id="cropbox" src="'+path+'/'+new_uploaded_image+'">');
	$("#editor").fadeIn("slow");
	height = $("#editor >img").height();
	width = $("#editor >img").width();
	if(width < $(window).width()) 
		$(".editor_div").css("width",width);
	if(height < $(window).width()) 
		$(".editor_div").css("height",height);
}