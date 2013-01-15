<?php
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step 4 - preview yor video</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="flowplayer/flowplayer-3.2.4.min.js"></script>
	
	<!-- some minimal styling, can be removed -->
	<link rel="stylesheet" type="text/css" href="flowplayer/style.css">
</head>

<body>
<center>
<table width="543" height="244" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td height="106"><img src="web_images/top_4.jpg" width="543" height="106"></td>
  </tr>
  <tr>
    <td style="background-image:url(web_images/sides.jpg); background-repeat:repeat-y">
	<center>
	
	<?php
	echo "<br> output type: ".$_SESSION['type']."<br>";
	if ($_SESSION['type']=="flv")
		{
	
	?>
	
	
			<a  
				 href="<?php echo $_SESSION['dest_file'].".".$_SESSION['type']; ?>"  
				 style="display:block;width:480px;height:330px"  
				 id="player"> 
			</a> 
		
			<!-- this will install flowplayer inside previous A- tag. -->
			<script>
				flowplayer("player", "flowplayer/flowplayer-3.2.4.swf");
			</script>
		
		<?php
		}
		else
		{ 
		?>
		
		<a href="<?php echo $_SESSION['dest_file'].".".$_SESSION['type']; ?>"><u>Download your file!</u></a> 
		
		<?php
		}
		?>
	</center>
	<table width="90%">
  <tr>
    <td><div align="right" class="blue_font"><a href="step_1.php">convert new video</a></div></td>
  </tr>
</table>

	
	 </td>
  </tr>
  <tr>
    <td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
  </tr>
</table>
</center>


</body>
</html>
