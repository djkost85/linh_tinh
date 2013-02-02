

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml"><head>  
 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="Emoticon dùng cho blog, diễn đàn, emotion, emo, icon, smiley, mặt cười, mặt khóc, mặt mếu, smilies, smileys emoticons smiley emoticons smiley emoticon large smiley emoticon emoticon emoticons messenger emoticons animated emoticons funny emoticons rude emoticons cool emoticons emoticon adult animated adult emoticons emoticon animated text emoticons adult emoticons emoticons 3d naughty emoticons emoticon codes talking emoticon emoticons mess emoticons and winks emoticon sound speaking emoticon emoticon pictures messenger emoticon live messenger emoticons emoticon for messenger emoticons for messenger msgr emoticons emoticons faces smilies emoticons emoticon smilies windows messenger emoticons emoticons and smiley emoticons for ms emoticon faces laughing emoticon emoticons animados messenger emoticon face smilies emoticons smiley love emoticons hidden emoticon emoticons smiley faces emoticons face smiley emoticons gratis im emoticons kostenlose emoticons smiley emotions messenger smileys messenger smiley animated smileys smileys animated smiley icons new smiley smiley smiley faces animated emotions emotions messenger moving emotions emo emotions emotions for messenger emotions the emotions messenger emotes deadly emotions work emotions animated messenger icons messenger smilies messenger packs messenger icons smilies cho "><meta name="description" content="Các biểu tượng biểu cảm, emo, smiley dùng cho diễn đàn, blog ..."><meta name="ROBOTS" content="INDEX,FOLLOW"><meta name="GOOGLEBOT" content="INDEX,FOLLOW"><meta http-equiv="CACHE-CONTROL" content="NO-CACHE"><meta http-equiv="PRAGMA" content="NO-CACHE"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>Share Smile v1.1 - by Chip Pro</title>
<link href="img/style.css" rel="stylesheet" type="text/css">
<link href="img/emo.css" rel="stylesheet" type="text/css">

<script src="img/jquery-1.js" type="text/javascript"></script>
<link href="img/facebox.css" media="screen" rel="stylesheet" type="text/css">
<script src="img/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>





<script src="img/bbcode.js" type="text/javascript" charset="utf-8"></script>
<script src="img/clipboard.js" type="text/javascript" charset="utf-8"></script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>








<div id="container">

﻿<div style="width: 766px; height: 376px;" align="center">
<img src="img/banner.jpg" width="766" height="376">
</div>
<div align="center">
<div id="mainbody">
<div id="main">          
<div id="intro_panel">


<br>			

<div id="mydiv" style="display: none;">
			<div id="codeBox" align="center">
			<a href="http://chiplove.biz/" target="_blank" border="0"><img title="http://ChipLove.Biz" id="codeEmo" src="img/1_018.gif"></a>
			<br>
			<br>
			<font size="2" color="#ff4286"><b>Dán&nbsp;Vào&nbsp;Blog&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
            <input style="width: 220px; font-size: 12px;" onMouseMove="hideCopiedMsg()" onClick="this.select();copy(this.value,event);" id="codeHTML" type="text">
            <br>
			<font size="2" color="Deepskyblue"><b>Dán&nbsp;Vào&nbsp;Forum</b></font>
	        <input style="width: 220px; font-size: 12px;" onMouseMove="hideCopiedMsg()" onClick="this.select();copy(this.value,event);" id="codeBB" value="" type="text">
			<br>
            <font size="2" color="green"><b>Link&nbsp;Trực&nbsp;Tiếp&nbsp;&nbsp;&nbsp;</b></font>
			<input style="width: 220px; font-size: 12px;" onMouseMove="hideCopiedMsg()" onClick="this.select();copy(this.value,event);" id="codeDirect" value="" type="text">
		    <br><div id="copiedMsg">Tự động Copy khi Click vào ô mã, bạn hãy Paste vào nơi bạn thích</div>
		</div>
</div>
			

