<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Do Upload</title>
<?php include_once('../Includes/config.php');?>

	<SCRIPT TYPE="text/javascript">
		<!--
		function targetopener(mylink, closeme, closeonly)
		{
		if (! (window.focus && window.opener))return true;
		window.opener.focus();
		if (! closeonly)window.opener.location.href=mylink.href;
		if (closeme)window.close();
		return false;
		}
		//-->
	</SCRIPT>
	
	<style type = "text/css">
	a{
		color: balck;
		text-decoration: none;
		font: bold;
	}
	#wrap_doupload{
	position: relative;
	width: 400px;
	height: 500px;
	border: 3px solid #ddd;	
	}
	body{
	background: url('../images/liverbird_gray.png') left repeat-y;
	}
	
	</style>
	<link rel="Shortcut Icon" href="../Images/This-is-anfield.ico" type="image/x-icon" /><!--Icon for site-->
</head>

<body>

<center><div id="wrap_doupload"  align = "center" >
	<?php
	$ImageDir = "../Image_Upload/";
		session_start();
		$today = date("Y-m-d");
		$numb = ($_SESSION['num']);
		if($_POST['Upload'] == 'Upload'){
			for ($i = 0; $i < $numb; $i++){
				$i_name = $i + $numb;
				$i_caption = $i + $numb*2;
				$i_tags = $i + $numb*3;
				
				$img_id = ($_SESSION['id'][$i]);
				$img_name = $_POST[$i_name];
				$img_user = "TDT";
				$img_caption = $_POST[$i_caption].'<br>';
				$img_tag = $_POST[$i_tags];
				$insert = "INSERT INTO images (image_id, image_name, image_user, image_caption, image_tag, image_date)
				VALUES 
				('$img_id', '$img_name', '$img_user', '$img_caption',  '$img_tag', '$today')";
				$insertresults = mysql_query($insert) or die(mysql_error());
						
			}
				echo "<center><br>Upload thành công ".$numb." ảnh  </center><br>";
				echo '<center><img width = "120" src ="../images/like.png"/><br>_________________<br></center>';
		}
		if($_POST['Upload'] == 'Cancel'){
			echo "<center>Hủy up load thành công</center>";
			for ($i = 0; $i < $numb; $i++){
			$img_id = ($_SESSION['id'][$i]);
			$i_to_del = $ImageDir.$img_id;
			if(unlink($i_to_del)) {
			echo "!";
			}
			else
			{echo "?";}
			
		}
		}
	
	
	
	
 	?>
    <div id = "click_close" align = "center">
    	<center><A HREF="../index.php" onClick="return targetopener(this,true)" CLASS="referback"><img width = "100" src = "../images/home_black.png"><br>Quay lại trang chủ</A>
		
		<br>_________________<br><br>HOẶC<br>__________________<br>
		<A HREF="upload.php" onClick="return targetopener(this,true)" CLASS="referback"><img  width = "100" src = "../images/up_photo.png"><br>Tiếp tục upload</A></center>
    </div>
</div></center>
</body>
</html>