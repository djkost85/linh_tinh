<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step 1 - select your video!</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]> <script type="text/javascript">alert("To make this web app work properly please add it to yours trusted sites! Please go to:Tools-> Internet Oprions -> Security->Trusted Sites");</script> <![endif]-->

<!--[if IE 8]> <script type="text/javascript">alert("To make this web app work properly please add it to yours trusted sites! Please go to:Tools-> Internet Oprions -> Security->Trusted Sites");</script> <![endif]-->


<script language="javascript">

function ShowDiv()
{
document.getElementById("loading").style.display = '';
}

function check_extension() 
{ 
var allowed = {'flv':1,'avi':1,'3gp':1,'mpg':1,'mpeg':1,'mpe4':1,'mov':1,'m4a':1,'mj2':1,'wmv':1,'mp4':1,'ogg':1,'webm':1};
 var fileinput = document.getElementById("file_vid");
	
	var y = fileinput.value.split(".");
	var ext = y[(y.length)-1];
	ext=ext.toLowerCase();
	
	if (allowed[ext]) {
        document.chooseF.confirm.disabled = false;
		return true;
      } else {
        alert("This is an unsupported file type. Supported files are: 3gp,avi,mpg,mpeg,mpe4,mov,m4a,mj2,flv,wmv,mp4,ogg,webm");
        document.chooseF.confirm.disabled = true;
		return false;
      }


}


</script>
</head>
<body>

<center>
<table width="543" height="144" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td height="106"><img src="web_images/top_1.jpg" width="543" height="106"></td>
  </tr>
  <tr>
    <td style="background-image:url(web_images/sides.jpg); background-repeat:repeat-y">
	<center>
	<table width="45%" style="padding:30px;">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	
	<form name="chooseF" action="step_2.php" method="post" enctype="multipart/form-data" >
	
	<input type="file" name="file_vid" id="file_vid" onchange="check_extension();" style="width:200px; height:25px; border:1px solid #08B2FF; background-color:#08B2FF;" />
	<br /><br />
	<input type="submit" name="confirm" value="Submit" onclick="ShowDiv()" />
	</form>
	
	</td>
  </tr>
  <tr>
    <td><div id="loading" style="display:none;"><img src="loading.gif" /></div></td>
  </tr>
</table>
Max video size is 40 MB ( just for testing )! <br />Suported input files are: <strong>3gp, avi, mpg, mpeg, mpe4, mov, m4a, mj2, flv, wmv, mp4, ogg, webm</strong>
</center>
	
	
	 </td>
  </tr>
  <tr>
    <td height="38"><img src="web_images/bottom.jpg" width="543" height="38"></td>
  </tr>
</table>
</center>


</body>
</html>
