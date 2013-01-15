<?php
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step 3 - get image from video</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<center>
<table width="543" height="244" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td height="106"><img src="web_images/top_3.jpg" width="543" height="106"></td>
  </tr>
  <tr>
    <td style="background-image:url(web_images/sides.jpg); background-repeat:repeat-y">
	<center>
	<?php
	
	
	$name=$_SESSION['name'];
	$type=$_SESSION['type'];
	$duration=$_SESSION['duration'];
	
	// calculate time
	// convert total time of video into seconds and split it by 2, that will be time used for getting picture from video
	
	$time_in_seconds=round($_SESSION['time_in_seconds']/2); 
	
	// if output format is mp3 do not take picture from file !
	if($type !="mp3")
	
	{
	
	//execute ffmepg to get picture
	exec("ffmpeg -vframes 1 -ss ".$time_in_seconds." -i converted_vids/".$name.".".$type." video_images/".$name."_%02d.jpg -y 2> log_image/".$name.".txt");
   		$_SESSION['image_name']="video_images/".$name."_01.jpg";
	?>This is image from your video:<br />
	<img src="video_images/<?php echo $name; ?>_01.jpg" width="300" />
	<?php
	// display created image
	echo "<br><a href=\"step_4.php\" border=\"0\"><br><img src=\"icons/arrow-right.png\" border=\"0\" /></a>";
	
	}
	
	 // if the output format is mp3 display a note
	 
	 else{ echo "There is no picture for mp3 files!";echo "<br><a href=\"step_4.php\" border=\"0\"><br><img src=\"icons/arrow-right.png\" border=\"0\" /></a>";}
	
	
	/************************************************************************************************
	/*       		USABLE VARIABLES  																*
	/*																								*
	/*	This variables you can use in your project, for example to store them in database         	*
	/*                                        													  	*
	/* $_SESSION['name'] - new video name -  like 0779135001284199787							  	*
	/* $_SESSION['type'] - converted video format - like flv										*
	/* $_SESSION['duration'] - duration of a output file - like 00:05:13							*	
	/* $_SESSION['time_in_seconds'] - duration of a output file in seconds - like 313				*
	/* $_SESSION['image_name'] - image file - like video_images/0779135001284199787_01.jpg 				*
	/*																								*
	/***********************************************************************************************/
	
	
	/*   uncoment this to see results of those variables
	
	echo "<br>name: ".$_SESSION['name'];
	echo "<br>type: ".$_SESSION['type'];
	echo "<br>duration: ".$_SESSION['duration'];
	echo "<br> duration in sec: ".$_SESSION['time_in_seconds'];
	echo "<br>image: ".$_SESSION['image_name'];
	*/
	?>

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
