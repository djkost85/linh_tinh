<? session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Đăng nhập</title>
</head>

<body>
<h1 align="center">Đăng nhập</h1>
<center><font color="red"><? echo $_SESSION["loi"];?></font></center>
<form action="" method="post">
	<table width="300" border="0" align="center">
  <tr>
    <td>Username:</td>
    <td><input name="t1" type="text" id="t1"></td>
  </tr>
  <tr>
    <td>Password:</td>
    <td><input name="t2" type="text" id="t2"></td>
  </tr>
  <tr>
    <td align="right"><input name="cmd" type="submit" id="cmd" value="Login"></td>
    <td><input type="reset" name="Reset" value="Reset"></td>
  </tr>
</table>

</form>



<?
/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/
if($_REQUEST["cmd"]=="Login"){
	require("connect.php");//ket noi
	$a = $_POST["t1"];
	$b = $_POST["t2"];
	$sql = "select * from user where tendn='{$a}' and pass='".md5($b)."'";
	$result = mysql_query($sql);
	if (mysql_num_rows($result)<=0){
		$_SESSION["loi"]="User va pass ko hop le!";
		$_SESSION["login"]=false;
		echo "<script>window.location='login.php';</script>";
	} else {
		$_SESSION["loi"]="";
		$_SESSION["login"]=true;
		$row=mysql_fetch_array($result);
		$_SESSION["id"]=$row["id"];
		$_SESSION["tendn"] = $row["tendn"];
		$_SESSION["pass"] = $b;
		echo "<center>Chào mừng: ".$_SESSION["tendn"]." đã đăng nhập thành công!";
		echo "<br>Kich vào <a href=../><b>đây</b></a> nếu ko muốn đợi lâu!";
		echo "<script>setTimeout(\"window.location='../';\", 3000);</script></center>";
	}
}
?>
</body>
</html>
