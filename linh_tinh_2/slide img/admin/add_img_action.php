<? session_start();
if ($_SESSION["login"]!=true){
	$_SESSION["loi"]="Ban chua dang nhap nen ko vao duoc quan tri!";
	echo "<script>window.location='login.php';</script>";
}
/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/
	require("connect.php");
	
	for($i=1;$i<=9;$i++){
		if($_POST["anh$i"]==""){echo"";}else{
	$sql = "insert into anh(linkanh,matheloai) values ('{$_POST["anh$i"]}','{$_POST["theloai"]}')";
	mysql_query($sql);}
	}
	echo"<script>window.location='$admin?act=view_smile';</script>";
?>