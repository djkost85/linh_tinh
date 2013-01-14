<? session_start();?>

<html>
<head>
<title>Chọn thể loại cần thêm cho Smilies</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>


<?

/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/


if ($_SESSION["login"]!=true){
	$_SESSION["loi"]="Ban chua dang nhap nen ko vao duoc quan tri!";
	echo "<script>window.location='login.php';</script>";
}

			if($_REQUEST["cmd1"]=="Upload"){
				
				for($i=1;$i<=9;$i++){
					$a = $_FILES["f{$i}"]["tmp_name"];
					$b = $_FILES["f{$i}"]["name"];
					$d = $_FILES["f{$i}"]["size"];
					$c = substr($b,strlen($b)-3,3);
					if($d>350000){
						echo("Dung lượng giới hạn là 350000 KB. File <b>{$b}</b> đã vượt quá giới hạn cho phép <br>");
					}else{
					if($c=="jpg"||$c=="jpe"||$c=="gif"||$c=="bmp"||$c=="png"){
						$tenfile = chiplove.rand(0,999)._.$b;
						move_uploaded_file($a,"../images/".$tenfile);
						
							echo"<form name=chonanh method=post action=add_img_action.php>
							<input type=text name=anh$i value=$tenfile><br>";
					
    
		}
					if($_REQUEST["f{$i}"]==""){echo"";}
					else{
						echo("Upload không thành công!<br>");
						}
					}
				
					}
			}
		
        					require("connect.php");
							$rs = mysql_query("select * from theloai");
							echo"<select name=theloai>";
							while ($r=mysql_fetch_array($rs)){
								echo"Thể loại";
                           
							 echo"<option value=$r[0]>$r[0] - ".$r["tentheloai"]."</option>";
							 
							}
					
							echo"</select>";
							echo"";
                            
                            ?>
        
        <input name=chon type=submit value=Xong>