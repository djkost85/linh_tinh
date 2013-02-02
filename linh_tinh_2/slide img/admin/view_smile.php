<? session_start(); ?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Quản lý smilies</title>
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
	
	
	require("connect.php");
	$result = mysql_query("select * from anh order by maanh desc");
	$sobanghi=10;
	$sotrang = ceil(mysql_num_rows($result)/$sobanghi);
	$trang = $_REQUEST["page"];
	if ($trang<=0) $trang=1;
	if ($trang>$sotrang)  $trang=$sotrang;
	$result1=mysql_query("select * from anh  order by maanh desc limit ".($trang-1)*$sobanghi.",".$sobanghi);
	
	
	if (mysql_num_rows($result)<=0){
		echo "Chua co du lieu!";
	} else {
		
		
	?>


<table width="206" height="67" border="1" align="center">
  <tr>
    <td width="55" align="center">Mã</td>
    <td width="39" align="center">Smiles</td>
    <td width="51" align="center">Thể loại</td>
    <td width="33" align="center">Xóa</td>
  </tr>
  <? while ($r = mysql_fetch_array($result1)){?>
  <tr>
    <td height="36" align="center" valign="middle"><? echo $r["maanh"];?></td>
    <td align="center" valign="middle"><img src=../images/<? echo $r["linkanh"];?> width=30 height=30></td>
    <td align="center" valign="middle"><? echo $r["matheloai"];?></td>
    <td align="center" valign="middle"><a href="?act=xoa_smile&maanh=<? echo $r["maanh"];?>">Xoá</a></td>
  </tr><? } }?>
</table>
<center>
Trang: <? for($i=1;$i<=$sotrang;$i++)
		if($i==$trang)
				echo "&nbsp;<b><font color=black>[{$i}]</font></b>&nbsp;";
		else 
				echo "&nbsp;<a href='?theloai={$_REQUEST["theloai"]}&page={$i}'>{$i}</a>&nbsp;";
	?>
</center>
</body>
</html>