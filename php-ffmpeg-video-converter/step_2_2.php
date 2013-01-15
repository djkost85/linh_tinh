<?php
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Convert video....</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jquery.js"></script>
</head>

<body>

<?php

$type=$_POST['type'];
if (isset($_POST['size'])) {$size=$_POST['size'];} 
if (isset($_POST['quality'])) {$quality=$_POST['quality'];}
if (isset($_POST['audio'])) {$audio=$_POST['audio'];}

if($type=="webm" && $audio=="11025"){$audio="22050";$type="webm"; }// for webm  audio can not be 11050
if($type=="ogg" && $audio=="11025"){$audio="22050"; $type="ogg"; }// for ogg  audio can not be 11050

$converted_vids=$_SESSION['converted_vids'];
$temp_dir=$_SESSION['temp_dir'];
$name=$_SESSION['name'];
$_SESSION['type']=$type;

?>


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


	//define a settings for converting to specific video format
	
	if($type=="flv"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec flv -f flv -r 30 -b ".$quality." -ab 128000 -ar ".$audio." -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	
	if($type=="avi"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec mjpeg -f avi -acodec libmp3lame -b ".$quality." -s ".$size." -r 30 -g 12 -qmin 3 -qmax 13 -ab 224 -ar ".$audio." -ac 2 ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	if($type=="mp3"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vn -acodec libmp3lame -ac 2 -ab 128000 -ar ".$audio."  ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	if($type=="mp4"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']."  -vcodec mpeg4 -r 30 -b ".$quality." -acodec aac -strict experimental -ab 192k -ar ".$audio." -ac 2 -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	if($type=="wmv"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec wmv1 -r 30 -b ".$quality." -acodec wmav2 -ab 128000 -ar ".$audio." -ac 2 -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	if($type=="ogg"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec libtheora -r 30 -b ".$quality." -acodec libvorbis -ab 128000   -ar ".$audio." -ac 2 -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
	if($type=="webm"){ $call="ffmpeg -i ".$_SESSION['video_to_convert']." -vcodec libvpx  -r 30 -b ".$quality." -acodec libvorbis -ab 128000   -ar ".$audio." -ac 2 -s ".$size." ".$converted_vids.$name.".".$type." -y 2> log/".$name.".txt";}
	
/* START CONVERTING */
		
	$convert = (popen("start /b ".$call, "r"));
	
	pclose($convert);
		
// define sessions

$_SESSION['name']=$name;
$_SESSION['dest_file']=$converted_vids.$name;
	
?>

<?php
// read every 1 second file listening.php to see if the converting has any errors or to see is it finished

echo "<script>\n";
  echo "$(document).ready(function()\n";
  echo "{\n";
	echo "var refreshId = setInterval(function() \n";
   echo "{\n";
	 echo "$('#timeval').load('listening.php?randval='+ Math.random());\n";
   echo "}, 1000);\n";
    echo "});\n";
  echo " </script>\n";
  
  ?>
<div id="timeval">info:<br /></div>	
		
		
<?php	
		
		/* END CONVERTING */
		



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
</center>


</body>
</html>
