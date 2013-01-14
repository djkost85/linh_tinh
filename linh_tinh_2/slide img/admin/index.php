<? session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Share Smilies Control Panel</title>
<link rel="stylesheet" href="stylecp.css" type="text/css">
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
?>
<center>Admin Control Panel</center>
<table width="766" height="464" border="3" bordercolor="#0066CC" cellpadding="2" cellspacing="1">
  <tr>
    <td height="15" bgcolor="#CCCCCC"> <a href="../index.php" title="Vào trang chủ"><b>Trang Chủ</b></a> | <a href="?act=logout" title="Thoát"><b>Thoát</b></a></td>
    <td width="630" rowspan="2" align="center" valign="top">
    
   <?

switch($act){
  case "login";
      include "login.php";
     break;
  case "logout";
      include "logout.php";
     break;
  case "add_img";
      include "add_img.php";
	   break;	  
  case "view_smile";
      include "view_smile.php";
     break;	  
  case "add_user";
      include "add_user.php";
     break;
  case "view_theloai";
      include "view_theloai.php";
     break;
  case "them_theloai";
      include "them_theloai.php";
     break;
  case "view_user";
      include "view_user.php";
     break;
  case "add_user";
      include "add_user.php";
     break;
  case "xoa_user";
      include "xoa_user.php";
     break;	 
  case "add_img2";
      include "add_img2.php";
     break;
  case "sua_theloai";
      include "sua_theloai.php";
     break;
  case "xoa_theloai";
      include "xoa_theloai.php";
     break;
  case "xoa_smile";
      include "xoa_smile.php";
     break;	 
} 
?>
    
    </td>
  </tr>
  <tr>
    <td width="180" height="469" valign="top">
    
    <a href="?act=add_user">Thêm user (Admin)</a><br>
    <a href="?act=view_user">Quản lý user</a><br>
    <hr>
    <a href="?act=them_theloai">Thêm thể loại</a><br>
    <a href="?act=view_theloai">Quản lý thể loại</a><br>
    <hr>
    <a href="?act=add_img">Thêm smiles</a><br>
    <a href="?act=view_smile">Quản lý smile</a><br>
    
    
    
    </td>
    
  </tr>
</table>
</body>
</html>