<center>




 <?
 /*************************
* Share Smilies v1.1 
* Code by Chip Pro	
* Y!m: chiplove.9xpro
* Site: www.chiplove.biz
**************************/
	require("admin/connect.php");
	$a = $_REQUEST["theloai"];
	
	if($a==""){
  	$sobanghi=42;
	$result = mysql_query("select * from anh order by maanh desc");
	$sotrang = ceil(mysql_num_rows($result)/$sobanghi);
	$trang = $_REQUEST["page"];
	if ($trang<=0) $trang=1;
	if ($trang>$sotrang)  $trang=$sotrang;
	$result1=mysql_query("select * from anh order by maanh desc limit  ".($trang-1)*$sobanghi.",".$sobanghi);
	
	while ($r = mysql_fetch_array($result1)){
	  
	  
			
			echo"<a class='emo' href='#codeBox' rel='facebox' onClick='return showCode(this)'>
<img alt='ChipLove.Biz' src='images/".$r["linkanh"]."' width=60 height=60></a>";
			
	}}
  	
  	 if($a!=""){
  	$result = mysql_query("select * from anh");
	if (mysql_num_rows($result)<=0){
		echo"Chưa có có dữ liệu<br>";}else{
	$sobanghi=42;
	$sotrang = ceil(mysql_num_rows($result)/$sobanghi);
	$trang = $_REQUEST["page"];
	if ($trang<=0) $trang=1;
	if ($trang>$sotrang)  $trang=$sotrang;
	$result2=mysql_query("select * from anh where matheloai=".$a." order by maanh desc limit  ".($trang-1)*$sobanghi.",".$sobanghi);
		
	
	
	 ?>

         

  <? while ($r = mysql_fetch_array($result2)){
	  
		
			echo"<a class='emo' href='#codeBox' rel='facebox' onClick='return showCode(this)'>
<img alt='ChipLove.Biz' src='images/".$r["linkanh"]."' width=60 height=60></a>";
	
	}}}?>


<br><br>
<center>
<? for($i=1;$i<=$sotrang;$i++)
		if($i==$trang)
				echo "&nbsp;<b><font color=black>[{$i}]</font></b>&nbsp;";
		else 
				echo "&nbsp;<a href='?theloai={$_REQUEST["theloai"]}&page={$i}'>{$i}</a>&nbsp;";
	?>
    </center>
</center>
<br>
<br>


</div>    



</div>
﻿<div id="viewer" style="border: 0px ridge white; overflow: hidden; background-color: white; visibility: hidden; position: absolute; left: 295px; width: 0pt; height: 0pt; z-index: 1;"></div>




<div style="float: left;" id="menucot" class="sdmenu">
<div class="expanded">
        <span>ChipLove.Biz</span>
        <a href="http://chiplove.biz/Home"><font color="red"><b>Trang Chủ</b></font></a>
        <a href="http://diendan.chiplove.biz/" target="_blank"><font color="magenta"><b>Diễn Đàn</b></font></a>
		<a href="http://diendan.chiplove.biz/forumdisplay.php?f=12" target="_blank"><font size="3" color="blue"><b>Tin Sock - Scandal</b></font></a>
		<a href="http://diendan.chiplove.biz/forumdisplay.php?f=121"><font size="3" color="DarkOrchid"><b>Nhịp Sống Trẻ</b></font><b></b></a>
		<a href="http://diendan.chiplove.biz/forumdisplay.php?f=13" target="_blank"><font size="3" color="red"><b>Chuyện Lạ</b></font><b></b></a>
	<a href="http://diendan.chiplove.biz/forumdisplay.php?f=54" target="_blank"><font size="3" color="pink"><b>Girl Xinh</b></font><b></b></a>
    <a href="http://diendan.chiplove.biz/forumdisplay.php?f=55" target="_blank"><font size="3" color="dodgerblue"><b>Kool Boy</b></font><b></b></a>	
      
		
		
      </div>

      <div><span>Emotions - Mặt Cười</span>
     
         <?
		require("admin/connect.php"); 
		$rs = mysql_query("select * from theloai");
		while ($r=mysql_fetch_array($rs)){
			if($r["icon"]==""){echo"&nbsp;<a  href=?theloai=".$r[0].">".$r["tentheloai"]."</a><br>";}
			else{
			
     echo "  
<a  href=?theloai=".$r[0]." onmouseover='setObj(description[1],'override',80,80)' onmouseout='clearTimeout(openTimer);stopIt()'><img src='images/".$r["icon"]."' alt='ChipLove.Biz' title='ChipLove.Biz' width='20' border='0' height='20'>".$r["tentheloai"]."</a>";

}} ?>
      
      
    </div></div>

	
