<? session_start();

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
	
	require("connect.php");
	$sql = "delete from user where id={$_REQUEST["id"]}";
	mysql_query($sql);
	mysql_close();
	echo "<script>window.location='$admin?act=view_user';</script>";



?>