<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> PHP Paint Pro V1.0 </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/jquery.js"></script>
  <script src="js/script.js"></script>
  </HEAD>
  <body>
  <div id="filter"></div>
	<!-------------- Image Effects ------------------->
	<div id="pushbuttonsfrommarkup">
	  <input type="button" id="upload_file" value="Upload Image">
	  <input type="button" id="original" value="Load Original">
	  <input type="button" class="img_action" id="undo" value="Undo">
	  <input type="button" class="img_action" id="redo" value="Redo">
	  <br>	
	  <input type="button" class="img_action" id="neg" value="Negative">
	  <input type="button" class="img_action" id="blr" value="Blur">
	  <input type="button" class="img_action" id="brg" value="Brighten">
	  <input type="button" class="img_action" id="clr" value="Colorize">
	  <input type="button" class="img_action" id="cntr" value="Contrast">
	  <input type="button" class="img_action" id="edgd" value="Edge Detect">
	  <input type="button" class="img_action" id="gray" value="Grayscale">
	  <input type="button" class="img_action" id="mean" value="Mean">
	  <input type="button" class="img_action" id="seleb" value="Selective Blur">
	  <input type="button" class="img_action" id="smth" value="Smoothen">
 	  <input type="button" class="img_action" id="rot" value="Rotate By">
	  <select id="angle" name="angle">
		<option value="90">90</option>
		<option value="180">180</option>
	  </select>

	  <input type="hidden" name="new_uploaded_image" id="new_uploaded_image" value="">
	  <input type="hidden" name="active_image" id="active_image" value="">

	  <div class="dialog" id="fileupload_box">
		<div id="d_header"> 
		  <div id="d_title">Upload file</div>
		  <div id="d_close"><a href="javascript:void(0);">X</a></div>
		</div>	
		<div id="b_body"><br>
		  <form name="upload_form" action="upload.php" method="POST" target="submit_frame" enctype="multipart/form-data">
			<input type="file" name="img" />
			<input type="submit" value="Upload">
		  </form>
		  <iframe name="submit_frame" id="iframe" frameborder="0">
			<link href="css/style.css" rel="stylesheet" type="text/css">
		  </iframe>
		</div>
	  </div>
	</div>
	<!--------------------------- Editor ----------------------------->
	<div class="editor_div">
		<div id="loading">
			<img src="images/progbar.gif" id="s">
		</div>
		<div id="editor">
		</div>
	</div>
 </body>
 </html>