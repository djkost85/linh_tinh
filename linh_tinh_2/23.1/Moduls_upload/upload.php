<html>
    <head>
        <title>Upload Ảnh</title>
		<style type = "text/css">
			#upload2 input{
				width: 350px;
				}
				#cancel{
				width: 100px;
				}
				#upload2#cancel{
				width: 150px;
				}
					body{
	background: url('../images/liverbird_gray.png') left repeat-y;
	}
		TEXTAREA{
	font-family: georgia, helvetica, arial, sans-serif;
}		
		#homebtn{
		position: relative;
		margin-left: 2%;
		margin-top: 5%;
		}
		.okbtn{
		width: 80px;
		
		height: 30px;
		background: url('../images/lb28.png') right repeat-y ;
		
		}
		td{
		
		padding: 10px;
		}
		</style>
		
		<link rel="Shortcut Icon" href="../Images/linux.ico" type="image/x-icon" /><!--Icon for site-->

	</head>
	
	
	
	
    <body>
	<div id = "homebtn"
	<a href = "../index.php"><img width="44" src = "../images/home_black.png"/></a>
	</div>
	<div id = "wrap_upload" align = "center">
        <form id ="upload1" method="POST" action = "upload.php" enctype= "multipart/form-data" >
		    <p>Giữ Ctrl để chọn upload nhiều ảnh cùng lúc.</p>
			<table><tr>
			<td>Chọn ảnh upload: <input id="file" type="file" name="file[]" multiple /></td>
			<td><input type="submit" name="Okupload" value = "OK !" class = "okbtn"></td>			
			</tr></table>
		</form>
		
		<form name = "add_Caption" id ="upload2" method="POST" action = "doupload.php">
		<?php
		if (isset($_POST) AND isset($_POST['Okupload'])){
			session_start();
			$numb = count($_FILES['file']['name']);
				echo "Số ảnh uploaded : ".$numb; 
				$_SESSION['num'] = $numb;			
				$uploadDir = "../Image_Upload/";				
				echo "<table>";
				for ($i = 0; $i < $numb; $i++) {
					$ten = $i+$numb;
					$mota = $i+ $numb*2;
					$dactrung = $i + $numb*3;					
					$or_name = $_FILES['file']['name'][$i];
					 $ext = substr(strrchr($_FILES['file']['name'][$i], "."), 1); 
					 // generate a random new file name to avoid name conflict
					 $fPath = md5(rand() * time()) . ".$ext";
						$url[$i] = $uploadDir.$fPath;
						$_SESSION['id'][$i] = $fPath;
						
					//echo "File paths : ".$_FILES['file']['tmp_name'][$i]."<br>";
					 $result = move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadDir . $fPath);
					 echo "<tr border='2'>";
					 echo "<td ><img width = '220' src = '".$url[$i]."'/></td>";
					// echo "<td>Tên Ảnh<br><br> Mô Tả<br><br><br>Đặc Trưng<br></td>";
					 echo "<td>Tên Ảnh:<br><input type='text' name =".$ten." value = ".$or_name."><br>";
					 echo 'Mô Tả:<br><TEXTAREA NAME='.$mota.' COLS="45" ROWS="3"></TEXTAREA><br>';
					 echo "Đặc Trưng:<br><input type='text' name =".$dactrung." width='400'></td><br>";				 
					 echo "</tr>";

					}
					echo "</table><br/>";
					//echo "Upload complete.<br>";
				echo '<center><br><input type = "submit" name = "Upload" value = "Upload"/></center>';
				echo "hoặc<br>!!!!!!!!!!!!!!!!!!!!!!!!";
				echo '<center><br><input type = "submit" name = "Upload" value = "Cancel" id = "cancel" width="30"/></center>';
				}
			?>
			
		</form>
		</div>
	</body>
</body>	