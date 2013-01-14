<? session_start();?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sửa thể loại</title>
</head>

<body>


<?
/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/
	if($_SESSION["login"]!=true){
		echo $_SESSION["loi"]=="Bạn chưa đăng nhập nên ko thể vào quản trị";
		echo"<script>window.location='login.php';</script>";}

	require("connect.php");
	$result=mysql_query("select * from theloai where matheloai={$_REQUEST["matheloai"]}");
	$row=mysql_fetch_array($result);
	
?>


<form  name=select action="" method="post">
<h1 align="center">Sửa thể loại</h1>

<table width="500"  border="0" align="center" cellpadding="0" cellspacing="3">
  <tr>
    <td width="121">Tên thể loại:</td>
    <td width="370"><input name="t1" type="text" id="t1" value="<? echo $row["tentheloai"];?>"></td>
  </tr>
  <tr>
    <td>Hình minh họa: <img src=../images/<? echo $row["icon"];?> height=20 width=20></td>
    <td><input name="anh" type="text" id="t2" value="<? echo $row["icon"];?>">
    
    
    <input type="button" value="Chọn ảnh"  onClick="window.open('chonanh.php','cuaso1','scrollbars=1,width=300,height=300');">
      <input type="button" value="Upload" onClick="window.open('upload.php','test1','width=350,height=280');">
    
    </td>
  </tr>
 
  <tr>
  	<input type=hidden  name="matheloai" value="<? echo $row["matheloai"];?>">
    <td align="right"><input type="submit" name="cmd" value="Sửa"></td>
    <td><input type="reset" name="Submit2" value="Reset"></td>
  </tr>
</table>
</form>

<?
	if($_REQUEST["cmd"]=="Sửa"){
	require("connect.php");
	$sql = "update theloai set tentheloai='{$_POST["t1"]}', icon='{$_POST["anh"]}' 
	 where  matheloai={$_POST["matheloai"]}";
	 
	mysql_query($sql);
	mysql_close();
	echo "<script>window.location='$admin?act=view_theloai';</script>";
	}
?>








</body>
</html>