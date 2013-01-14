
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thêm thể loại</title>
</head>

<body>


	<font color=red><? echo $_SESSION["themtheloai"];?></font>
<form name="select" method="post" action="">
  <table width="422" height="92" border="0" align="center">
    <tr>
      <td width="92" height="26">Tên thể loại</td>
      <td width="156"><label>
        <input type="text" name="theloai" id="theloai">
      </label></td>
      <td width="160">&nbsp;</td>
    </tr>
    <tr>
      <td height="28">Ảnh minh họa</td>
      <td><input type="text" name="anh"></td>
      <td><input type="button" value="Chọn ảnh"  onClick="window.open('chonanh.php','cuaso1','scrollbars=1,width=300,height=300');">
      <input type="button" value="Upload" onClick="window.open('upload.php','test1','width=350,height=280');"></td>
    </tr>
    <tr>
      <td height="28" align="right"><input type="submit" name="cmd" id="cmd" value="Thêm"></td>
      <td><input type="reset" name="button2" id="button2" value="Hủy bỏ"></td>
      <td>&nbsp;</td>
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
	if($_POST["theloai"]==""){
		$_SESSION["themtheloai"]="Bạn chưa nhập tên thể loại hoặc ảnh minh h ";
		echo"<script>window.location='?act=them_theloai';</script>";}
	else{	
	$sql = "insert into theloai(tentheloai,icon) values ('{$_POST["theloai"]}','{$_POST["anh"]}')";
	mysql_query($sql);
	mysql_close();
	echo"<script>window.location='?act=view_theloai';</script>";
	}
	}
?>


</body>
</html>