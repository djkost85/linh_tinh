<?php
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include_once( 'class/class.upload.php' );
	if(isset($_POST['upload'])){
		$handle = new upload($_FILES['file_name']);
		$handle->allowed = array('image/*');
		if($handle->uploaded){
			$handle->image_frame           = 2;
			$handle->image_frame_colors    = '#FCFCFC #fffff #22222 #FF0000 #666666 #333333 #000000';
			$handle->process('uploads/');
			if ($handle->processed) {
				$message = '<div class="center"><p> That seems to be nice </p><img src="uploads/'.$handle->file_dst_name.'?'.time().'" alt="" /></div>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Norican" rel="stylesheet" type="text/css">
</head>
<body>
	
	<div id="top">
		<ul>
			<li><a href="example1.php"> Example 1</a></li>
			<li><a href="example2.php"> Example 2</a></li>
			<li><a href="example3.php"> Example 3</a></li>
			<li><a href="example4.php"> Example 4</a></li>
			<li><a href="example5.php"> Example 5</a></li>
			<li><a href="example6.php"> Example 6</a></li>
			<li><a href="example7.php"> Example 7</a></li>
			<li><a href="example8.php"> Example 8</a></li>
			<li><a href="example9.php"> Example 9</a></li>
			<li><a href="example10.php"> Example 10</a></li>
			<li><a href="example11.php"> Example 11</a></li>
			<li><a href="example12.php"> Example 12</a></li>
			<li><a href="example13.php"> Example 13</a></li>
		</ul>
	</div>
	<div id="header">
		<h2> 13 Magical Php Image Filters </h2>
	</div><!-- end header -->
	
	<div id="body">
		<div id="image">
			<?php
				if(isset($message)){
					echo $message;
				}
				else
				{
					echo '<h1> Providing frame to image </h1>';
				}
			?>
		</div><!-- end image -->	
		<div id="form">
			<form method="post" action="example7.php" enctype="multipart/form-data">
				<label for="Upload Image">Upload Image</label>
				<input type="file" name="file_name" />
				<input type="submit" name="upload" value="Upload" />
			</form>
		</div><!-- end form -->
		<div class="clear"></div>
		
	</div><!-- end body -->
</body>
</html>