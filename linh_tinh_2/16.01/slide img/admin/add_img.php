<? session_start();?>
<html>
<head>
<title>Upload smilies</title>
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

  $max_file=930;
  ?>
<form method="post" enctype="multipart/form-data" name="form1" action="">
	Nhập số smiles cần upload 1 lần (< <? echo"$max_file"; ?>)<input type="text" name="sofile">
	<input type="submit" name="cmd" value="Thêm"><br>

    
    </form>
	<form method="post" enctype="multipart/form-data" name="form1" action="?act=add_img2">
    <table width="300" border="0" cellpadding="0" cellspacing="0">
    <?	
	if($_REQUEST["cmd"]=="Thêm"){
			$sofile=$_REQUEST["sofile"];
			if($sofile>=$max_file){
				echo("Bạn chỉ được upload tối đa $max_file file");
			}
			else{
	
	
	        for($i=1;$i<=$sofile;$i++){
				echo ("<tr><td width=50>File {$i}</td><td><input type='file' name='f{$i}'></td> </tr> ");
			}
			echo "<input type='hidden' name=sofile  value=sofile>";
			echo("<tr><td><input type='submit' name='cmd1' value='Upload'></td></tr>");
			}}
		
		
	?>
    
</table></form>
</body>
</html>
