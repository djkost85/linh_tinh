<?php
################################################################################
#
#     CONFIG BEGIN
#
################################################################################
$url = "http://apnatube.co.cc/sign";
$backlink = "http://apnatube.co.cc/sign/";
################################################################################
#
#     CONFIG END
#
################################################################################
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Smiley Sign Maker</title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-family: Arial, Helvetica, sans-serif}
.style3 {
	font-size: 10px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.style8 {
	font-size: small;
	font-weight: bold;
}
-->
</style>
<script language=JavaScript src="java/picker.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<form name="sm" action="index.php" method="POST">
<td rowspan="3" valign=top bgcolor=white class=menuWB><table cellpadding=13 border=1>
  <!--DWLayoutTable-->
  <tr>
    <td height="531" colspan="3" valign="top"><h1 align="center" class="style1"><img src="s/logo.gif"></h1>
<div align="center"> <img src="s/black.gif" width="186" height="66">
      <input type="radio" name="smiley" value="black" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'black')
{
		echo "checked";
} ?>>
      <img src="s/blue.gif" width="186" height="66">
      <input type="radio" name="smiley" value="blue" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'blue')
{
		echo "checked";
} ?>>
      <img src="s/brown.gif" width="186" height="66">
      <input type="radio" name="smiley" value="brown" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'brown')
{
		echo "checked";
} ?>>
      <img src="s/green.gif" width="186" height="66">
      <input type="radio" name="smiley" value="green" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'green')
{
		echo "checked";
} ?>>
      <img src="s/grey.gif" width="186" height="66">
      <input name="smiley" type="radio" value="grey" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'grey')
{
		echo "checked";
}
else
{
		if (!isset($_REQUEST['smiley']) or ($_REQUEST['smiley']) == '')
		{
				echo "checked";
		}
} ?>>
      <img src="s/pink.gif" width="186" height="66">
      <input type="radio" name="smiley" value="pink" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'pinkk')
{
		echo "checked";
} ?>>
      <img src="s/red.gif" width="186" height="66">
      <input type="radio" name="smiley" value="red" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'red')
{
		echo "checked";
} ?>>
      <img src="s/white.gif" width="186" height="66">
      <input type="radio" name="smiley" value="white" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'white')
{
		echo "checked";
} ?>>
      <img src="s/yellow.gif" width="186" height="66">
      <input type="radio" name="smiley" value="yellow" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'yellow')
{
		echo "checked";
} ?>>
      <img src="s/cyan.gif" width="186" height="66">
      <input type="radio" name="smiley" value="cyan" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'cyan')
{
		echo "checked";
} ?>>
      <img src="s/sick.gif" width="186" height="66">
      <input type="radio" name="smiley" value="sick" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'sick')
{
		echo "checked";
} ?>>
      <img src="s/rolleyes.gif" width="186" height="66">
      <input type="radio" name="smiley" value="rolleyes" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'rolleyes')
{
		echo "checked";
} ?>>
      <img src="s/laugh.gif" width="186" height="66">
      <input type="radio" name="smiley" value="laugh" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'laugh')
{
		echo "checked";
} ?>>
      <img src="s/tongue.gif" width="186" height="66">
      <input type="radio" name="smiley" value="tongue" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'tongue')
{
		echo "checked";
} ?>>
      <img src="s/blush.gif" width="186" height="66">
      <input type="radio" name="smiley" value="blush" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'blush')
{
		echo "checked";
} ?>>
      <img src="s/redmad.gif" width="186" height="66">
      <input type="radio" name="smiley" value="redmad" <?php if (isset($_REQUEST['smiley']) && ($_REQUEST['smiley']) == 'redmad')
{
		echo "checked";
} ?>>
    </div>
      <p align="center">
