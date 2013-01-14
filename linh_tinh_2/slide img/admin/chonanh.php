<html>
<head>
<title>Chọn file ảnh</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<h1 align="center">Chọn ảnh</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?
/*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/

$a = opendir("../images");
$i=0;
while($f=readdir($a)){
	
	if ($f!="." && $f!=".."){
		$b = substr($f,strlen($f)-3,3);
		
		if ($b=="jpg" || $b =="jpe" || $b=="gif"){
		if ($i==0) echo "<tr>";
		$i++;
		echo "<td><a title='Chọn file $f' href=# onclick=\"window.opener.document.select.anh.value='$f'; window.close();\"><img border=0 width=80 src=../images/".$f." height=60></a><br>
		</td>";
		if ($i==2) {echo "</tr>"; $i=0;}
		}
	}
}
?>
</table>
</body>
</html>
