<? session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>
<center><h2>Thêm user admin</h2>

<font color=red><? echo $_SESSION["ten"];?></font></center>
<form name="form1" method="post" action="">
  <table width="276" height="106" border="0" align="center">
    <tr>
      <td height="26">Tên đăng nhập</td>
      <td><label>
        <input type="text" name="t1" id="t1">
      </label></td>
    </tr>
    <tr>
      <td height="26">Mật khẩu</td>
      <td><label>
        <input type="text" name="t2" id="t2">
      </label></td>
    </tr>
    <tr>
      <td align="right"><label>
        <input type="submit" name="cmd" id="cmd" value="Thêm">
      </label></td>
      <td><label>
        <input type="reset" name="Reset" id="button" value="Hủy bỏ">
      </label></td>
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



if($_REQUEST["cmd"]=="Thêm"){
	require("connect.php");
	$a = $_POST["t1"];
	$b = $_POST["t2"];
	$user = "select * from user where tendn='{$a}'";
	$result = mysql_query($user);
	if (mysql_num_rows($result)>=1){
		$_SESSION["ten"]="Tên đăng nhập này đã có rồi";
		echo "<script>window.location='$admincp?act=add_user';</script>";}
		
		
		else{
	
	$sql="insert into user(tendn,pass) values ('{$_POST["t1"]}','".md5($_POST["t2"])."')";
	mysql_query($sql);
	
	echo"<script>window.location='$admincp?act=view_user';</script>";
}}
?>


</body>
</html>