<input type="text" name="text" maxlength="50" value="<?php if (isset($_REQUEST['text']) && ($_REQUEST['text']) !== '')
{
		$text = ($_REQUEST['text']);
		echo $text;
}
else
{
		if (!isset($_REQUEST['text']) or ($_REQUEST['text']) == '')
		{
				echo "";
		}
} ?>">
      <span class="style2"><input name="done" type="hidden" value="go">
      <input type="submit" value="Enter A Short  Message">
      </span>
        <span class="style8">Text Color: </span><span class="style2">
        <input name="color" type="Text" size="8" maxlength="7" value="<?php if (isset($_REQUEST['color']) && ($_REQUEST['color']) !== '')
{
		$color = ($_REQUEST['color']);
		echo $color;
}
else
{
		$color = "000000";
		echo $color;
}
?>">
        <a href="javascript:TCP.popup(document.forms['sm'].elements['color'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="java/cpiksel.gif"></a> <strong class="style8">Font:</strong>
        <select size="1" name="font">
          <option value="font/arialbd.ttf" <?php if (isset($_REQUEST['font']) && ($_REQUEST['font']) == 'font/arialbd.ttf')
{
		echo "selected";
}
?>>Arial Bold</option>
          <option value="font/MTCORSVA.TTF" <?php if (isset($_REQUEST['font']) && ($_REQUEST['font']) == 'font/MTCORSVA.TTF')
{
		echo "selected";
}
?>>MT Corsiva</option>
          MTCORSVA.TTF
        </select>
        <!--
		   ADD FONT OPTIONS AS REQUIRED BUT BE WARNED,
		   SOME FONTS WILL NOT WORK AS EXPECTED AND MAY REDUCE THE VALUE OF YOUR SITE!
		   USE THE EXISTING OPTIONS AS A TEMPLATE, SUBSTITUTING THE FONT VALUES IN THE REQUEST AREA
		   /-->
        </span>
<span class="style8">Size: +0<input name="fup" type="radio" value="0" <?php if (isset($_REQUEST['fup']) && ($_REQUEST['fup']) == '0')
{
		echo "checked";
}
else
{
		if (!isset($_REQUEST['fup']) or ($_REQUEST['fup']) == '')
		{
				echo "checked";
		}
} ?>>
              +2<input name="fup" type="radio" value="2" <?php if (isset($_REQUEST['fup']) && ($_REQUEST['fup']) == '2')
{
		echo "checked";
} ?>>
              +4<input name="fup" type="radio" value="4"  <?php if (isset($_REQUEST['fup']) && ($_REQUEST['fup']) == '4')
{
		echo "checked";
} ?>>
              </span>
      </p>
      <div align="center"><span class="style3 style5"> Temp Image -- Do Not Link !</span> <br>
<?php
$id = "copyright";
include ("s/show.php");
?>
<br />
              <span class="style3">
<?php
if (isset($_REQUEST['done']) && ($_REQUEST['done']) == 'go')
{
		if (!isset($_REQUEST['save']) && ($_REQUEST['save']) == '')
		{
				echo "<font size=\"-1\"><b>Save image and create link? <input type=\"checkbox\" name=\"save\" value=\"true\" onClick=\"submit();\"></b></font><br />";
		}
		echo "</form>";
		if (isset($_REQUEST['save']) && ($_REQUEST['save']) == 'true')
		{
				$path = getCWD();
				copy("$path/temp/$mt.gif", "$path/links/$mt.gif");
				echo "<form name=\"select_all\"><br />BBcode:&nbsp;&nbsp; <textarea  wrap=\"on\" name='text_area' rows=2 cols=75 onMouseOver=\"javascript:this.form.text_area.focus();this.form.text_area.select();\">[url=$backlink][img]$url/links/$mt.gif[/img][/url]</textarea><br />HTML:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <textarea name='text_area2' rows=2 cols=75 onMouseOver=\"javascript:this.form.text_area2.focus();this.form.text_area2.select();\"><a href=\"$backlink\"><img src=\"$url/links/$mt.gif\" border=\"0\"></a></textarea><br />MySpace: <textarea name='text_area3' rows=2 cols=75 onMouseOver=\"javascript:this.form.text_area3.focus();this.form.text_area3.select();\"><a href=$backlink><img src=$url/links/$mt.gif border=0></a></textarea></form>";
		}
}
echo "";
?>

      </div></td>

</body>
</html>
