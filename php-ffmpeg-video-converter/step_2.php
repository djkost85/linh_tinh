<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step 2 - your video is converting</title>

<script src="jquery.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<center>
<table width="543" height="282" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td height="106"><img src="web_images/top_2.jpg" width="543" height="106"></td>
  </tr>
  <tr>
    <td height="138" style="background-image:url(web_images/sides.jpg); background-repeat:repeat-y">
	<center>
	<table width="79%" style="padding:30px; ">
  <tr>
    <td><div align="center">
	
	<?php

// Getting a unique name of our new video file based on time stamp using microtime
$time=microtime();
$time=str_replace(".","",$time);
$time=str_replace(" ","",$time);

$name=$time; // this will be a new unique name for our video to prevent overwritng  of existing videos -- 
//note: you can change the way of naming your videos
$_SESSION['name']=$name;

// setting up max video size - by default php is set to 2 MB
$max_upload_size=40; // size is in MB

// define a folders to store converted temp and converted vids
$temp_dir="temp/";
$converted_vids="converted_vids/";
$_SESSION['converted_vids']=$converted_vids;
$_SESSION['temp_dir']=$temp_dir;


// if those directotires don't exist - create them and give them read/write permissions
if(!is_dir($temp_dir)) mkdir($temp_dir, 0777); 
if(!is_dir($converted_vids)) mkdir($converted_vids, 0777); 


if(isset($_FILES['file_vid']) && !empty($_FILES['file_vid']['name'])) 
	{ 
		// Checking extension of selected video - these extension are suported by ffmpeg
		
		$allowedExtensions = array("3gp","avi","mpg","mpeg","mpe4","mov","m4a","mj2","flv","wmv","mp4","ogg","webm");
		  foreach ($_FILES as $file) 
		  {
			if ($file['tmp_name'] > '') 
			{
			  if (!in_array(end(explode(".",
					strtolower($file['name']))),
					$allowedExtensions)) 
					{
					echo "<img src=\"icons/circle-alert.png\" border=\"0\" /><br>";
					echo $file['name']." is an invalid file type!<br>Supported files are:<br><strong>3gp,avi,mpg,mpeg,mpe4,mov,m4a,mj2,flv,wmv,mp4,ogg,webm</strong><br>";
		echo "<a href=\"step_1.php\">"."<img src=\"icons/arrow-left.png\" border=\"0\" /></a>";
		
					?>				
					
					
						</div></td>
					  </tr>
					</table>
					</center>
						
						
						 </td>
					  </tr>
					  <tr>
						<td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
					  </tr>
					</table>
					<?php
					   exit;
			  		}
			 }
			 
		   } 
		
		// get file size and convert it to MB's
		
		$filesize=$_FILES["file_vid"]["size"];
		$filesize = round(($filesize/1048576),2);
		
		//get extension
		$file_name=basename( $_FILES['file_vid']['name']) ;
		$filename=$temp_dir.$file_name;
		$extension = substr($file_name, strrpos($file_name, "."));
		$extension = strtolower($extension);
		
		// checking the size of uploading video
		
		if ($filesize > $max_upload_size) 
		
			{	echo "<img src=\"icons/circle-alert.png\" border=\"0\" /><br>";
				echo "Your video is to big(".$filesize." MB)! <br>Max video size is set to ".$max_upload_size." MB<br> Upload failed.<br>";
				echo "<a href=\"step_1.php\">"."<img src=\"icons/arrow-left.png\" border=\"0\" /></a>";
				?>
				</div></td>
  </tr>
</table>
</center>
	
	
	 </td>
  </tr>
  <tr>
    <td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
  </tr>
</table>
				
				<?php
				exit;
			}
			
		//echo "Size of your video: ".$filesize." MB<br>";
		
		//everething is OK  -> move uploaded file
		move_uploaded_file($_FILES["file_vid"]["tmp_name"],$temp_dir . $_FILES["file_vid"]["name"]);
		
		// rename our file to microtime name + extension of video - this will make easier for ffmpeg to read this uploaded file before converting(preventing video names with special characters)
		
		rename($filename, $temp_dir.$name.$extension); // this is new name for our video, something like 0342731001282903919.avi
		
		$video_to_convert=$temp_dir.$name.$extension;
		$_SESSION['video_to_convert']=$video_to_convert;
		
		echo "Choose a format, quality and size:<br";
		?>
		<center>
		<form name="choose" action="step_2_2.php" method="post" target="_self">
		<br />
		<div class="radio_buttons">
		flv
		<input  name="type" type="radio" class="blue_font" value="flv" onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;"/>
		mp4
		<input name="type" type="radio" value="mp4"  onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;"/>
		wmv
		<input name="type" type="radio" value="wmv" onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;" />
		avi
		<input name="type" type="radio" value="avi" onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;"/>
		mp3
		<input name="type" type="radio" value="mp3" onclick="javascript:document.choose.quality.disabled=true;document.choose.audio.disabled=false;document.choose.size.disabled=true;document.choose.OK.disabled=false;" /> 
		ogg
		<input name="type" type="radio" value="ogg" onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;document.choose.audio.low.disabled=true;"/>
		webm
		<input name="type" type="radio" value="webm" onclick="javascript:document.choose.quality.disabled=false;document.choose.audio.disabled=false;document.choose.size.disabled=false;document.choose.OK.disabled=false;"/>
		</div>
		<div class="radio_buttons">
		<br />Video quality:
		<select name="quality" class="radio_buttons" disabled="disabled">
		  <option value="1000000" >high</option>
		  <option value="800000">medium</option>
		  <option value="450000">low</option>
		</select>
		</div>
		<br />
		<div class="radio_buttons">Audio quality:
		<select name="audio" class="radio_buttons" disabled="disabled">
		  <option value="44100" >high</option>
		  <option value="22050">medium</option>
		  <option value="11025">low</option>
		</select>
		</div>
		<br />
		<div class="radio_buttons">Video size:
		<select name="size" class="radio_buttons" disabled="disabled" >
		  <option value="320x240">320x240</option>
		  <option value="512x384" selected="selected">512x384</option>
		  <option value="640x360">640x360</option>
		  <option value="854x480">854x480</option>
		  <option value="1280x720">1280x720</option>
		</select>
		</div>
		<br />
		<div class="radio_buttons">
		  <input name="OK" id="OK" type="submit" class="blue_font" disabled="disabled" />
		</div>
		</form ></center>
		
		<?php
		
		
		
	} else 
		{
		echo "<img src=\"icons/circle-alert.png\" border=\"0\" /><br>";
		echo "Error during file upload!<br>";
		echo "<a href=\"step_1.php\">"."<img src=\"icons/arrow-left.png\" border=\"0\" /></a>";
		?>
		 </div></td>
  </tr>
</table>
</center>
	
	
	 </td>
  </tr>
  <tr>
    <td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
  </tr>
</table>
		<?php
		exit;

		} ?>
	
	
	</div></td>
  </tr>
</table>
</center>
	
	
	 </td>
  </tr>
  <tr>
    <td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
  </tr>
</table>
</center>


</body>
</html>
