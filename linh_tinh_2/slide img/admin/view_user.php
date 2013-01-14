<? session_start();?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>List member</title>
</head>

<body>

<?
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
	$sql = mysql_query("select * from user");
	if (mysql_num_rows($sql)<=0){
		echo"Chưa có thành viên nào<br>";}
		else{?>
			<table width="236" height="55" border="1" align="center">
  <tr>
    <td width="37">Mã</td>
    <td width="150" height="23">Tên đăng nhập </td>
    
   
    <td width="27">Xóa</td>
  </tr>
  <? while ($r=mysql_fetch_array($sql)) {?>
  <tr>
  <td><? echo $r["id"]; ?></td>
    <td><? echo $r["tendn"]; ?></td>
    
  
    <td width="27"><a onClick="return  confirm('Bạn có muốn xóa thành viên này ko');" href='?act=xoa_user&id=<? echo $r["id"];?>'>Xóa</a></td>
 </tr>

    <? }?>
  
</table>
<p align="center"><a href="?acp=add_user";">Thêm thành viên mới</a></p>
			<? }?>

</body>
</html>