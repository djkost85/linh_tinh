<?php
	session_start();
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
<?php
	include("include/functions.php");
	include("include/config.php");
	$name = $_FILES['img']['name'];
	$tmp = $_FILES['img']['tmp_name'];
	$type = $_FILES['img']['type'];
	$new_name = time()."_".$_FILES['img']['name'];
	
	if($type == "image/jpeg" || $type == "image/gif" || $type == "image/jpg" || $type == "image/png" || $type == "image/pjpeg")
	{
		if(move_uploaded_file($tmp,"original/".$new_name))
		{
			echo '<img src="original/'.$new_name.'" class="thumb" width="220" height="200">';
			echo '<input type="hidden" name="img_name" id="img_name" value="'.$new_name.'">';
			echo '<script>
					set_name("'.$new_name.'");
				  </script>';
			session_destroy();
			$_SESSION['imgArray'][] = $new_name;
		}
		else
			echo err("Unexpected error");
	}
	else{
		echo err("Format not supported");
	}
?>