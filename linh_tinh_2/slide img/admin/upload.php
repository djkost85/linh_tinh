<html>
<head>
<title>Upload file ảnh</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>


<body>







<form enctype="multipart/form-data" method="post">
 <div align="center">
   <h1>Upload file 
   </h1>
 </div>

 
 <table width="400" border="0" align="center" cellpadding="3" cellspacing="3">
    <tr>
      <td>Chon file 1: </td>
      <td><input name="f1" type="file" id="f1"></td>
    </tr>

	
    <tr>
      <td>&nbsp;</td>
      <td><input name="cmd" type="submit" id="cmd" value="Upload">
      <input type="reset" name="Reset" value="Reset"></td>
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
	if ($_REQUEST["cmd"] =="Upload"){
		$a = $_FILES["f1"]["tmp_name"];
		$b = $_FILES["f1"]["name"];
		$c = $_FILES["f1"]["size"];
		$d = $_FILES["f1"]["type"];
		$e = $_FILES["f1"]["error"];
		
		
		echo strstr("image",$d); 
			
			if (substr($d,0,5)=="image"){
				$chiplove="www.chiplove.biz_";
				$fix="_";
				$tenfile=$chiplove.rand(00,99).$fix.$b;
		move_uploaded_file($a,"../images/".$tenfile);
		echo "Đã upload thành công file <b>{$b}</b>!<br>";
		
		echo "<a title='Chọn file này' href=# onclick=\"window.opener.document.select.anh.value='$tenfile'; window.close();\"><img border=0 width=80 src=../images/".$tenfile." height=60></a>";
		
		} else {
		echo "Upload không thành công!";
		}
	}
?>
</body>
</html>
