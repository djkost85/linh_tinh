<? session_start();
if ($_SESSION["login"]!=true){
	$_SESSION["loi"]="Ban chua dang nhap nen ko vao duoc quan tri!";
	echo "<script>window.location='login.php';</script>";
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thể loại</title>
</head>

<body>



<? 
/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/
require("connect.php");
	$result = mysql_query("select * from theloai");
	if (mysql_num_rows($result)<=0){
		echo "Chua co du lieu!";
	} else {
	?>
		<table width="480" border="1" align="center">
  <tr>
    <td width="91">Mã thể loại </td>
    <td width="123">Tên thể loại </td>
    <td width="120">Icon</td>
   
    <td width="65">Sua</td>
    <td width="47">Xoa</td>
  </tr>
  <? while ($r = mysql_fetch_array($result)){?>
  <tr>
    <td><? echo $r["matheloai"];?></td>
    <td><? echo $r["tentheloai"];?></td>
    <td><img src=../images/<? echo $r["icon"];?> border=0 height=30></td>
   

    <td><a href="?act=sua_theloai&matheloai=<? echo $r["matheloai"];?>">Sửa</a></td>
    <td><a onClick="return  confirm('Bạn có muốn xóa thể loại này ko');" href="?act=xoa_theloai&matheloai=<? echo $r["matheloai"];?>">Xóa</a></td>
  </tr>
  <? } ?>
</table>

	<?
	}
	?>
	<center><a href=?act=them_theloai>Thêm thể loại</a>
    
    <br>
    
    
 
</body>
</html>