</div>
<br>﻿<center>
  <p><font color=white>
    Code by Chip Pro <br>
    Copyright (c) 2009 Chiplove Group</font>
    <p align="right"><? echo"<a href=$admin>"; ?>AdminCp</a>&nbsp; </p>
    
  
</center>
</div>
</div>

﻿<!-- Quang cao Slide banner -->
<div id="divAdRight" style="left: 902px; width: 100px; position: absolute; top: 0px;" align="right">
<a href="http://diendan.chiplove.biz"><img src="img/love_teen.jpg" width="100" border="0" height="220"></a>

</div>


<div id="divAdLeft" style="left: 0pt; width: 100px; position: absolute; top: 0px;" align="right">
<a href="http://chiplove.biz/Home"><img src="img/qc.gif" alt="ChipLove.Biz" width="100" border="0" height="220"></a>
</div>


<script language="JavaScript">
 var adRWidth=101;
 var adLWidth=1003;
	
	function FloatTopDiv()
	{
		startX = document.body.clientWidth - adRWidth, startY = 116;
		var ns = (navigator.appName.indexOf("Netscape") != -1);
		var d = document;
			
		if (document.body.clientWidth < 980) startX = -adRWidth;

		
		function ml(id)
		{
			var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			if(d.layers)el.style=el;
			el.sP=function(x,y){this.style.left=x;this.style.top=y;};
			el.x = startX;
			el.y = startY;
			return el;
		}
		
		window.stayTopLeft=function()
		{
			
			if (document.documentElement && document.documentElement.scrollTop)
				var pY = ns ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY = ns ? pageYOffset : document.body.scrollTop;

			if (document.body.scrollTop > 116){startY = 3} else {startY = 116};
			ftlObj.y += (pY + startY - ftlObj.y)/8;
			ftlObj.sP(ftlObj.x, ftlObj.y);
			setTimeout("stayTopLeft()", 1);
		}
		ftlObj = ml("divAdRight");
		stayTopLeft();
	}

function FloatTopDiv2()
	{
		startX2 = document.body.clientWidth - adLWidth, startY2 = 116;
		var ns2 = (navigator.appName.indexOf("Netscape") != -1);
		var d2 = document;
			
		if (document.body.clientWidth < 980) startX2 = -adLWidth;

		
		function ml2(id)
		{
			var el2=d2.getElementById?d2.getElementById(id):d2.all?d2.all[id]:d2.layers[id];
			if(d2.layers)el2.style=el2;
			el2.sP=function(x,y){this.style.left=x;this.style.top=y;};
			el2.x = startX2;
			el2.y = startY2;
			return el2;
		}
		
		window.stayTopLeft2=function()
		{
			if (document.body.clientWidth < 980)
			{
				ftlObj2.x = - 115;ftlObj2.y = 0;	ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			else
			{
			if (document.documentElement && document.documentElement.scrollTop)
				var pY2 = ns2 ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY2 = ns2 ? pageYOffset : document.body.scrollTop;

			if (document.body.scrollTop > 116){startY2 = 3} else {startY2 = 116};

			if (document.body.clientWidth >= 1024)
			{
				ftlObj2.x = 2;ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/8;	ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			else
			{			
			
			ftlObj2.x = startX2;
			ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/8;
			ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			}
			setTimeout("stayTopLeft2()", 1);
		}
		
		ftlObj2 = ml2("divAdLeft");
		stayTopLeft2();
		
	}



	function ShowAdDiv()
	{
		var objAdDivRight = document.getElementById("divAdRight");
		var objAdDivLeft = document.getElementById("divAdLeft");

		if (document.body.clientWidth < 980)
		{
			objAdDivRight.style.left = - adRWidth;
			objAdDivLeft.style.left = - adLWidth;
		}
		else
		{
			objAdDivLeft.style.left = 0;
			objAdDivRight.style.left = document.body.clientWidth - adRWidth;
		}
		FloatTopDiv();
		FloatTopDiv2();
	}
	ShowAdDiv();
	LComplete = 1;
</script>
<!-- /Quang cao Slide banner --> 
